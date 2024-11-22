<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\PricingCriteria;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;


use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
    
    //add invoice 
    public function addInvoice(string $id)
    {

        $customer = User::findOrFail($id);
       

        $orders = DB::table('orders')
            ->select(
                'orders.id as order_id',
                'users.name as customer_name',
                DB::raw("CONCAT('OR-', orders.id) as design_number"),
                'orders.name as design_name',
                'statuses.name as status',
                DB::raw("'orders' as source_table") // Identify that this row is from the orders table
            )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->leftJoin('statuses', 'orders.status_id', '=', 'statuses.id')
            ->where('orders.payment_status', 0)
            ->where('orders.invoice_status',0)
            ->where('orders.customer_id', $id)
            ->where('orders.status_id', 1)
            ->orderBy('design_number', 'ASC') // Sort by design_number to keep proper order
            ->get();


            $vectorOrders =  DB::table('vector_orders')
            ->select(
                'vector_orders.id as vector_id',
                'users.name as customer_name',
                DB::raw("CONCAT('VO-', vector_orders.id) as design_number"),
                'vector_orders.name as design_name',
                'statuses.name as status',
                DB::raw("'vector_orders' as source_table") // Identify that this row is from the orders table
            )
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



        return view('admin.customers.Invoice.add',compact(
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

            foreach ($orderPrs as $index => $priceval) {
                // Log only if the price value is not null
                if ($priceval !== null) {
                    //\Log::info("Order Price : {$priceval}");
                }
            }


            // Step 1: Filter out null values from the $orderPrs (order prices) array
            $orderPrs = array_filter($orderPrice, function ($value) {
                return $value !== null;  // Keep only non-null values
            });

            // Re-index the array to avoid non-sequential keys after filtering
            $orderPrs = array_values($orderPrs);

            // Step 2: Merge Order IDs and Prices arrays into one array
            $mergedData = [
                'OrderIDs' => $selectedOrders,        // Store order IDs under 'OrderIDs'
                'OrderPrices' => $orderPrs           // Store filtered order prices under 'OrderPrices'
            ];

            // Log the merged data if necessary (you can skip this if you don't need to log it)
            $jsonData = json_encode($mergedData);
            // \Log::info("Merged Data: {$jsonData}");

            // Step 3: Iterate through the merged arrays and insert data into the 'invoice_details' table
            foreach ($mergedData['OrderIDs'] as $index => $orderId) {
                // Ensure there is a corresponding price for the current order
                if (isset($mergedData['OrderPrices'][$index])) {
                    $orderPrice = $mergedData['OrderPrices'][$index];

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

            foreach ($orderPrs as $index => $priceval) {
                // Log only if the price value is not null
                if ($priceval !== null) {
                    //\Log::info("Order Price : {$priceval}");
                }
            }



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
                'VectorPrices' => $vectorPrices        // Store filtered vector prices under 'VectorPrices'
            ];

            // Log the merged data if necessary (you can skip this if you don't need to log it)
            $jsonData = json_encode($mergedData);

            // Step 4: Iterate through the merged arrays and insert data into the 'invoice_details' table
            foreach ($mergedData['VectorIDs'] as $index => $vectorId) {
                // Ensure there is a corresponding price for the current vectorId
                if (isset($mergedData['VectorPrices'][$index])) {
                    $vectorPrice = $mergedData['VectorPrices'][$index];

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

       
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
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

    //customer panel send quote page
    public function createQuote(string $id)
    {
        $user = User::find($id);
        $requiredFormat = RequiredFormat::all();
        $fabric = Fabric::all();
        $placement = Placement::all();
       
        return view('admin.customers.quotes.add',
        compact(
            'user',
            'requiredFormat',
            'fabric',
            'placement'
        ));

    }

    //showAllQuotes from Admin
    public function allQuotes(string $id)
    {
        $user = User::find($id);
      
        $quotes = Quote::select('*',
        'quotes.id as order_id',
        'users.name as customer_name',
        'quotes.name as design_name',
        'statuses.name as status',
        'admins.name as designer_name'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->join('statuses','quotes.status_id','statuses.id')
        ->leftjoin('admins','quotes.designer_id','=','admins.id')
        ->where('customer_id',$user->id)
        ->orderBy('design_name','ASC')
        ->get();
    
        //convertQuotes
        $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
        ->join('quotes','orders.quote_id','=','quotes.id')
        ->where('orders.customer_id',$user->id)
        ->get();

       

        return view('admin/customers/quotes/index',compact('user'),
        [
        'quotes'=>$quotes,   
        'quoteConvertedOrder' => $quoteConvertedOrder 
        ]);

    }


    //create for from admin.
    public function storeQuote(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required',
            'required_format_id' => 'required',
            'fabric_id' => 'required',
            'placement_id' => 'required'
        ], [
            'name.required' => 'Name is required.',
            'required_format_id.required' => 'Format is required.',
            'fabric_id.required' => 'Fabric is required.',
            'placement_id.required' => 'Placement is required.'
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {

            $user = User::findOrFail($request->customer_id);

           
            // Create a new Quote
            $quote = Quote::create([
                'customer_id' => $request->customer_id, // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'fabric_id' => $request->fabric_id,
                'placement_id' => $request->placement_id,
                'status_id' => $request->status,
                'name' => $request->name,
                'height' => $request->height,
                'width' => $request->width,
                'number_of_colors' => $request->number_of_colors,
                'super_urgent' => $request->has('super_urgent'),
            ]);

            // Handle file uploads
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        // Store the file and get its path
                        $filePath = $file->store('uploads/quotes', 'public'); // Store in public/uploads/quotes
                        
                           // Get the original filename
                 $originalFilename = $file->getClientOriginalName();
     
                 // Create a structured string to store both path and original filename
                 $fileData = [
                     'path' => $filePath,
                     'original_name' => $originalFilename,
                 ];

                        // Insert into QuoteFileLog
                        QuoteFileLog::create([
                            'quote_id' => $quote->id,
                            'cust_id' => $request->customer_id,
                            'files' =>json_encode($fileData),
                        ]);
                    }
                }

                //check additonal fields
                if($request->filled('additional_instruction')){
                    Instruction::create([
                        'cust_id' => $request->customer_id,
                        'description' => $request->additional_instruction,
                        'quote_id' => $quote->id,
                    ]);
                }


            // Commit the transaction
            DB::commit();
            
            $request->session()->flash('quote',$request['name']);

             //return redirect()->route('customer.all-quotes')->with('success', 'Quote created successfully!');
             return redirect()->route('customer.all-quotes', $user->id)->with('success', 'Profile updated successfully!');

            
            // return redirect()->back()->with('success', 'Quote created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
           // DB::rollBack();
            
            // Log the error
           // \Log::error('Error creating quote: ' . $e->getMessage());

            // Redirect back with error message
            return back()->withErrors(['error' => 'An error occurred while creating the quote.']);
        }

    }

    //showQuote details for admin
    public function showQuote(string $id)
    {
        $user = Quote::select('*','quotes.customer_id')
        ->join('users','quotes.customer_id','=','users.id')
        ->first();

        $order = Quote::findOrFail($id);

        $order = Quote::select('*', 
        'quotes.id as order_id',
        'quotes.name as design_name',
        'users.name as customer_name', 
        'admins.id as designer_id',
        'admins.name as designer_name',
        'statuses.name as status',
        'ordersStatus.name as order_status_name',
        'fabrics.name as fabric_name',
        'required_formats.name as format',
        'placements.name as placement',
        'users.name as customer_name',
        'quotes.created_at as received_date',
        'quotes.name as design_name')
        ->join('users', 'quotes.customer_id', '=', 'users.id')
        ->join('statuses','quotes.status_id','=','statuses.id')
        ->join('fabrics','quotes.fabric_id','=','fabrics.id')
        ->join('placements','quotes.placement_id','=','placements.id')
        ->join('required_formats','quotes.required_format_id','=','required_formats.id')
        ->leftjoin('statuses as ordersStatus','quotes.quotes_status','ordersStatus.id')
        ->leftjoin('admins','quotes.designer_id','=','admins.id')
        ->where('quotes.id', $order->id) 
        ->first(); 


       

         //instruction
         $orderInstruction = Quote::select('*','instructions.description as instruction') 
         ->leftjoin('instructions','instructions.quote_id','=','quotes.id')
         ->where('instructions.quote_id',$order->order_id)
         ->first();
         //admin instruction
         $adminInstruction = Quote::select('*','instructions.description as instruction') 
         ->join('instructions','instructions.quote_id','=','quotes.id')
         ->leftjoin('admins','instructions.emp_id','admins.id')
         ->leftjoin('roles','admins.role_id','roles.id')
         ->where('instructions.quote_id',$id)
         ->where('roles.name','Admin')
         ->first();
 
         //files
         $orderFiles =QuoteFileLog::select('*','quote_file_logs.id as fileId')
         ->where('quote_id',$id)->get();
     
         //order status
         $orderStatus = Status::where('status_value',1)->get();
 
       
         //designer
         $designer = Admin::select('*','admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
         ->join('roles', 'admins.role_id', '=', 'roles.id')
         ->whereIn('roles.name',
          ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
         ->get();
 

        

        return view('admin/customers/quotes/show',compact(
            'user',
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction'
        ));

    }

    //editQuote from customer panel by admin..
    public function editQuote(string $id)
    {
        //
        $quote = Quote::findOrFail($id);

        $requiredFormat = RequiredFormat::all();
        $fabric = Fabric::all();
        $placement = Placement::all();
       
       

        $quote = Quote::select('*', 
        'quotes.id as quote_id',
        'quotes.name as design_name',
        'users.name as customer_name', 
        'statuses.name as status',
        'fabrics.name as fabric_name',
        'required_formats.name as format',
        'placements.name as placement',
        'users.name as customer_name',
        'quotes.created_at as received_date',
        'quotes.name as design_name')
        ->join('users', 'quotes.customer_id', '=', 'users.id')
        ->join('statuses','quotes.status_id','=','statuses.id')
        ->join('fabrics','quotes.fabric_id','=','fabrics.id')
        ->join('placements','quotes.placement_id','=','placements.id')
        ->join('required_formats','quotes.required_format_id','=','required_formats.id')
        ->where('quotes.id', $quote->id) 
        ->first(); 

        //quote files
        $quoteFiles =QuoteFileLog::select('*')
        ->join('quotes','quote_file_logs.quote_id','=','quotes.id')
        ->where('quote_file_logs.quote_id',$quote->quote_id)
        ->get();

      //instruction
      $quoteInstruction = Quote::select('*','instructions.description as instruction') 
      ->leftjoin('instructions','instructions.quote_id','=','quotes.id')
      ->where('instructions.quote_id',$quote->quote_id)
      ->first();


        return view('admin/customers/quotes/edit',compact(
            'quote',
            'quoteFiles',
            'requiredFormat',
            'fabric',
            'quoteInstruction',
            'placement'
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
        //return redirect()->back()->with('success', 'Added updated successfully!');
       return redirect()->route('customer.my-profile', $user->id)->with('success', 'Profile updated successfully!');


    }
    
    //convert quotes to order by admin
    //convert quotes by admin
     
    public function convertToOrder(string $id, string $quoteId)
    {
        // Fetch the quote based on quoteId
        $quote = Quote::find($quoteId);
    
        if (!$quote) {
            return response()->json(['status' => 'not_found'], 404);
        }
    
        // You can also perform checks with customerId if needed
        if ($quote->customer_id != $id) {
            return response()->json(['status' => 'forbidden'], 403);
        }
    
        // Create the new order
        $order = new Order();
        $order->customer_id = $quote->customer_id; 
        $order->quote_id = $quote->id; 
        $order->required_format_id = $quote->required_format_id;
        $order->fabric_id = $quote->fabric_id;
        $order->placement_id = $quote->placement_id;
        $order->status_id = $quote->status_id; // Set the initial status
    
        $order->name = $quote->name; // Adjust as needed
        $order->height = $quote->height;
        $order->width = $quote->width;
        $order->number_of_colors = $quote->number_of_colors;
        $order->super_urgent = $quote->super_urgent;
    
        // Save the order
        $order->save();
       
    
        return response()->json(['status' => 'converted']);
    }

    //customer profile by admin for customer panel
    public function customerProfile(string $id)
    {
        //
        $user = User::select('*')
        ->where('id',$id)
        ->first();

            
        $billInfo = CustomerBillInfo::select('*','card_types.name as cardType')
        ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
        ->where('customer_bill_infos.customer_id',$id)
        ->first();

    
        return view('admin.customers.panel-profile.index',compact('user','billInfo'));
    }
     //customer profile edit by admin
    public function customerProfileEdit(string $id)
    {
        //
        $country  = Country::all();
        $user = User::find($id);
        
        return view('admin.customers.panel-profile.edit',
        compact('user','country'));

    }
    //customer profile update by admin
    public function customerProfileUpdate(Request $request,string $id)
    {
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
        
        return redirect()->route('customer.my-profile', $user->id)->with('success', 'Profile updated successfully!');


       // return redirect()->back()->with('success', 'Profile updated successfully!');
    }

     //customer billInfo by admin for customer panel
     public function customerBillInfo(string $id)
     {
         //
         $country  = Country::all();
         $cardType = CardType::all();
         $user = User::select('*','users.id','users.name as name')
         ->leftjoin('customer_bill_infos','customer_bill_infos.customer_id','=','users.id')
         ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
         ->where('users.id',$id)
         ->first();
 
        
     
         return view('admin.customers.panel-billinfo.edit',compact(
            'user',
            'cardType',
            'country'
        ));
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
        
        return redirect()->route('customers.show', $user->id)->with('success', 'Profile updated successfully!');

    }

    //updateBIlInfo 
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
       return redirect()->route('customers.show', $user->id)->with('success', 'BillInfo updated successfully!');


    }

    //customer pricing details update
     public function updatePriceDetails(Request $request ,$id)
     {
        $validated = $request->validate([
            'mini_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'stitches' => 'required|numeric',
            'delivery_type' => 'required|in:1,2',
            'editing_changes' => 'required|string',
            'editing_stitches_file' => 'required|string',
            'comment_1' => 'nullable|string',
            'comment_2' => 'nullable|string',
            'comment_3' => 'nullable|string',
            'comment_4' => 'nullable|string',
        ]);

            // Find the existing pricing or create a new one
             $pricing = PricingCriteria::firstOrNew(['user_id' => $id]);  // Use user_id or other unique identifier

            // Update fields
             $pricing->fill($validated);
             $pricing->save(); // Save to DB

             return redirect()->route('pricing.view', $id)->with('success', 'Pricing details saved successfully!');

     }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}