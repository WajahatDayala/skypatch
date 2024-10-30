<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\Quote;
use App\Models\Country;
use App\Models\CustomerBillInfo;
use App\Models\CardType;
use Validator;

use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/customers';
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    public function index()
    {
        //
       // $customers = User::all();
        
        // $customers = User::select("*",
        // 'users.name as customer_nick',
        // 'users.created_at as createdDate'
        
        // )
        // ->join('orders','orders.customer_id','=','orders.id')
        // ->get();
      
        $customers = User::select(
            'users.id', // User ID
            'users.name as customer_nick', // Customer nickname
            'users.contact_name', // Contact person
            'users.company_name', // Company name
            'users.phone', // Phone number
            'users.email', // Email address
            'users.created_at as createdDate', // Registration date
            'users.reference', // Reference field
            DB::raw('COUNT(orders.id) as order_count'), // Count of orders
            DB::raw('COUNT(quotes.id) as quote_count'), // Count of quotes
            DB::raw('COUNT(vector_orders.id) as vector_order_count') // Count of vector orders
        )
        ->join('orders', 'orders.customer_id', '=', 'users.id')
        ->leftJoin('quotes', 'quotes.customer_id', '=', 'users.id')
        ->leftJoin('vector_orders', 'vector_orders.customer_id', '=', 'users.id')
        ->where('orders.status_id', '=', 2)
        ->where('quotes.status_id', '=', 2)
        ->where('vector_orders.status_id', '=', 2)
        ->groupBy('users.id', 'users.name', 'users.contact_name', 'users.company_name', 'users.phone', 'users.email', 'users.created_at', 'users.reference') // Include reference in group by
        ->get();


       
    
    

      




       return view('admin.customers.index',[
            'customers'=>$customers
        ]);

    }

    public function allCustomer()
    {
        //
        $customers = User::all();
        return view('admin.customers.allcustomer',[
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
    
    
        return view('admin.customers.profile-details.index',compact('user','billInfo'));

    }

    //customer panel 
    public function showPanel(string $id)
    {
        $user = User::find($id);
        return view('admin.customers.customer-dashboard.dashboard',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $country  = Country::all();
        $user = User::find($id);
        return view('admin.customers.profile-details.edit',
        compact('user','country'));
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

       
        return view('admin.customers.bill-details.edit',
        compact('user','country','cardType'));

    }

    public function storeBillInfo(Request $request)
    {
        $validatedData = $request->validate([
            'card_holder_name' => 'required|string|max:255',
            'card_type' => 'required', // Make sure this matches your input name
            'credit_number' => 'required',
            'billing_exp_month' => 'required',
            'billing_exp_year' => 'required',
            'verification_num' => 'required',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);
    
        $user  = User::findOrFail($request->customer_id);
        
          // Check if the billing info exists or create a new instance
        $billInfo = CustomerBillInfo::firstOrNew(['customer_id' => $user->id]);
        $billInfo->card_holder_name = $validatedData['card_holder_name'];
        $billInfo->card_type_id = $validatedData['card_type'];
        $billInfo->card_number = $validatedData['credit_number'];
        $billInfo->card_expiry = $validatedData['billing_exp_month'] . '/' . $validatedData['billing_exp_year'];
        $billInfo->vcc = $validatedData['verification_num'];
        $billInfo->address = $validatedData['address'];
        $billInfo->city = $validatedData['city'];
        $billInfo->state = $validatedData['state'];
        $billInfo->zipcode = $validatedData['zipcode'];
        $billInfo->country = $validatedData['country'];
        
      
        $billInfo->save();
        return redirect()->back()->with('success', 'Added updated successfully!');
       

    }
    



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
