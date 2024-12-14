<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\VectorRequiredFormat;
use App\Models\VectorOrder;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use App\Models\VectorEditID;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Auth;
use App\Models\VectorDetail;
use App\Models\PricingCriteria;
use App\Models\JobInformation;
use App\Models\InvoiceDetail;

class AllVectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/allvectors';
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
        'statuses.name as status',
        'admins.name as designer_name',
        'vector_orders.created_at as createdAt'
        )
        ->join('users','vector_orders.customer_id','=','users.id')
        ->join('statuses','vector_orders.status_id','statuses.id')
        ->leftjoin('admins','vector_orders.designer_id','=','admins.id')
        ->orderBy('design_name','asc')
        ->get();

      

        return view('admin/vector-orders/index',
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

      

        return view('admin/vector-orders/today',
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
    ->where('job_information.order_id',$id)
    ->first();


         
         $invoice_status = InvoiceDetail::select('*','invoices.invoice_status as invoiceStatus')
         ->join('invoices','invoice_details.invoice_id','=','invoices.id')
         ->where('invoice_details.vector_id',$id)
         ->first();


        return view('admin/vector-orders/show',compact(
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

    //process vector order
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
 




        return view('admin/vector-orders/process', compact(
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

    //send email process quotes
    public function sendEmailAndOrder(Request $request)
    {

         //order
         $order = VectorOrder::where('id',$request->order_id)->first();

         //job process
         $job = JobInformation::updateOrCreate(
         ['vector_id' => $request->order_id], // Condition to check if the record exists
         [
            
             'price_A' => $request->price_A,
             'price_B' => $request->price_B,
             'total' => $request->total
         ]
        );
      
        //relased o9rders
        $order->update(['status_id' => 1]);

        return redirect()->route('allvectors.show',$request->order_id)->with('success', 'Vector Order updated successfully!');


    }


      //assign designer
      public function assignDesigner(Request $request, $id)
      {
          $request->validate([
              'designer_id' => 'required|exists:admins,id', // Adjust according to your leaders table
          ]);
  
          $order = VectorOrder::findOrFail($id);
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
          $instruction = Instruction::where('vector_id', $request->order_id)
              ->where('cust_id', $request->customer_id)
              ->first();
  
          if ($instruction) {
              // If it exists, update the instruction
              $instruction->description = $request->instruction;
              //   $instruction->emp_id = Auth::id(); // Update emp_id if necessary
              $instruction->save();
  
              return redirect()->back()->with('success', 'Instruction updated successfully!');
          } else {
              // If it doesn't exist, create a new instruction
              $instruction = new Instruction();
              $instruction->cust_id = $request->customer_id;
              //$instruction->emp_id = Auth::id(); // Get the authenticated employee ID
              $instruction->description = $request->instruction;
              $instruction->vector_id = $request->order_id;
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
                                    ->where('instructions.vector_id',$request->order_id)
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
              $instruction->vector_id = $request->order_id;
              $instruction->save();
          
  
              return redirect()->back()->with('success', 'Admin instruction created successfully!');
          }
      }
  
      public function storeFile(Request $request)
      {
          // Validate the incoming request
        //   $request->validate([
        //       'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif|max:2048',
        //   ]);


        // Validate the uploaded files for filesB
      $request->validate([
        'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif,cdr,cnd,dsb,dst,dsz,emb,exp,jef,ksm,ofm,pes,pof,tap,xxx,others|max:262144', // 256MB = 262144 KB
    ]);

      
          // Handle file uploads
          if ($request->hasFile('files')) {
              // Store new files
              foreach ($request->file('files') as $file) {
                  $filePath = $file->store('/uploads/vector-order', 'public');
      
                  // Get the original filename
                  $originalFilename = $file->getClientOriginalName();

                    //order id for upload 
                 $orderID = $request->input('order_id');

                 $orderNo = 'VO-'.$orderID.'-'.$originalFilename;


      
                  // Create a structured string to store both path and original filename
                  $fileData = [
                      'path' => $filePath,
                      'original_name' => $orderNo,
                  ];
      
                  QuoteFileLog::create([
                      'vector_order_id' => $request->order_id,
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


       //deleteFileA

     public function deleteFileA(Request $request)
     {
         $request->validate([
             'file_id' => 'required|integer|exists:options,id',
         ]);
 
         // Find the file entry in the database
         $fileLog = Option::find($request->file_id);
        
 
         if ($fileLog) {
             // Decode the file path from JSON
             $fileData = json_decode($fileLog->file_upload, true);
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


      //deleteFileA

      public function deleteFileB(Request $request)
      {
          $request->validate([
              'file_id' => 'required|integer|exists:options,id',
          ]);
  
          // Find the file entry in the database
          $fileLog = Option::find($request->file_id);
         
  
          if ($fileLog) {
              // Decode the file path from JSON
              $fileData = json_decode($fileLog->file_upload, true);
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
  
      //update status
      public function orderStatus(Request $request)
      {
          // Validate the incoming request data
          $validatedData = $request->validate([
              'customer_id' => 'required|integer',
              'order_id' => 'required|integer|exists:vector_orders,id', // Ensure the order ID exists
              'order_status' => 'required|integer', // Add more validation based on your statuses
          ]);
  
          // Find the order by its ID
          $order = VectorOrder::find($validatedData['order_id']);

       
          if ($order) {
              // Update the order status
              $order->vector_status = $validatedData['order_status'];
              $order->save(); // Save the changes
           
              // Redirect back to the previous page
            
              return redirect()->back()->with('success', 'Vector status updated successfully!');
  
          } else {
              
              // Redirect back with error message
            
              return redirect()->back()->with('error', 'Vector not found.');
  
          }
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


        return view('admin/vector-orders/edit',compact(
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
                        'cust_id'=>$request->customer_id,
                        'emp_id' => Auth::id(),
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
            
           // return redirect()->route('allvectors.edit', $order->id)->with('success', 'Vector updated successfully!');

           return redirect()->route('allvectors.index')->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            //\Log::error('Error updating Vector: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while updating the Vector.']);
        }
    }

    
    //optionA
    public function storeOptionA(Request $request)
    {
        // Validate the incoming request
        // $request->validate([
        //     'filesA.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif|max:2048',
        // ]);

         // Validate the uploaded files for filesB
      $request->validate([
        'filesA.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif,cdr,cnd,dsb,dst,dsz,emb,exp,jef,ksm,ofm,pes,pof,tap,xxx,others|max:262144', // 256MB = 262144 KB
    ]);


        // Handle file uploads
        if ($request->hasFile('filesA')) {
            // Store new files
            foreach ($request->file('filesA') as $file) {
                $filePath = $file->store('/uploads/vector-option/A', 'public');

                // Get the original filename
                $originalFilename = $file->getClientOriginalName();

                    //order id for upload 
                    $orderID = $request->input('order_id');

                    $orderNo = 'VO-'.$orderID.'-'.$originalFilename;


                // Create a structured string to store both path and original filename
                $fileData = [
                    'path' => $filePath,
                    'original_name' => $orderNo,
                ];

                Option::create([
                    'role_id' => Auth::User()->role_id,
                    'employee_id' => Auth::id(),
                    'vector_order_id' => $request->order_id,
                    'option_type' => 'A',
                    'comment' => $request->commentA,
                    'file_upload' => json_encode($fileData),
                ]);
            }

            return redirect()->back()->with('success', 'Files uploaded successfully!');
        }

        return redirect()->back()->with('error', 'No files uploaded.');
    }

    //optionB
    public function storeOptionB(Request $request)
    {
        // Validate the incoming request
// Validate the incoming request
        // $request->validate([
        //     'filesB.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif|max:2048',
        // ]);

        // Validate the uploaded files for filesB
      $request->validate([
        'filesB.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif,cdr,cnd,dsb,dst,dsz,emb,exp,jef,ksm,ofm,pes,pof,tap,xxx,others|max:262144', // 256MB = 262144 KB
    ]);


        // Handle file uploads
        if ($request->hasFile('filesB')) {
            // Store new files
            foreach ($request->file('filesB') as $file) {
                $filePath = $file->store('/uploads/vector-option/B', 'public');

                // Get the original filename
                $originalFilename = $file->getClientOriginalName();

                 //order id for upload 
                 $orderID = $request->input('order_id');

                 $orderNo = 'VO-'.$orderID.'-'.$originalFilename;



                // Create a structured string to store both path and original filename
                $fileData = [
                    'path' => $filePath,
                    'original_name' => $orderNo,
                ];

                Option::create([
                    'role_id' => Auth::User()->role_id,
                    'employee_id' => Auth::id(),
                    'vector_order_id' => $request->order_id,
                    'option_type' => 'B',
                    'comment' => $request->commentB,
                    'file_upload' => json_encode($fileData),
                ]);
            }

            return redirect()->back()->with('success', 'Files uploaded successfully!');
        }

        return redirect()->back()->with('error', 'No files uploaded.');
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
