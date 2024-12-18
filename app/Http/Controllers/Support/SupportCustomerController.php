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
use Auth;
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

    //add invoice 
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



        return view('support.customers.Invoice.add',compact(
            'orders',
            'vectorOrders',
            'nextInvoiceNumber',
            'customer'
        ));
    }


    
    //store invoice
    public function storeInvoice(Request $request)
    {
        // Retrieve the last invoice and generate the next invoice number
        $lastInvoice = DB::table('invoices')->latest()->first();
        $nextInvoiceNumber = $lastInvoice ? 'INV-' . (intval(substr($lastInvoice->invoice_number, 4)) + 1) : 'INV-100000';

        // Insert the invoice into the invoices table
        $invoiceId = DB::table('invoices')->insertGetId([
            'invoice_number' => $nextInvoiceNumber,
            'invoice_status' => 0, // Assuming status is 0 initially
            'created_at' => now(),
            'updated_at' => now(),
            'customer_id' =>$request->customerId
        ]);

        // Log the invoice details
        //\Log::info("Created invoice ID: {$invoiceId}, Number: {$nextInvoiceNumber}");

        // Debugging: Check if the selected orders and prices are passed correctly
        // \Log::info("Selected Orders: " . json_encode($request->input('selected_orders')));
        // \Log::info("Prices: " . json_encode($request->input('price')));
        // \Log::info("Selected Vector Orders: " . json_encode($request->input('selected_vector_orders')));
        // \Log::info("Vector Prices: " . json_encode($request->input('vector_price')));

        // Insert selected orders into invoice_details table (for normal orders)
        if ($request->has('selected_orders') && $request->has('price')) {
            //$selectedOrders = $request->input('selected_orders');
            //$prices = $request->input('price');

            $orderPrice = $request->input('price');
            $orderReleasedDate = $request->input('relased_date');
            $selectedOrders = $request->input('selected_orders');

            $orderIds = $selectedOrders;

            foreach ($orderIds as $index2 => $orderId) {
                if ($orderId) {
                    $orderExists = DB::table('orders')->where('id', $orderId)->exists();
                    if (!$orderExists) {
                        //  \Log::warning("Order ID {$orderId} does not exist.");
                        continue; // Skip if the order doesn't exist
                    }
                } else {
                    // \Log::warning("Order ID {$orderId} does not exist.");
                }

            }

            $orderPrs = $orderPrice;
            $orderReleasedD = $orderReleasedDate;

            foreach ($orderPrs as $index => $priceval) {
                // Log only if the price value is not null
                if ($priceval !== null) {
                    //\Log::info("Order Price : {$priceval}");
                }
            }
            //released Date

            foreach($orderReleasedD as $index => $relDate){
                if($relDate !== null)
                {

                }
            }

            //fitler releasedDate
            $orderReleasedD = array_filter($orderReleasedDate, function ($value) {
                return $value !== null;  // Keep only non-null values
            });

            //reIndex of releasedDate 
            $orderReleasedD = array_values($orderReleasedD);

            // Step 1: Filter out null values from the $orderPrs (order prices) array
            $orderPrs = array_filter($orderPrice, function ($value) {
                return $value !== null;  // Keep only non-null values
            });

            // Re-index the array to avoid non-sequential keys after filtering
            $orderPrs = array_values($orderPrs);

            // Step 2: Merge Order IDs and Prices arrays into one array
            $mergedData = [
                'OrderIDs' => $selectedOrders,        // Store order IDs under 'OrderIDs'
                'OrderPrices' => $orderPrs,           // Store filtered order prices under 'OrderPrices'
                'releasedDate' =>$orderReleasedD
            ];

            // Log the merged data if necessary (you can skip this if you don't need to log it)
            $jsonData = json_encode($mergedData);
            // \Log::info("Merged Data: {$jsonData}");

            // Step 3: Iterate through the merged arrays and insert data into the 'invoice_details' table
            foreach ($mergedData['OrderIDs'] as $index => $orderId) {
                // Ensure there is a corresponding price for the current order
                if (isset($mergedData['OrderPrices'][$index])) {
                    $orderPrice = $mergedData['OrderPrices'][$index];
                    $orderReleasedDate = $mergedData['releasedDate'][$index];

                    // Step 4: Check if the order exists in the 'orders' table
                    if ($orderId) {
                        $orderExists = DB::table('orders')->where('id', $orderId)->exists();
                        if (!$orderExists) {
                            // \Log::warning("Order ID {$orderId} does not exist.");
                            continue; // Skip if the order doesn't exist
                        }
                    } else {
                        // \Log::warning("Invalid Order ID: {$orderId}. Skipping insertion.");
                        continue;
                    }

                    // Step 5: Ensure that the price is valid (not null or empty)
                    if ($orderPrice !== null && $orderPrice !== '') {
                        // Insert into the invoice_details table
                        DB::table('invoice_details')->insert([
                            'invoice_id' => $invoiceId,
                            'order_id' => $orderId,
                            'price' => $orderPrice,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'released_date'=>$orderReleasedDate,
                            'seller_id' => Auth::id()
                        ]);

                       // Update the invoice_status for the order
                        Order::where('id', $orderId)
                        ->update(['invoice_status' => 1]);

                        // \Log::info("Inserted Order ID: {$orderId} with Price: {$orderPrice} into invoice_details.");
                    } else {
                        // \Log::warning("Invalid price for Order ID: {$orderId}. Skipping insertion.");
                    }
                } else {
                    // \Log::warning("No price found for Order ID: {$orderId}. Skipping insertion.");
                }
            }



        }

        // Insert selected vector orders into invoice_details table (for vector orders)
        if ($request->has('selected_vector_orders') && $request->has('vector_price')) {
            // Ensure vectorPrices and selectedVectorOrders are being passed correctly
            $vectorPrices = $request->input('vector_price');
            $vectorReleasedDate = $request->input('v_relased_date');
            $selectedVectorOrders = $request->input('selected_vector_orders');



            $orderIds = $selectedVectorOrders;

            foreach ($orderIds as $index2 => $orderId) {
                if ($orderId) {
                    $orderExists = DB::table('vector_orders')->where('id', $orderId)->exists();
                    if (!$orderExists) {
                        //\Log::warning("Order ID {$orderId} does not exist.");
                        continue; // Skip if the order doesn't exist
                    }
                } else {
                    // \Log::warning("Order ID {$orderId} does not exist.");
                }

            }


            $orderPrs = $vectorPrices;
            $vectorReleasedD = $vectorReleasedDate;

            foreach ($orderPrs as $index => $priceval) {
                // Log only if the price value is not null
                if ($priceval !== null) {
                    //\Log::info("Order Price : {$priceval}");
                }
            }

              //released Date

              foreach($vectorReleasedD as $index => $vrelDate){
                if($vrelDate !== null)
                {

                }
            }

            //fitler releasedDate
            $vectorReleasedD = array_filter($vectorReleasedDate, function ($value) {
                return $value !== null;  // Keep only non-null values
            });

            //reIndex of releasedDate 
            $vectorReleasedD = array_values($vectorReleasedD);



            // Step 1: Filter out null values from the vectorPrices array
            $vectorPrices = array_filter($vectorPrices, function ($value) {
                return $value !== null;  // Keep only non-null values
            });

            // Re-index the array to avoid non-sequential keys after filtering
            $vectorPrices = array_values($vectorPrices);

            // Step 2: Ensure that there are no null values in selectedVectorOrders and align them with vectorPrices
            $selectedVectorOrders = array_values($selectedVectorOrders);

            // Step 3: Merge Vector IDs and Prices arrays into one associative array
            $mergedData = [
                'VectorIDs' => $selectedVectorOrders,  // Store vector IDs under 'VectorIDs'
                'VectorPrices' => $vectorPrices,        // Store filtered vector prices under 'VectorPrices'
                'vreleasedDate' => $vectorReleasedD
            ];

            // Log the merged data if necessary (you can skip this if you don't need to log it)
            $jsonData = json_encode($mergedData);

            // Step 4: Iterate through the merged arrays and insert data into the 'invoice_details' table
            foreach ($mergedData['VectorIDs'] as $index => $vectorId) {
                // Ensure there is a corresponding price for the current vectorId
                if (isset($mergedData['VectorPrices'][$index])) {
                    $vectorPrice = $mergedData['VectorPrices'][$index];
                    $vectorReleasedDate = $mergedData['vreleasedDate'][$index];

                    // Step 5: Check if the vector order exists in the 'vector_orders' table
                    if ($vectorId) {
                        $vectorExists = DB::table('vector_orders')->where('id', $vectorId)->exists();
                        if (!$vectorExists) {
                            //\Log::warning("Vector Order ID {$vectorId} does not exist.");
                            continue; // Skip if the vector order doesn't exist
                        }
                    } else {
                        // \Log::warning("Invalid Vector Order ID: {$vectorId}. Skipping insertion.");
                        continue;
                    }

                    // Step 6: Ensure that the price is valid (not null or empty)
                    if ($vectorPrice !== null && $vectorPrice !== '') {
                        // Insert into the invoice_details table for vector orders
                        DB::table('invoice_details')->insert([
                            'invoice_id' => $invoiceId,      // Assuming $invoiceId is set earlier
                            'vector_id' => $vectorId,        // Insert vector_id here
                            'price' => $vectorPrice,         // Insert the corresponding price
                            'created_at' => now(),
                            'updated_at' => now(),
                            'released_date' => $vectorReleasedDate,
                            'seller_id' => Auth::id()
                        ]);

                        // Update the invoice_status for the order
                        VectorOrder::where('id', $vectorId)
                        ->update(['invoice_status' => 1]);

                        // \Log::info("Inserted Vector Order ID: {$vectorId} with Price: {$vectorPrice} into invoice_details.");
                    } else {
                        //\Log::warning("Invalid price for Vector Order ID: {$vectorId}. Skipping insertion.");
                    }
                } else {
                    //  \Log::warning("No price found for Vector Order ID: {$vectorId}. Skipping insertion.");
                }
            }

        }

        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('suppport-invoices.index')->with('success', 'Invoice created successfully!');
           
        } else if (Auth::user()->role->name == 'Accounts') {

            return redirect()->route('accounts-invoices.index')->with('success', 'Invoice created successfully!');
        }

        else if (Auth::user()->role->name == 'Sales') {

            return redirect()->route('sales-invoices.index')->with('success', 'Invoice created successfully!');
        }
       
       
        
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
        
       // return redirect()->route('supportcustomers.show', $user->id)->with('success', 'Profile updated successfully!');
        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('supportcustomers.show', $user->id)->with('success', 'Profile updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {
            return redirect()->route('accounts-customers.show', $user->id)->with('success', 'Profile updated successfully!');
        }    
         else if (Auth::user()->role->name == 'Sales') {
            return redirect()->route('sales-customers.show', $user->id)->with('success', 'Profile updated successfully!');
        }

        
   
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
        if(Auth::user()->role->name === 'Customer Support'){
            return redirect()->route('supportcustomers.show', $user->id)->with('success', 'BillInfo updated successfully!');

        }
        else if(Auth::user()->role->name == 'Accounts')
        {
            return redirect()->route('accounts-customers.show', $user->id)->with('success', 'BillInfo updated successfully!');

        }
        else if (Auth::user()->role->name == 'Sales') {
            return redirect()->route('sales-customers.show', $user->id)->with('success', 'BillInfo updated successfully!');
        }
      

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

      //return redirect()->route('supportcustomers.show', $request->customer_id)->with('success', 'Pricing Details Updated successfully!');
        
        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('supportcustomers.show', $request->customer_id)->with('success', 'BillInfo updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {
            return redirect()->route('accounts-customers.show', $request->customer_id)->with('success', 'BillInfo updated successfully!');

        }
        else if (Auth::user()->role->name == 'Sales') {
            return redirect()->route('sales-customers.show', $request->customer_id)->with('success', 'BillInfo updated successfully!');
        }
   
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

    //    return redirect()->route('supportcustomers.show', $request->customer_id)->with('success', 'Vector Details Updated successfully!');
    

        // Save the model to the database
        $vectorDetail->save();
        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('supportcustomers.show', $request->customer_id)->with('success', 'BillInfo updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {
            return redirect()->route('accounts-customers.show', $request->customer_id)->with('success', 'BillInfo updated successfully!');

        }
        else if (Auth::user()->role->name == 'Sales') {
            return redirect()->route('sales-customers.show', $request->customer_id)->with('success', 'BillInfo updated successfully!');
        }

        

    
    }

     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

  
}
