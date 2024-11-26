<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
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
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use App\Models\PricingCriteria;
use App\Models\VectorDetail;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupportCustomerController extends Controller
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
    }

    //all customers
    public function allCustomer()
    {
        //
        $customers = User::all();
        return view('support.customers.allcustomer',[
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
    

        
    
    
        return view('support.customers.profile-details.index',compact(
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
        $user = User::find($id);
        return view('support.customers.profile-details.edit',
        compact('user','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
 
        
         return view('support.customers.bill-details.edit',
         compact('user','country','cardType'));
 
     }

     //support customer details bill update
     public function updateBIlInfo(Request $request)
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
        //return redirect()->back()->with('success', 'Added updated successfully!');
       return redirect()->route('supportcustomers.show', $user->id)->with('success', 'BillInfo updated successfully!');


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

     //update pricing
     public function updatePriceDetails(Request $request)
     {
        // Ensure this is in the correct controller method
        // $validated = $request->validate([
        //     'delivery_type_id' => 'required|in:1,2',
        //     'mini_price' => 'required|numeric',
        //     'max_price' => 'required|numeric',
        //     'stitches' => 'required|numeric',
        //     'editing_changes' => 'required|string',
        //     'editing_stitches_file' => 'required|string',
        //     'comment_1' => 'nullable|string',
        //     'comment_2' => 'nullable|string',
        //     'comment_3' => 'nullable|string',
        //     'comment_4' => 'nullable|string',
        // ]);

        // Find the existing pricing or create a new one
        $pricing = PricingCriteria::firstOrNew(['customer_id' => $request->customer_id]);

        // Fill validated data into the model
        $pricing->fill([
            'delivery_type_id' => $request->delivery_type_id,
            'minimum_price' => $request->mini_price,
            'maximum_price' => $request->max_price,
            'stitches' => $request->stitches,
            'editing_changes' => $request->editing_changes,
            'editing_in_stitch_file' => $request->editing_stitches_file,
            'comment_box_1' => $request->comment_1,
            'comment_box_2' => $request->comment_2,
            'comment_box_3' => $request->comment_3,
            'comment_box_4' => $request->comment_4,
            'customer_id' =>$request->customer_id
        ]);

        // Save the model to the database
        $pricing->save();

        // Redirect back with success message
      //  return redirect()->route('pricing.view', $request->customer_id)->with('success', 'Pricing details saved successfully!');

      return redirect()->route('supportcustomers.show', $request->customer_id)->with('success', 'Pricing Details Updated successfully!');
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
    //update vector details

    public function updateVectorDetails(Request $request)
    {

         // Find the existing pricing or create a new one
        $vectorDetail = VectorDetail::firstOrNew(['customer_id' => $request->customer_id]);

        // Fill validated data into the model
        $vectorDetail->fill([
           // 'customer_id' => $request->customer_id,
            'machine' => $request->machines,
            'condition' => $request->condition,
            'needles' => $request->needles,
            'thread' => $request->thread,
            'needle_brand' => $request->needle_brand,
            'backing_pique_jersey' => $request->backing_pique_jersey,
            'brand' => $request->brand,
            'backing_cotton_twill' => $request->backing_cotton_twill,
            'backing_cap' => $request->backing_cap,
            'model' => $request->model,
            'needle_number' =>$request->needle_number,
            'head' =>$request->heads,
            'comment_box' =>$request->comments
        ]);

        // Save the model to the database
        $vectorDetail->save();


      return redirect()->route('supportcustomers.show', $request->customer_id)->with('success', 'Vector Details Updated successfully!');
    }

     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

  
}
