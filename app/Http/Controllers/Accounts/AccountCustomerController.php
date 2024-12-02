<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\VectorRequiredFormat;
use App\Models\Quote;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;

use App\Models\Country;
use App\Models\CustomerBillInfo;
use App\Models\CardType;

use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Admin;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\PricingCriteria;
use App\Models\Option;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use App\Models\JobInformation;
use App\Models\VectorDetail;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AccountCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    public function allCustomer()
    {
        //
        $customers = User::all();
        return view('accounts.customers.allcustomer',[
            'customers'=>$customers
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    //add invoice page
    public function addInvoice(string $id)
    {

        $customer = User::findOrFail($id);
       

        // $orders = DB::table('orders')
        //     ->select(
        //         'orders.id as order_id',
        //         'users.name as customer_name',
        //         DB::raw("CONCAT('OR-', orders.id) as design_number"),
        //         'orders.name as design_name',
        //         'statuses.name as status',
        //         DB::raw("'orders' as source_table") // Identify that this row is from the orders table
        //     )
        //     ->join('users', 'orders.customer_id', '=', 'users.id')
        //     ->leftJoin('statuses', 'orders.status_id', '=', 'statuses.id')
        //     ->where('orders.payment_status', 0)
        //     ->where('orders.invoice_status',0)
        //     ->where('orders.customer_id', $id)
        //     ->where('orders.status_id', 1)
        //     ->orderBy('design_number', 'ASC') // Sort by design_number to keep proper order
        //     ->get();


        $orders = DB::table('job_information')
        ->select(
            'job_information.order_id as order_id',
            'job_information.total as total',
            'job_information.created_at as releasedDate',
            'users.name as customer_name',
            DB::raw("CONCAT('OR-', orders.id) as design_number"),
            'orders.name as design_name',
            'statuses.name as status',
            DB::raw("'orders' as source_table") // Identify that this row is from the orders table
        )
        ->join('orders','job_information.order_id','=','orders.id')
        ->join('users', 'orders.customer_id', '=', 'users.id')
        ->leftJoin('statuses', 'orders.status_id', '=', 'statuses.id')
        ->where('orders.payment_status', 0)
        ->where('orders.invoice_status',0)
        ->where('orders.customer_id', $id)
        ->where('orders.status_id', 1)
        ->orderBy('design_number', 'ASC') // Sort by design_number to keep proper order
        ->get();


            $vectorOrders =  DB::table('job_information')
            ->select(
                'job_information.vector_id as vector_id',
                'job_information.total as total',
                'job_information.created_at as releasedDate',
                'users.name as customer_name',
                DB::raw("CONCAT('VO-', vector_orders.id) as design_number"),
                'vector_orders.name as design_name',
                'statuses.name as status',
                DB::raw("'vector_orders' as source_table") // Identify that this row is from the orders table
            )
            ->join('vector_orders','job_information.vector_id','=','vector_orders.id')
            ->join('users', 'vector_orders.customer_id', '=', 'users.id')
           ->leftJoin('statuses', 'vector_orders.status_id', '=', 'statuses.id')
            ->where('vector_orders.payment_status', 0)
            ->where('vector_orders.invoice_status',0)
            ->where('vector_orders.customer_id', $id)
            ->where('vector_orders.status_id', 1)
            ->orderBy('design_number', 'ASC') // Sort by design_number to keep proper order
            ->get();

         // Get the last invoice number to calculate the next one
          $lastInvoice = Invoice::latest()->first();
          $nextInvoiceNumber = $lastInvoice ? 'INV-' . ($lastInvoice->id + 100000) : 'INV-100000';



        return view('accounts.customers.Invoice.add',compact(
            'orders',
            'vectorOrders',
            'nextInvoiceNumber',
            'customer'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        
        $billInfo = CustomerBillInfo::select('*','card_types.name as cardType')
        ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
        ->where('customer_bill_infos.customer_id',$id)
        ->first();

        //pricing
        $pricing = PricingCriteria::select('*')
        ->leftjoin('users','pricing_criterias.customer_id','=','users.id')
       ->where('pricing_criterias.customer_id',$id)
        ->first();

        //vector details
        $vectordetails = VectorDetail::select('*')
        ->leftjoin('users','vector_details.customer_id','=','users.id')
        ->where('vector_details.customer_id',$id)
        ->first();
    

        
    
    
        return view('accounts.customers.profile-details.index',compact(
            'user',
           'billInfo',
            'pricing',
            'vectordetails'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $country  = Country::all();
        $user = User::find(id: $id);
        return view('accounts.customers.profile-details.edit',
        compact('user','country'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' =>'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'cell' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'email_2' => 'nullable|string|max:255', // New required email field
            'email_3' => 'nullable|string|max:255',
            'email_4' => 'nullable|string|max:255',
            'invoice_email' =>'nullable|string|max:255',
            'password' => 'nullable|string|min:8', // Validate password
        ]);
        
        $user = User::findOrFail($id);
        
        // Update fields except email
        $user->name = $validatedData['name'];
        $user->contact_name = $validatedData['contact_name'];
        $user->company_name = $validatedData['company_name'];
        $user->company_type = $validatedData['company_type'];
        $user->phone = $validatedData['phone'];
        $user->cell = $validatedData['cell'];
        $user->fax = $validatedData['fax'];
        $user->address = $validatedData['address'];
        $user->city = $validatedData['city'];
        $user->state = $validatedData['state'];
        $user->zipcode = $validatedData['zipcode'];
        $user->country = $validatedData['country'];
        
        // Update email fields
        $user->email_2 = $validatedData['email_2'];
        $user->email_3 = $validatedData['email_3'];
        $user->email_4 = $validatedData['email_4'];
        $user->invoice_email = $validatedData['invoice_email'];
        
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']); // Hash the new password
            $user->showing_password = $validatedData['password'];
        }
        
        $user->save();
        
        return redirect()->route('accounts-customers.show', $user->id)->with('success', 'Profile updated successfully!');

    }

    public function billInfo(string $id)
    {
        $country  = Country::all();
        $cardType = CardType::all();
        $user = User::select('*','users.id')
        ->leftjoin('customer_bill_infos','customer_bill_infos.customer_id','=','users.id')
        ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
        ->where('users.id',$id)
        ->first();

       
        return view('accounts.customers.bill-details.edit',
        compact('user','country','cardType'));

    }

    
    // customer pricing details update
    public function editPricingDetails(string $id)
    {
        //
        $user = User::find($id);
       
        $pricing = PricingCriteria::select('*')
        ->leftjoin('users','pricing_criterias.customer_id','=','users.id')
        ->where('pricing_criterias.customer_id',$id)
        ->first();
    
    
         return view('price-details.edit',compact('user','pricing'));
      

    }

    //edit Vector Details
    public function editVectorDetails(String $id)
    {
        $user = User::find($id);
         
        $vectordetails = VectorDetail::select('*')
        ->leftjoin('users','vector_details.customer_id','=','users.id')
        ->where('vector_details.customer_id',$id)
        ->first();
    
    
         return view('vector-details.edit',compact('user','vectordetails'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
