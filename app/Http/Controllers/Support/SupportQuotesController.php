<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Quote;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use App\Models\Order;
use App\Models\Admin;
use App\Models\ReasonEdit;
use App\Models\Option;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Auth;

use App\Models\PricingCriteria;
use App\Models\VectorDetail;

class SupportQuotesController extends Controller
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
        ->where('quotes.delete_status',0)
        ->get();

       

        //convertQuotes
        $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
        ->join('quotes','orders.quote_id','=','quotes.id')
        ->get();


        return view('support/quotes/index',
        [
        'quotes'=>$quotes
        ]);
    }

    public function toDayQuote()
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
        ->where('quotes.delete_status',0)
        ->orderBy('design_name','ASC')
        ->get();

       

        //convertQuotes
        $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
        ->join('quotes','orders.quote_id','=','quotes.id')
        ->get();


        return view('support/quotes/today',
        [
        'quotes'=>$quotes
        ]);
    }


    //delete Quotes

    public function deleteQuotes(Request $request)
     {
         $request->validate([
             'quote_id' => 'required|exists:quotes,id', // Adjust according to your leaders table
         ]);
 
         $order = Quote::findOrFail($request->quote_id);
         $order->delete_status = 1;
         $order->support_user_id = Auth::id();
         $order->save();
 
         return redirect()->back()->with('success', 'Delete Successfully!');
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
        'users.id as customer_id',
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
         ['Quote Worker', 'Order Worker', 'Vector Worker'])
        ->get();

        //options A
        $optionA = Option::select('*','options.id as fileId')
        ->join('quotes','options.quote_id','quotes.id')
        ->where('option_type','A')
        ->where('options.quote_id',$id)
        ->get();

        

          //options B
        $optionB = Option::select('*','options.id as fileId')
          ->join('quotes','options.quote_id','quotes.id')
          ->where('option_type','B')
          ->where('options.quote_id',$id)
          ->get();

        //vector details
          $vectordetails = VectorDetail::select('*')
         ->leftjoin('users','vector_details.customer_id','=','users.id')
         ->where('vector_details.customer_id',$order->customer_id)
         ->first();


        return view('support/quotes/show',compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction',
            'optionA',
            'optionB',
            'vectordetails'
        ));
    }


       //process page quotes

       public function showProcess(string $id)
       {
           $quote = Quote::findOrFail($id);
   
           $requiredFormat = RequiredFormat::all();
           $fabric = Fabric::all();
           $placement = Placement::all();
          
          
   
           $quote = Quote::select('*', 
           'quotes.id as quote_id',
           'quotes.name as design_name',
           'users.id as customer_id',
           'users.name as customer_name',
           'users.email as email1',
           'users.email_2 as email2',
           'users.email_3 as email3',
           'users.email_4 as email4',
           'users.invoice_email as invoceEmail', 
           'statuses.name as status',
           'fabrics.name as fabric_name',
           'required_formats.name as format',
           'placements.name as placement',
           'users.name as customer_name',
           'quotes.created_at as received_date')
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
             $quoteStatus = Status::where('status_value',1)->get();
     
             //Allreasons
             $allReasons = ReasonEdit::all();
     
     
             //designer
             $designer = Admin::select('*','admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
             ->join('roles', 'admins.role_id', '=', 'roles.id')
             ->whereIn('roles.name',
              ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
             ->get();
   
                 //options A
           $optionA = Option::select('*')
           ->join('quotes','options.quote_id','quotes.id')
           ->where('option_type','A')
           ->where('options.quote_id',$id)
           ->get();
   
             //options B
           $optionB = Option::select('*')
             ->join('quotes','options.quote_id','quotes.id')
             ->where('option_type','B')
             ->where('options.quote_id',$id)
             ->get();

             
        //pricing
        $pricing = PricingCriteria::select('*')
        ->leftjoin('users','pricing_criterias.customer_id','=','users.id')
       ->where('pricing_criterias.customer_id',$quote->customer_id)
        ->first();


        //vector details
        $vectordetails = VectorDetail::select('*')
        ->leftjoin('users','vector_details.customer_id','=','users.id')
        ->where('vector_details.customer_id',$quote->customer_id)
        ->first();
   
   
           
           return view('support/quotes/process',compact(
               'quote',
               'designer',
               'quoteStatus',
               'orderFiles',
               'quoteInstruction',
               'adminInstruction',
               'allReasons',
               'optionA',
               'optionB',
               'pricing',
               'vectordetails'
           ));
       }
   
   
       //print quote
       public function printOrder(string $id)
       {
   
           $order = Quote::findOrFail($id);
   
           $order = Quote::select(
               '*',
               'quotes.id as order_id',
               'quotes.name as design_name',
               'users.name as customer_name',
               'users.id as customer_id',
               'users.email as email1',
               'users.email_2 as email2',
               'users.email_3 as email3',
               'users.email_4 as email4',
               'users.invoice_email as invoceEmail',
               'admins.id as designer_id',
               'admins.name as designer_name',
               'statuses.name as status',
               'ordersStatus.name as order_status_name',
               'fabrics.name as fabric_name',
               'required_formats.name as format',
               'placements.name as placement',
               'users.name as customer_name',
               'quotes.created_at as received_date',
               'quotes.name as design_name'
           )
               ->join('users', 'quotes.customer_id', '=', 'users.id')
               ->join('statuses', 'quotes.status_id', '=', 'statuses.id')
               ->join('fabrics', 'quotes.fabric_id', '=', 'fabrics.id')
               ->join('placements', 'quotes.placement_id', '=', 'placements.id')
               ->join('required_formats', 'quotes.required_format_id', '=', 'required_formats.id')
               ->leftjoin('admins', 'quotes.designer_id', '=', 'admins.id')
               ->leftjoin('statuses as ordersStatus', 'quotes.quotes_status', 'ordersStatus.id')
               ->where('quotes.id', $order->id)
               ->first();
   
           //instruction
           $orderInstruction = Quote::select('*', 'instructions.description as instruction')
               ->leftjoin('instructions', 'instructions.quote_id', '=', 'quotes.id')
               ->where('instructions.quote_id', $id)
               ->first();
   
   
           //admin instruction
           $adminInstruction = Quote::select('*', 'instructions.description as instruction')
               ->join('instructions', 'instructions.quote_id', '=', 'quotes.id')
               ->leftjoin('admins', 'instructions.emp_id', 'admins.id')
               ->leftjoin('roles', 'admins.role_id', 'roles.id')
               ->where('instructions.quote_id', $id)
               ->where('roles.name', 'Admin')
               ->first();
   
           //files
           $orderFiles = QuoteFileLog::select('*', 'quote_file_logs.id as fileId')
               ->where('quote_id', $id)->get();
   
           //order status
           $orderStatus = Status::where('status_value', 1)->get();
   
         
   
           //designer
           $designer = Admin::select('*', 'admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
               ->join('roles', 'admins.role_id', '=', 'roles.id')
               ->whereIn(
                   'roles.name',
                   ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker']
               )
               ->get();
   
   
   
   
           return view('admin/quotes/printview', compact(
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
}
