<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VectorRequiredFormat;
use App\Models\VectorOrder;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use App\Models\VectorEditID;
use App\Models\Admin;
use App\Models\Option;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Auth;
use App\Models\VectorDetail;
use App\Models\PricingCriteria;
use App\Models\JobInformation;
use App\Models\InvoiceDetail;

class SalesAllVectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = VectorOrder::select('*',
        'vector_orders.id as order_id',
        'users.name as customer_name',
        'vector_orders.name as design_name',
        'statuses.name as status',
        'admins.name as designer_name',
        'vector_orders.created_at as createdAt'
        )
        ->join('users','vector_orders.customer_id','=','users.id')
        ->join('statuses','vector_orders.status_id','statuses.id')
        ->leftjoin('admins','vector_orders.designer_id','=','admins.id')
        ->orderBy('design_name','asc')
        ->where('vector_orders.delete_status',0)
        ->get();

      

        return view('sales/vector-orders/index',
        [
            'orders'=>$orders
           
        ]);
        
    }

    public function toDayVector()
    {
        //
        $orders = VectorOrder::select('*',
        'vector_orders.id as order_id',
        'users.name as customer_name',
        'vector_orders.name as design_name',
        'statuses.name as status'
        )
        ->join('users','vector_orders.customer_id','=','users.id')
        ->join('statuses','vector_orders.status_id','statuses.id')
        ->orderBy('design_name','asc')
        ->whereDate('vector_orders.created_at', today())
        ->get();

      

        return view('sales/vector-orders/today',
        [
            'orders'=>$orders
           
        ]);

    }

    public function printOrder(string $id)
    {

        $order = VectorOrder::findOrFail($id);

        $order = VectorOrder::select(
            '*',
            'vector_orders.id as order_id',
            'vector_orders.name as design_name',
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
            'required_formats.name as format',
            'users.name as customer_name',
            'vector_orders.created_at as received_date'
        )
            ->join('users', 'vector_orders.customer_id', '=', 'users.id')
            ->join('statuses', 'vector_orders.status_id', '=', 'statuses.id')
            ->join('required_formats', 'vector_orders.required_format_id', '=', 'required_formats.id')
            ->leftjoin('admins', 'vector_orders.designer_id', '=', 'admins.id')
            ->leftjoin('statuses as ordersStatus', 'vector_orders.vector_status', 'ordersStatus.id')
            ->where('vector_orders.id', $order->id)
            ->first();

        //instruction
        $orderInstruction = VectorOrder::select('*', 'instructions.description as instruction')
            ->leftjoin('instructions', 'instructions.vector_id', '=', 'vector_orders.id')
            ->where('instructions.vector_id', $id)
            ->first();


        //admin instruction
        $adminInstruction = VectorOrder::select('*', 'instructions.description as instruction')
            ->join('instructions', 'instructions.vector_id', '=', 'vector_orders.id')
            ->leftjoin('admins', 'instructions.emp_id', 'admins.id')
            ->leftjoin('roles', 'admins.role_id', 'roles.id')
            ->where('instructions.vector_id', $id)
            ->where('roles.name', 'Admin')
            ->first();

        //files
        $orderFiles = QuoteFileLog::select('*', 'quote_file_logs.id as fileId')
            ->where('order_id', $id)->get();

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


            




        return view('admin/vector-orders/printview', compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction'
        ));
    }

     //process for order
     public function processOrder(string $id)
     {
 
         $order = VectorOrder::findOrFail($id);
 
         $order = VectorOrder::select(
             '*',
             'vector_orders.id as order_id',
             'vector_orders.name as design_name',
             'users.name as customer_name',
             'users.email as email1',
             'users.email_2 as email2',
             'users.email_3 as email3',
             'users.email_4 as email4',
             'users.invoice_email as invoceEmail',
             'admins.id as designer_id',
             'admins.name as designer_name',
             'statuses.name as status',
             'ordersStatus.name as order_status_name',
             'required_formats.name as format',
             'users.name as customer_name',
             'vector_orders.created_at as received_date',
         )
             ->join('users', 'vector_orders.customer_id', '=', 'users.id')
             ->join('statuses', 'vector_orders.status_id', '=', 'statuses.id')
             ->join('required_formats', 'vector_orders.required_format_id', '=', 'required_formats.id')
             ->leftjoin('admins', 'vector_orders.designer_id', '=', 'admins.id')
             ->leftjoin('statuses as ordersStatus', 'vector_orders.vector_status', 'ordersStatus.id')
             ->where('vector_orders.id', $order->id)
             ->first();
 
         //instruction
         $orderInstruction = VectorOrder::select('*', 'instructions.description as instruction')
             ->leftjoin('instructions', 'instructions.vector_id', '=', 'vector_orders.id')
             ->where('instructions.vector_id', $id)
             ->first();
 
 
         //admin instruction
         $adminInstruction = VectorOrder::select('*', 'instructions.description as instruction')
             ->join('instructions', 'instructions.vector_id', '=', 'vector_orders.id')
             ->leftjoin('admins', 'instructions.emp_id', 'admins.id')
             ->leftjoin('roles', 'admins.role_id', 'roles.id')
             ->where('instructions.vector_id', $id)
             ->where('roles.name', 'Admin')
             ->first();
 
         //files
         $orderFiles = QuoteFileLog::select('*', 'quote_file_logs.id as fileId')
             ->where('vector_order_id', $id)->get();
 
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
 
               //options A
           $optionA = Option::select('*','options.id as fileId')
           ->join('vector_orders','options.vector_order_id','vector_orders.id')
           ->where('option_type','A')
           ->where('options.vector_order_id',$id)
           ->get();
          
 
             //options B
           $optionB = Option::select('*','options.id as fileId')
           ->join('vector_orders','options.vector_order_id','vector_orders.id')
            ->where('option_type','B')
            ->where('options.vector_order_id',$id)
             ->get();
 
      
         //pricing
         $pricing = PricingCriteria::select('*')
         ->leftjoin('users','pricing_criterias.customer_id','=','users.id')
        ->where('pricing_criterias.customer_id',$order->customer_id)
         ->first();
 
 
         //vector details
         $vectordetails = VectorDetail::select('*')
         ->leftjoin('users','vector_details.customer_id','=','users.id')
         ->where('vector_details.customer_id',$order->customer_id)
         ->first();
 
          //jobinfo
      
      $jobInfo = JobInformation::select('*')
      ->leftjoin('vector_orders','job_information.vector_id','=','vector_orders.id')
      ->where('job_information.vector_id',$id)
      ->first();
 
 
 
 
 
 
 
         return view('sales/vector-orders/process', compact(
             'order',
             'designer',
             'orderStatus',
             'orderFiles',
             'orderInstruction',
             'adminInstruction',
             'optionA',
             'optionB',
             'jobInfo',
             'vectordetails',
              'pricing'
         ));
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
        $order = VectorOrder::findOrFail($id);

        $order = VectorOrder::select('*', 
        'vector_orders.id as order_id',
        'vector_orders.name as design_name',
        'users.name as customer_name', 
        'admins.id as designer_id',
        'admins.name as designer_name',
        'statuses.name as status',
        'ordersStatus.name as order_status_name',
        'vector_required_formats.name as format',
        'users.name as customer_name',
        'vector_orders.created_at as received_date',
        'vector_orders.name as design_name')
        ->join('users', 'vector_orders.customer_id', '=', 'users.id')
        ->join('statuses','vector_orders.status_id','=','statuses.id')
        ->join('vector_required_formats','vector_orders.required_format_id','=','vector_required_formats.id')
        ->leftjoin('statuses as ordersStatus','vector_orders.vector_status','ordersStatus.id')
        ->leftjoin('admins','vector_orders.designer_id','=','admins.id')
        ->where('vector_orders.id', $order->id) 
        ->first(); 



        //instruction
        $orderInstruction = VectorOrder::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.vector_id','=','vector_orders.id')
        ->where('instructions.vector_id',$order->order_id)
        ->first();

        
        
        //admin instruction
        $adminInstruction = VectorOrder::select('*','instructions.description as instruction') 
        ->join('instructions','instructions.vector_id','=','vector_orders.id')
        ->leftjoin('admins','instructions.emp_id','admins.id')
        ->leftjoin('roles','admins.role_id','roles.id')
        ->where('instructions.vector_id',$id)
        ->where('roles.name','Admin')
        ->first();

            //order status
        $orderStatus = Status::where('status_value',1)->get();


               //files
        $orderFiles =QuoteFileLog::select('*','quote_file_logs.id as fileId')
        ->where('vector_order_id',$id)->get();

          //designer
          $designer = Admin::select('*','admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
          ->join('roles', 'admins.role_id', '=', 'roles.id')
          ->whereIn('roles.name',
           ['Quote Worker', 'Order Worker', 'Vector Worker'])
          ->get();

            //options A
            $optionA = Option::select('*','options.id as fileId')
            ->join('vector_orders','options.vector_order_id','vector_orders.id')
            ->where('option_type','A')
            ->where('options.vector_order_id',$id)
            ->get();
  
              //options B
            $optionB = Option::select('*','options.id as fileId')
            ->join('vector_orders','options.vector_order_id','vector_orders.id')
              ->where('option_type','B')
              ->where('options.vector_order_id',$id)
              ->get();

        //vector details
          $vectordetails = VectorDetail::select('*')
          ->leftjoin('users','vector_details.customer_id','=','users.id')
          ->where('vector_details.customer_id',$order->customer_id)
          ->first();


          
         //jobinfo
         $jobInfo = JobInformation::select('*')
         ->leftjoin('orders','job_information.order_id','=','orders.id')
         ->where('job_information.vector_id',$id)
         ->first();

         $invoice_status = InvoiceDetail::select('*','invoices.invoice_status as invoiceStatus')
         ->join('invoices','invoice_details.invoice_id','=','invoices.id')
         ->where('invoice_details.vector_id',$id)
         ->first();
 

        return view('sales/vector-orders/show',compact(
            'order',
            'orderStatus',
            'orderFiles',
            'designer',
            'adminInstruction',
            'orderInstruction',
            'optionA',
            'optionB',
            'vectordetails',
            'jobInfo',
            'invoice_status'
        )); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $order = VectorOrder::findOrFail($id);

        $requiredFormat = VectorRequiredFormat::all();
       
       

        $order = VectorOrder::select('*', 
        'vector_orders.id as order_id',
        'vector_orders.name as design_name',
        'users.name as customer_name', 
        'statuses.name as status',
        'vector_required_formats.name as format',
        'users.name as customer_name',
        'vector_orders.created_at as received_date',
        'vector_orders.name as design_name')
        ->join('users', 'vector_orders.customer_id', '=', 'users.id')
        ->join('statuses','vector_orders.status_id','=','statuses.id')
        ->join('vector_required_formats','vector_orders.required_format_id','=','vector_required_formats.id')
        ->where('vector_orders.id', $id) 
        ->first(); 

        //order files
        $quoteFiles =QuoteFileLog::select('*')
        ->join('vector_orders','quote_file_logs.vector_order_id','=','vector_orders.id')
        ->where('quote_file_logs.vector_order_id',$id)
        ->get();

       
         //instruction
         $orderInstruction = VectorOrder::select('*','instructions.description as instruction') 
         ->leftjoin('instructions','instructions.vector_id','=','vector_orders.id')
         ->where('instructions.vector_id',$id)
         ->first();


        return view('sales/vector-orders/edit',compact(
            'order',
            'quoteFiles',
            'requiredFormat',
            'orderInstruction'
        ));
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
