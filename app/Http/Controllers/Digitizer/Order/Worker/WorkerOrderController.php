<?php

namespace App\Http\Controllers\Digitizer\Order\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Order;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use App\Models\OrderEditID;
use App\Models\ReasonEdit;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use App\Models\Option; 
use App\Models\VectorDetail;
use App\Models\JobInformation;
use Auth;
class WorkerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/all-worker-orders';
    public function index()
    {
        //
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'admins.name as designer_name',
        'orders.name as design_name',
        'statuses.name as status',
        'orders.created_at as createdAt'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('statuses','orders.status_id','statuses.id')
        ->join('admins','orders.designer_id','=','admins.id')
        ->where('orders.status_id',2)
        ->orderBy('design_name','ASC')
        ->get();

       
        return view('digitizer/order-worker/order/index',['orders'=>$orders]);
    }

    
    public function toDayOrders()
    {
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'admins.name as designer_name',
        'orders.name as design_name',
        'delivery_types.type as deliveryType',
        'statuses.name as status',
        'orders.created_at as createdAt'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('delivery_types','orders.delivery_type_id','delivery_types.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->join('admins','orders.designer_id','=','admins.id')
        ->whereDate('orders.created_at', today())
        ->orderBy('orders.id','Asc')
        ->get();

    
        
        return view('digitizer/order-worker/order.today', ['orders' => $orders]);
    }

    public function showProcess(string $id)
    {
        $order = Order::findOrFail($id);

        $requiredFormat = RequiredFormat::all();
        $fabric = Fabric::all();
        $placement = Placement::all();
       
       

        $order = Order::select('*', 
        'orders.id as order_id',
        'orders.name as design_name',
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
        'orders.created_at as received_date')
        ->join('users', 'orders.customer_id', '=', 'users.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->join('fabrics','orders.fabric_id','=','fabrics.id')
        ->join('placements','orders.placement_id','=','placements.id')
        ->join('required_formats','orders.required_format_id','=','required_formats.id')
      
        ->where('orders.id', $order->id) 
        ->first(); 

        //quote files
        $quoteFiles =QuoteFileLog::select('*')
        ->join('orders','quote_file_logs.order_id','=','orders.id')
        ->where('quote_file_logs.order_id',$order->order_id)
        ->get();

        //instruction
          $orderInstruction = Order::select('*','instructions.description as instruction') 
          ->leftjoin('instructions','instructions.order_id','=','orders.id')
          ->where('instructions.quote_id',$order->order_id)
          ->first();

          //admin instruction
          $adminInstruction = Order::select('*','instructions.description as instruction') 
          ->join('instructions','instructions.order_id','=','orders.id')
          ->leftjoin('admins','instructions.emp_id','admins.id')
          ->leftjoin('roles','admins.role_id','roles.id')
          ->where('instructions.order_id',$id)
          ->where('roles.name','Admin')
          ->first();
  
          //files
          $orderFiles =QuoteFileLog::select('*','quote_file_logs.id as fileId')
          ->where('order_id',$id)->get();
      
          //order status
          $orderStatus = Status::where('status_value',1)->get();
  
          //Allreasons
          $allReasons = ReasonEdit::all();
  
  
          //designer
          $designer = Admin::select('*','admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
          ->join('roles', 'admins.role_id', '=', 'roles.id')
          ->whereIn('roles.name',
           ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
          ->get();


            //options A
            $optionA = Option::select('*','options.id as fileId')
            ->join('orders','options.order_id','orders.id')
            ->where('option_type','A')
            ->where('options.order_id',$id)
            ->get();
  
              //options B
            $optionB = Option::select('*','options.id as fileId')
             ->join('orders','options.order_id','orders.id')
             ->where('option_type','B')
             ->where('options.order_id',$id)
              ->get();

              //vector details
              $vectordetails = VectorDetail::select('*')
              ->leftjoin('users','vector_details.customer_id','=','users.id')
              ->where('vector_details.customer_id',$order->customer_id)
              ->first();
  
                         //jobinfo
             $jobInfo = JobInformation::select('*')
            ->leftjoin('orders','job_information.order_id','=','orders.id')
            ->where('job_information.order_id',$id)
            ->first();
   
 
 
  
        
          return view('digitizer/order-worker/order/process',compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction',
            'allReasons',
            'optionA',
            'optionB',
             'vectordetails',
            'jobInfo'
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
        $order = Order::findOrFail($id);

        $order = Order::select('*', 
        'orders.id as order_id',
        'orders.name as design_name',
        'users.name as customer_name',
        'admins.id as designer_id',
        'admins.name as designer_name',
        'statuses.name as status',
        'ordersStatus.name as order_status_name',
        'fabrics.name as fabric_name',
        'required_formats.name as format',
        'placements.name as placement',
        'users.name as customer_name',
        'orders.created_at as received_date',
        'reason_edits.reason as reason_name',
        'orders.name as design_name')
        ->join('users', 'orders.customer_id', '=', 'users.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->join('fabrics','orders.fabric_id','=','fabrics.id')
        ->join('placements','orders.placement_id','=','placements.id')
        ->join('required_formats','orders.required_format_id','=','required_formats.id')
        ->join('admins','orders.designer_id','=','admins.id')
        ->leftjoin('statuses as ordersStatus','orders.order_status','ordersStatus.id')
        ->leftjoin('reason_edits','orders.edit_reason_id','reason_edits.id')
        ->where('orders.id', $order->id) 
        ->first(); 

        //instruction
        $orderInstruction = Order::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.order_id','=','orders.id')
        ->where('instructions.order_id',$id)
        ->first();


        //admin instruction
        $adminInstruction = Order::select('*','instructions.description as instruction') 
        ->join('instructions','instructions.order_id','=','orders.id')
        ->leftjoin('admins','instructions.emp_id','admins.id')
        ->leftjoin('roles','admins.role_id','roles.id')
        ->where('instructions.order_id',$id)
        ->where('roles.name','Admin')
        ->first();

        //files
        $orderFiles =QuoteFileLog::select('*','quote_file_logs.id as fileId')
        ->where('order_id',$id)->get();
    
        //order status
        $orderStatus = Status::where('status_value',1)->get();

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
          ->join('orders','options.order_id','orders.id')
          ->where('option_type','A')
          ->where('options.order_id',$id)
          ->get();

            //options B
          $optionB = Option::select('*')
            ->join('orders','options.order_id','orders.id')
            ->where('option_type','B')
            ->where('options.order_id',$id) 
            ->get();


                   //vector details
                   $vectordetails = VectorDetail::select('*')
                   ->leftjoin('users','vector_details.customer_id','=','users.id')
                   ->where('vector_details.customer_id',$order->customer_id)
                   ->first();
       
                              //jobinfo
                  $jobInfo = JobInformation::select('*')
                 ->leftjoin('orders','job_information.order_id','=','orders.id')
                 ->where('job_information.order_id',$id)
                 ->first();
  



         return view('digitizer/order-worker/order/show',compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction',
            'allReasons',
            'optionA',
            'optionB',
            'vectordetails',
            'jobInfo'
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
           //order
           $order = Order::where('id',$request->order_id)->first();
  
           //job process
           $job = JobInformation::updateOrCreate(
           ['order_id' => $request->order_id], // Condition to check if the record exists
           [
               'height_A' => $request->height_A,
               'width_A' => $request->width_A,
               'stitches_A' => $request->stitches_A,
               'price_A' => $request->price_A,
               'height_B' => $request->height_B,
               'width_B' => $request->width_B,
               'stitches_B' => $request->stitches_B,
               'price_B' => $request->price_B,
               'total' => $request->total
           ]
          );
          return back()->with('success', 'Job Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
