<?php

namespace App\Http\Controllers\customer;

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

use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/customer/orders';
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
        ->where('customer_id',Auth::id())
        ->get();

        $orderEdit =OrderEditID::select('*','order_edit_i_d_s.id as orderEditId')
        ->join('orders','order_edit_i_d_s.order_id','=','orders.id')
        ->get();
        return view('customer/orders/index',['orders'=>$orders,'orderEdit'=>$orderEdit]);
    }

    public function todayDayQuote()
    {
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'orders.name as design_name',
        'delivery_types.type as deliveryType'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('delivery_types','orders.delivery_type_id','delivery_types.id')
        ->where('customer_id',Auth::id())
        ->whereDate('orders.created_at', today())
        ->get();

        $orderEdit =OrderEditID::select('*','order_edit_i_d_s.id as orderEditId')
        ->join('orders','order_edit_i_d_s.order_id','=','orders.id')
        ->get();
        
        return view('customer.orders.today', ['orders' => $orders,'orderEdit'=>$orderEdit]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      


        $requiredFormat = RequiredFormat::all();
        $fabric = Fabric::all();
        $placement = Placement::all();
       
        return view('customer/orders/add',
        compact(
            'requiredFormat',
            'fabric',
            'placement',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            $quote = Order::create([
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
                'delivery_type_id' =>$request->delivery_type,
                
            ]);

            // Handle file uploads
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        // Store the file and get its path
                        $filePath = $file->store('uploads/quotes', 'public'); // Store in public/uploads/quotes
                        
                        // Insert into QuoteFileLog
                        QuoteFileLog::create([
                            'order_id' => $quote->id,
                            'cust_id' => $request->customer_id,
                            'files' => $filePath,
                        ]);
                    }
                }

                
                //check additonal fields
                if($request->filled('additional_instruction')){
                    Instruction::create([
                        'cust_id' => $request->customer_id,
                        'description' => $request->additional_instruction,
                        'order_id' => $quote->id,
                    ]);
                }


            // Commit the transaction
            DB::commit();
            
            $request->session()->flash('order',$request['name']);

            return redirect()->route('orders.index')->with('success', 'Order created successfully!');
            
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
           // DB::rollBack();
            
            // Log the error
            \Log::error('Error creating Order: ' . $e->getMessage());

            // Redirect back with error message
            return back()->withErrors(['error' => 'An error occurred while creating the Order.']);
        }
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
        ->where('customer_id', Auth::id())
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

        return view('customer/orders/show',compact(
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
        $order = Order::findOrFail($id);

        $requiredFormat = RequiredFormat::all();
        $fabric = Fabric::all();
        $placement = Placement::all();
       
       

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
       
        ->where('customer_id', Auth::id())
        ->where('orders.id', $order->id) 
        ->first(); 

        //order files
        $quoteFiles =QuoteFileLog::select('*')
        ->join('orders','quote_file_logs.order_id','=','orders.id')
        ->where('quote_file_logs.order_id',$order->order_id)
        ->get();

        //instruction
        $orderInstruction = Order::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.order_id','=','orders.id')
        ->where('instructions.order_id',$order->order_id)
        ->first();


        return view('customer/orders/edit',compact(
            'order',
            'quoteFiles',
            'requiredFormat',
            'fabric',
            'orderInstruction',
            'placement'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
    
        DB::beginTransaction();
        $order = Order::findOrFail($id);
    
        try {
            $order->update([
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
    

            //order edit Id
            $orderId =  new OrderEditID();
            $orderId->order_id = $order->id;
            $orderId->save();

            // Handle file uploads
            if ($request->hasFile('files')) {
                // Fetch and delete existing files
                $existingFiles = QuoteFileLog::where('order_id', $order->id)->get();
                foreach ($existingFiles as $fileLog) {
                    Storage::disk('public')->delete($fileLog->files);
                    $fileLog->delete();
                }
    
                // Store new files
                foreach ($request->file('files') as $file) {
                    $filePath = $file->store('uploads/quotes', 'public');
                    QuoteFileLog::create([
                        'order_id' => $order->id,
                        'cust_id' => Auth::id(),
                        'files' => $filePath,
                    ]);
                }
            }
    
            // Update additional instructions
            if ($request->filled('additional_instruction')) {
                Instruction::updateOrCreate(
                    ['order_id' => $order->id],
                    ['description' => $request->additional_instruction]
                );
            }
    
            DB::commit();
            
            //return redirect()->route('orders.edit', $order->id)->with('success', 'Order updated successfully!');
            return redirect()->route('orders.index')->with('success', 'Order updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating Order: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while updating the Order.']);
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
