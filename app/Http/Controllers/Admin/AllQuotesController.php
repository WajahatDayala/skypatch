<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Quote;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
//use App\Models\QuoteEditID;
use App\Models\Order;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class AllQuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/allquotes';
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    public function index()
    {

        //
        $quotes = Quote::select('*',
        'quotes.id as order_id',
        'users.name as customer_name',
        'quotes.name as design_name',
        'admins.name as designer_name',
        'statuses.name as status',
        'quotes.created_at as createdAt'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->join('statuses','quotes.status_id','statuses.id')
        ->leftjoin('admins','quotes.designer_id','admins.id')
        ->orderBy('design_name','ASC')
        ->get();

       

        //convertQuotes
        $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
        ->join('quotes','orders.quote_id','=','quotes.id')
        ->get();


        return view('admin/quotes/index',
        [
        'quotes'=>$quotes
        ]);
    }

    public function todayDayQuote()
    {
        $quotes = Quote::select('*',
        'quotes.id as order_id',
        'users.name as customer_name',
        'quotes.name as design_name',
        'admins.name as designer_name',
        'statuses.name as status',
        'quotes.created_at as createdAt'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->join('statuses','quotes.status_id','statuses.id')
        ->leftjoin('admins','quotes.designer_id','admins.id')
        ->whereDate('quotes.created_at',today())
        ->orderBy('design_name','ASC')
        ->get();

       

        //convertQuotes
        $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
        ->join('quotes','orders.quote_id','=','quotes.id')
        ->get();


        return view('admin/quotes/today',
        [
        'quotes'=>$quotes
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
        ->leftjoin('admins','quotes.designer_id','=','admins.id')
        ->leftjoin('statuses as ordersStatus','quotes.quotes_status','ordersStatus.id')
        ->where('quotes.id', $order->id) 
        ->first(); 

        //instruction
        $orderInstruction = Quote::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.quote_id','=','quotes.id')
        ->where('instructions.quote_id',$id)
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




        return view('admin/quotes/show',compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function convertToOrder($quoteId)
    {
        // Retrieve the quote using the provided ID
        $quote = Quote::find($quoteId);
    
        if (!$quote) {
            return response()->json(['status' => 'not_found'], 404);
        }
    
        // Create a new order based on the quote data
        $order = new Order();
        $order->customer_id = $quote->customer_id; // Assuming customer_id exists
        $order->quote_id  = $quote->id;; // Assuming customer_id exists
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
    
        // Optionally, update the quote status or perform other actions
    
        return response()->json(['status' => 'converted']);
    }
    
}

