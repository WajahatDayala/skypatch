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
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Auth;

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
        'admins.name as designerName',
        'orders.name as design_name',
        'statuses.name as status',
        'orders.created_at as createdAt'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('statuses','orders.status_id','statuses.id')
        ->leftjoin('admins','orders.designer_id','=','admins.id')
        ->orderBy('design_name','ASC')
        ->get();

       
        return view('admin/orders/index',['orders'=>$orders]);
    }

    public function todayDayOrders()
    {
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'admins.name as designerName',
        'orders.name as design_name',
        'delivery_types.type as deliveryType',
        'statuses.name as status',
        'orders.created_at as createdAt'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('delivery_types','orders.delivery_type_id','delivery_types.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->leftjoin('admins','orders.designer_id','=','admins.id')
        ->whereDate('orders.created_at', today())
        ->orderBy('orders.id','Asc')
        ->get();

    
        
        return view('admin.orders.today', ['orders' => $orders]);
    }
    public function todayDayEditOrders()
    {
        $orders = Order::select('*',
        'orders.id as order_id',
        'users.name as customer_name',
        'admins.name as designerName',
        'orders.name as design_name',
        'delivery_types.type as deliveryType',
        'orders.created_at as createdAt'
        )
        ->join('users','orders.customer_id','=','users.id')
        ->join('delivery_types','orders.delivery_type_id','delivery_types.id')
        ->leftjoin('admins','orders.designer_id','admins.id')
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
        'admins.id as designer_id',
        'admins.name as designer_name',
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
        ->leftjoin('admins','orders.designer_id','=','admins.id')
        ->where('orders.id', $order->id) 
        ->first(); 


     

        //instruction
        $orderInstruction = Order::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.order_id','=','orders.id')
        ->where('instructions.order_id',$order->order_id)
        ->first();


        //admin instruction
        $adminInstruction = Order::select('*','instructions.description as instruction') 
        ->join('instructions','instructions.order_id','=','orders.id')
        ->leftjoin('admins','instructions.emp_id','admins.id')
        ->leftjoin('roles','admins.role_id','roles.id')
        ->where('instructions.order_id',$order->order_id)
        ->where('roles.name','Admin')
        ->first();

        //files
        $orderFiles =QuoteFileLog::select('*')->where('order_id',$order->order_id)->get();
    


        //designer
        $designer = Admin::select('*','admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
        ->join('roles', 'admins.role_id', '=', 'roles.id')
        ->whereIn('roles.name',
         ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
        ->get();




        return view('admin/orders/show',compact(
            'order',
            'designer',
            'orderFiles',
            'orderInstruction',
            'adminInstruction'
        ));
    }
        //assign designer
        public function assignDesigner(Request $request, $id)
        {
            $request->validate([
                'designer_id' => 'required|exists:admins,id', // Adjust according to your leaders table
              ]);
        
              $order = Order::findOrFail($id);
              $order->designer_id = $request->designer_id;
              $order->save();
        
             return redirect()->back()->with('success', 'Leader assigned successfully!');
        }


        //add customer instruction..
        public function storeInstruction(Request $request)
        {
                 // Validate the incoming request data
        $request->validate([
            'customer_id' => 'required|integer',
            'order_id' => 'required|integer',
            'instruction' => 'required|string',
        ]);

        // Check if the instruction already exists for this customer and order
        $instruction = Instruction::where('order_id', $request->order_id)
                                  ->where('cust_id', $request->customer_id)
                                  ->first();

        if ($instruction) {
            // If it exists, update the instruction
            $instruction->description = $request->instruction;
         //   $instruction->emp_id = Auth::id(); // Update emp_id if necessary
            $instruction->save();

            return redirect()->back()->with('success', 'Instruction updated successfully!');
        } 
        else {
            // If it doesn't exist, create a new instruction
            $instruction = new Instruction();
            $instruction->cust_id = $request->customer_id;
            //$instruction->emp_id = Auth::id(); // Get the authenticated employee ID
            $instruction->description = $request->instruction;
            $instruction->order_id = $request->order_id;
            $instruction->save();

            return redirect()->back()->with('success', 'Instruction created successfully!');
        }

    }

    //admin instruction
    public function storeAdminInstruction(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'order_id' => 'required|integer',
            'admin_instruction' => 'required|string',
        ]);

        // Check if the instruction already exists for this customer and order
        $instruction = Instruction::where('instructions.emp_id',Auth::id())
                                  ->where('instructions.order_id',$request->order_id)
                                  ->first();
                                 

        if ($instruction) {
            // If it exists, update the instruction
            $instruction->description = $request->admin_instruction;
           // $instruction->emp_id = Auth::id(); // Update emp_id if necessary
            $instruction->save();

            return redirect()->back()->with('success', 'Admin instruction updated successfully!');
        } else {
            // If it doesn't exist, create a new instruction
            $instruction = new Instruction();
            $instruction->cust_id = $request->customer_id;
            $instruction->emp_id = Auth::id(); // Get the authenticated employee ID
            $instruction->description = $request->admin_instruction;
            $instruction->order_id = $request->order_id;
            $instruction->save();
        

            return redirect()->back()->with('success', 'Admin instruction created successfully!');
        }
    }

    public function storeFile(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif|max:2048',
        ]);
    
        // Handle file uploads
        if ($request->hasFile('files')) {
            // Store new files
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('/uploads/quotes', 'public');
    
                // Get the original filename
                $originalFilename = $file->getClientOriginalName();
    
                // Create a structured string to store both path and original filename
                $fileData = [
                    'path' => $filePath,
                    'original_name' => $originalFilename,
                ];
    
                QuoteFileLog::create([
                    'order_id' => $request->order_id,
                    'cust_id' => $request->customer_id,
                    'emp_id' => Auth::id(),
                    'files' => json_encode($fileData),
                ]);
            }
    
            return redirect()->back()->with('success', 'Files uploaded successfully!');
        }
    
        return redirect()->back()->with('error', 'No files uploaded.');
    }
    

//delete FIle 
public function deleteFile(Request $request)
{
    $request->validate([
        'file_id' => 'required|integer|exists:quote_file_logs,id',
    ]);

    // Find the file entry in the database
    $fileLog = QuoteFileLog::find($request->file_id);

    if ($fileLog) {
        // Decode the file path from JSON
        $fileData = json_decode($fileLog->files, true);
        $filePath = $fileData['path'] ?? '';
        $fileName = basename($filePath); // Get the file name
        $fullPath = storage_path('app/public/' . $filePath); // Full path to the file

        // Check if the file exists and delete it
        if (file_exists($fullPath)) {
            unlink($fullPath);
        } else {
            return redirect()->back()->with('error', 'File does not exist.');
        }

        // Delete the database record
        $fileLog->delete();
        return redirect()->back()->with('success', 'File deleted successfully!');
    }

    return redirect()->back()->with('error', 'File deletion failed.');
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
