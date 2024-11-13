<?php

namespace App\Http\Controllers\Digitizer\Vector\Worker;

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
class VectorWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/vector-workers';
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
        ->join('admins','vector_orders.designer_id','=','admins.id')
        ->orderBy('design_name','asc')
        ->get();

      

        return view('digitizer/vector-worker/order/index',
        [
            'orders'=>$orders
           
        ]);
    }

     //today vector 
     public function todayVectorOrders()
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
         ->join('admins','vector_orders.designer_id','=','admins.id')
         ->whereDate('vector_orders.created_at', today())
         ->orderBy('design_name','asc')
         ->get();
 
       
           
 
         return view('digitizer/vector-worker/order/today',
         [
             'orders'=>$orders
             
            
         ]);
     }

     
    //showProcess 
    public function showProcess(string $id){
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
           ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
          ->get();

             //options A
             $optionA = Option::select('*')
             ->join('vector_orders','options.vector_order_id','vector_orders.id')
             ->where('option_type','A')
             ->where('options.vector_order_id',$id)
             ->get();
   
               //options B
             $optionB = Option::select('*')
             ->join('vector_orders','options.vector_order_id','vector_orders.id')
               ->where('option_type','B')
               ->where('options.vector_order_id',$id)
               ->get();

          return view('digitizer/vector-worker/order/process',compact(
            'order',
            'orderStatus',
            'orderFiles',
            'designer',
            'adminInstruction',
            'orderInstruction',
            'optionA',
            'optionB'
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
           ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
          ->get();

             //options A
             $optionA = Option::select('*')
             ->join('vector_orders','options.vector_order_id','vector_orders.id')
             ->where('option_type','A')
             ->where('options.vector_order_id',$id)
             ->get();
   
               //options B
             $optionB = Option::select('*')
             ->join('vector_orders','options.vector_order_id','vector_orders.id')
               ->where('option_type','B')
               ->where('options.vector_order_id',$id)
               ->get();

          return view('digitizer/vector-worker/order/show',compact(
            'order',
            'orderStatus',
            'orderFiles',
            'designer',
            'adminInstruction',
            'orderInstruction',
            'optionA',
            'optionB'
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
