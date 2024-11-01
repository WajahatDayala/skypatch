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

use Validator;

use Illuminate\Support\Facades\Storage;

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

           // return redirect()->route('quotes.index')->with('success', 'Quote created successfully!');
            
            return redirect()->back()->with('success', 'Quote created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
           // DB::rollBack();
            
            // Log the error
            \Log::error('Error creating quote: ' . $e->getMessage());

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
        return redirect()->back()->with('success', 'Added updated successfully!');
       

    }
    
    //convert quotes to order by admin
    //convert quotes by admin
     
    public function convertToOrder(string $quoteId)
    {
         // Retrieve the quote using the provided ID
    $quote = Quote::find($quoteId);
   
    if (!$quote) {
        return response()->json(['status' => 'not_found'], 404);
    }

    // Create a new order based on the quote data
    $order = new Order();
    $order->customer_id = $quote->customer_id; 
    $order->quote_id  = $quoteId; 
    $order->required_format_id = $quote->required_format_id;
    $order->fabric_id = $quote->fabric_id;
    $order->placement_id = $quote->placement_id;
    $order->status_id = $quote->status_id; 

    $order->name = $quote->name; 
    $order->height = $quote->height;
    $order->width = $quote->width;
    $order->number_of_colors = $quote->number_of_colors;
    $order->super_urgent = $quote->super_urgent;

    // Save the order
    $order->save();

    return response()->json(['status' => 'converted']);
    }

    //my-profile by customer panel
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
    
        return view('admin.customers.profile.index',compact('user','billInfo'));
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