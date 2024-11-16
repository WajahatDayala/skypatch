<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\VectorRequiredFormat;
use App\Models\VectorOrder;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use App\Models\VectorEditID;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Auth;

class VectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/customer/vector-orders';
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    public function index()
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
        ->where('customer_id',Auth::id())
        ->orderBy('design_name','asc')
        ->get();

      

        return view('customer/vector-orders/index',
        [
            'orders'=>$orders
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $requiredFormat = VectorRequiredFormat::all();
       
       
        return view('customer/vector-orders/add',
        compact(
            'requiredFormat'
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
            'required_format_id' => 'required'
           
        ], [
            'name.required' => 'Name is required.',
            'required_format_id.required' => 'Format is required.'
           
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new Order
            $order = VectorOrder::create([
                'customer_id' => $request->customer_id, // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'status_id' => $request->status,
                'name' => $request->name,
                'number_of_colors' => $request->number_of_colors,
                'super_urgent' => $request->has('super_urgent'),
            ]);

            // Handle file uploads
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        // Store the file and get its path
                        $filePath = $file->store('uploads/vector-order', 'public'); // Store in public/uploads/quotes
                        
                              // Get the original filename
                 $originalFilename = $file->getClientOriginalName();
     
                 // Create a structured string to store both path and original filename
                 $fileData = [
                     'path' => $filePath,
                     'original_name' => $originalFilename,
                 ];
                        // Insert into QuoteFileLog
                        QuoteFileLog::create([
                            'vector_order_id' => $order->id,
                            'cust_id' => $request->customer_id,
                            'files' => json_encode($fileData),
                        ]);
                    }
                }

                //check additonal fields
                if($request->filled('additional_instruction')){
                    Instruction::create([
                        'cust_id' => $request->customer_id,
                        'description' => $request->additional_instruction,
                        'vector_id' => $order->id,
                    ]);
                }


            // Commit the transaction
            DB::commit();
            
            $request->session()->flash('order',$request['name']);

            return redirect()->route('vector-orders.index')->with('success', 'Order created successfully!');
            
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollBack();
            
            // Log the error
           // \Log::error('Error creating Order: ' . $e->getMessage());

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
        $order = VectorOrder::findOrFail($id);

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
        ->where('customer_id', Auth::id())
        ->where('vector_orders.id', $order->id) 
        ->first(); 


        $orderVectorEdit =VectorEditID::select('*','vector_edit_i_d_s.id as orderEditId')
        ->join('vector_orders','vector_edit_i_d_s.vector_order_id','=','vector_orders.id')
        ->get();

        //instruction
        $orderInstruction = VectorOrder::select('*','instructions.description as instruction') 
        ->leftjoin('instructions','instructions.vector_id','=','vector_orders.id')
        ->where('instructions.vector_id',$order->order_id)
        ->first();

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


        return view('customer/vector-orders/show',compact(
            'order',
            'orderVectorEdit',
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
        ->where('customer_id', Auth::id())
        ->where('vector_orders.id', $order->id) 
        ->first(); 

        //order files
        $quoteFiles =QuoteFileLog::select('*')
        ->join('vector_orders','quote_file_logs.vector_order_id','=','vector_orders.id')
        ->where('quote_file_logs.vector_order_id',$order->order_id)
        ->get();

       
         //instruction
         $orderInstruction = VectorOrder::select('*','instructions.description as instruction') 
         ->leftjoin('instructions','instructions.vector_id','=','vector_orders.id')
         ->where('instructions.vector_id',$order->order_id)
         ->first();


        return view('customer/vector-orders/edit',compact(
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
         // Validate the request
         $validatedData = $request->validate([
            'name' => 'required',
            'required_format_id' => 'required'
        ], [
            'name.required' => 'Name is required.',
            'required_format_id.required' => 'Format is required.'
        ]);
    
        DB::beginTransaction();
        $order = VectorOrder::findOrFail($id);

        //status update 
        $order->update(['edit_status' => 0]);
    
        try {
            // $order->update([
            //     'required_format_id' => $request->required_format_id,
            //     'status_id' => $request->status,
            //     'name' => $request->name,
            //     'number_of_colors' => $request->number_of_colors,
            //     'super_urgent' => $request->has('super_urgent'),
            // ]);
    
                      
        if ($order->order_id == null) {

            $order = VectorOrder::create([
                'customer_id' => $request->customer_id, // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'edit_vector_id' => $order->id,
                'edit_status' => 1,
                'description' => $request->desc . '(' . 'VO-' . $order->id.')',
                'status_id' => $request->status,
                'name' => $request->name,
                'number_of_colors' => $request->number_of_colors,
                'super_urgent' => $request->has('super_urgent'),

            ]);

        }
        else{

            $order = VectorOrder::create([
                'customer_id' => $request->customer_id, // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'edit_vector_id' => $order->id,
                'edit_status' => 1,
                'description' => $request->desc . '(VO-' . (string)$id . '),(VO-' . (string)$order->id . ')',
                'status_id' => $request->status,
                'name' => $request->name,
                'number_of_colors' => $request->number_of_colors,
                'super_urgent' => $request->has('super_urgent'),

            ]);


        }
        

            // Handle file uploads
            if ($request->hasFile('files')) {
                // Fetch and delete existing files
                $existingFiles = QuoteFileLog::where('vector_order_id', $order->id)->get();
                foreach ($existingFiles as $fileLog) {
                    Storage::disk('public')->delete($fileLog->files);
                    $fileLog->delete();
                }
    
                // Store new files
                foreach ($request->file('files') as $file) {
                    $filePath = $file->store('uploads/vector-order', 'public');

                        // Get the original filename
                 $originalFilename = $file->getClientOriginalName();
     
                 // Create a structured string to store both path and original filename
                 $fileData = [
                     'path' => $filePath,
                     'original_name' => $originalFilename,
                 ];

                    QuoteFileLog::create([
                        'vector_order_id' => $order->id,
                        'cust_id' => Auth::id(),
                        'files' => json_encode($fileData),
                    ]);
                }
            }
    
            // Update additional instructions
            if ($request->filled('additional_instruction')) {
                Instruction::updateOrCreate(
                    ['vector_id' => $order->id],
                    ['description' => $request->additional_instruction]
                );
            }
    
            DB::commit();
            
           // return redirect()->route('vector-orders.edit', $order->id)->with('success', 'Order updated successfully!');

           return redirect()->route('vector-orders.index')->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            //\Log::error('Error updating Order: ' . $e->getMessage());
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
