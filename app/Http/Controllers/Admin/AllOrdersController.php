<?php

namespace App\Http\Controllers\Admin;

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
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class AllOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/admin/allorders';
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    public function index()
    {
        //
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'orders.name as design_name',
        'statuses.name as status'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('statuses','orders.status_id','statuses.id')
        ->orderBy('design_name','ASC')
        ->get();

       
        return view('admin/orders/index',['orders'=>$orders]);
    }

    public function todayDayOrders()
    {
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'orders.name as design_name',
        'delivery_types.type as deliveryType',
        'statuses.name as status'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('delivery_types','orders.delivery_type_id','delivery_types.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->whereDate('orders.created_at', today())
        ->get();

    
        
        return view('admin.orders.today', ['orders' => $orders]);
    }
    public function todayDayEditOrders()
    {
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'orders.name as design_name',
        'delivery_types.type as deliveryType'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('delivery_types','orders.delivery_type_id','delivery_types.id')
        ->whereNotNull('edit_order_id')
        ->whereDate('orders.created_at', today())
        ->get();

    
        
        return view('admin.orders.today-edit', ['orders' => $orders]);
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
        'statuses.name as status',
        'fabrics.name as fabric_name',
        'required_formats.name as format',
        'placements.name as placement',
        'users.name as customer_name',
        'orders.created_at as received_date',
        'orders.name as design_name')
        ->join('users', 'orders.customer_id', '=', 'users.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->join('fabrics','orders.fabric_id','=','fabrics.id')
        ->join('placements','orders.placement_id','=','placements.id')
        ->join('required_formats','orders.required_format_id','=','required_formats.id')
        ->where('orders.id', $order->id) 
        ->first(); 


        $orderEdit =OrderEditID::select('*','order_edit_i_d_s.id as orderEditId')
        ->join('orders','order_edit_i_d_s.order_id','=','orders.id')
        ->get();

        //instruction
        $orderInstruction = Order::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.order_id','=','orders.id')
        ->where('instructions.order_id',$order->order_id)
        ->first();

        return view('admin/orders/show',compact(
            'order',
            'orderEdit',
            'orderInstruction'
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
