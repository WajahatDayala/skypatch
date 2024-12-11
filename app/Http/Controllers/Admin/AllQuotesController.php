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
use App\Models\ReasonEdit;
use App\Models\Option;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\VectorDetail;
use App\Models\JobInformation;
use App\Models\PricingCriteria;

use App\Mail\QuoteMail;
use Illuminate\Support\Facades\Mail;
use ZipArchive;
use App\Jobs\ProcessEmail;
use App\Jobs\TestEmailJob;
use App\Mail\TestMail;

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
        'employee.name as employeeName',
        'roles.name as employeeRole',
        'statuses.name as status',
        'quotes.created_at as createdAt'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->join('statuses','quotes.status_id','statuses.id')
        ->leftjoin('admins','quotes.designer_id','admins.id')
        ->leftjoin('admins as employee','quotes.support_user_id','=','employee.id')
        ->leftjoin('roles','employee.role_id','=','roles.id')
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

    public function toDayQuote()
    {
        $quotes = Quote::select('*',
        'quotes.id as order_id',
        'users.name as customer_name',
        'quotes.name as design_name',
        'admins.name as designer_name',
        'employee.name as employeeName',
        'statuses.name as status',
        'quotes.created_at as createdAt'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->join('statuses','quotes.status_id','statuses.id')
        ->leftjoin('admins','quotes.designer_id','admins.id')
        ->leftjoin('admins as employee','quotes.support_user_id','=','employee.id')
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

            //jobinfo
            $jobInfo = JobInformation::select('*')
            ->leftjoin('quotes','job_information.quote_id','=','quotes.id')
            ->where('job_information.quote_id',$id)
            ->first();
    

       

            //vector details
            $vectordetails = VectorDetail::select('*')
            ->leftjoin('users','vector_details.customer_id','=','users.id')
            ->where('vector_details.customer_id',$order->customer_id)
            ->first();

            



        return view('admin/quotes/show',compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction',
            'optionA',
            'optionB',
            'vectordetails',
            'jobInfo'
        ));
    }

     //assign designer
     public function assignDesigner(Request $request, $id)
     {
         $request->validate([
             'designer_id' => 'required|exists:admins,id', // Adjust according to your leaders table
         ]);
 
         $order = Quote::findOrFail($id);
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
         $instruction = Instruction::where('quote_id', $request->order_id)
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
             $instruction->quote_id = $request->order_id;
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
                                   ->where('instructions.quote_id',$request->order_id)
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
             $instruction->quote_id = $request->order_id;
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
                     'quote_id' => $request->order_id,
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
             'order_id' => 'required|integer|exists:quotes,id', // Ensure the order ID exists
             'order_status' => 'required|integer', // Add more validation based on your statuses
         ]);
 
         // Find the order by its ID
         $order = Quote::find($validatedData['order_id']);
 
         if ($order) {
             // Update the order status
             $order->quotes_status = $validatedData['order_status'];
             $order->save(); // Save the changes
             
             // Redirect back to the previous page
           
             return redirect()->back()->with('success', 'Quote status updated successfully!');
 
         } else {
             
             // Redirect back with error message
           
             return redirect()->back()->with('error', 'Quote not found.');
 
         }
     }

     
    //optionA
    public function storeOptionA(Request $request){
             // Validate the incoming request
             $request->validate([
                'filesA.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif|max:2048',
            ]);
        
            // Handle file uploads
            if ($request->hasFile('filesA')) {
                // Store new files
                foreach ($request->file('filesA') as $file) {
                    $filePath = $file->store('/uploads/options/A', 'public');
        
                    // Get the original filename
                    $originalFilename = $file->getClientOriginalName();
        
                    // Create a structured string to store both path and original filename
                    $fileData = [
                        'path' => $filePath,
                        'original_name' => $originalFilename,
                    ];
        
                    Option::create([
                        'role_id'=> Auth::User()->role_id,
                        'employee_id' => Auth::id(),
                        'quote_id' => $request->order_id,
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
    public function storeOptionB(Request $request){
        // Validate the incoming request
    // Validate the incoming request
    $request->validate([
        'filesB.*' => 'required|file|mimes:jpg,jpeg,png,pdf,avif|max:2048',
    ]);

    // Handle file uploads
    if ($request->hasFile('filesB')) {
        // Store new files
        foreach ($request->file('filesB') as $file) {
            $filePath = $file->store('/uploads/options/B', 'public');

            // Get the original filename
            $originalFilename = $file->getClientOriginalName();

            // Create a structured string to store both path and original filename
            $fileData = [
                'path' => $filePath,
                'original_name' => $originalFilename,
            ];

            Option::create([
                'role_id'=> Auth::User()->role_id,
                'employee_id' => Auth::id(),
                'quote_id' => $request->order_id,
                'option_type' => 'B',
                'comment' => $request->commentB,
                'file_upload' => json_encode($fileData),
            ]);
        }

        return redirect()->back()->with('success', 'Files uploaded successfully!');
    }

    return redirect()->back()->with('error', 'No files uploaded.');
}

     
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $quote = Quote::findOrFail($id);

        $requiredFormat = RequiredFormat::all();
        $fabric = Fabric::all();
        $placement = Placement::all();
       
       

        $quote = Quote::select('*', 
        'quotes.id as quote_id',
        'quotes.name as design_name',
        'users.name as customer_name', 
        'statuses.name as status',
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


        return view('admin/quotes/edit',compact(
            'quote',
            'quoteFiles',
            'requiredFormat',
            'fabric',
            'quoteInstruction',
            'placement'
        ));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        $quote = Quote::findOrFail($id);
    
        try {
      



            // Create a new Quote
            if ($quote->quote_id == null) {
                
                $quote->update(['edit_status' => 0]);

                $quote = Quote::create([
                    'customer_id' => $request->customer_id, // Get the authenticated user's ID
                    'required_format_id' => $request->required_format_id,
                    'fabric_id' => $request->fabric_id,
                    'placement_id' => $request->placement_id,
                    'status_id' => $request->status,
                    'quote_id_edit' => $quote->id,
                    'edit_status' => 1,
                    'description' => $request->desc . '(' . 'QT-' . $quote->id.')',
                    'name' => $request->name,
              
                    'height' => $request->height,
                    'width' => $request->width,
                    'number_of_colors' => $request->number_of_colors,
                    'super_urgent' => $request->has('super_urgent'),
                ]);
            } else {

                $quote->update(['edit_status' => 0]);
                $quote = Quote::create([
                    'customer_id' => $request->customer_id, // Get the authenticated user's ID
                    'required_format_id' => $request->required_format_id,
                    'fabric_id' => $request->fabric_id,
                    'placement_id' => $request->placement_id,
                    'status_id' => $request->status,
                    'quote_id_edit' => $quote->id,
                    'edit_status' => 1,
                    'description' => $request->desc . '(QT-' . (string)$id . '),(QT-' . (string)$quote->id . ')',
                    //'name' => $request->name . '(QT-'.''.$id.'),('.'QT-'.$quote->id.')',
                    'name' => $request->name,

                    'height' => $request->height,
                    'width' => $request->width,
                    'number_of_colors' => $request->number_of_colors,
                    'super_urgent' => $request->has('super_urgent'),
                ]);

            }
    

            //removed quote edit Id
            // $quoteId =  new QuoteEditID();
            // $quoteId->quote_id = $quote->id;
            // $quoteId->save();

            // Handle file uploads
            if ($request->hasFile('files')) {
                // Fetch and delete existing files
                $existingFiles = QuoteFileLog::where('quote_id', $quote->id)->get();
                foreach ($existingFiles as $fileLog) {
                    Storage::disk('public')->delete($fileLog->files);
                    $fileLog->delete();
                }
    
                // Store new files
                foreach ($request->file('files') as $file) {
                    $filePath = $file->store('uploads/quotes', 'public');

                        // Get the original filename
                $originalFilename = $file->getClientOriginalName();
    
                // Create a structured string to store both path and original filename
                $fileData = [
                    'path' => $filePath,
                    'original_name' => $originalFilename,
                ];
    

                    QuoteFileLog::create([
                        'quote_id' => $quote->id,
                        'cust_id'=>$request->customer_id,
                        'emp_id' => Auth::id(),
                        'files' => json_encode($fileData),
                    ]);
                }
            }
    
            // Update additional instructions
            if ($request->filled('additional_instruction')) {
                Instruction::updateOrCreate(
                    ['quote_id' => $quote->id],
                    ['description' => $request->additional_instruction]
                );
            }
    
            DB::commit();
            
           // return redirect()->route('allquotes.edit', $quote->id)->with('success', 'Quote updated successfully!');
            return redirect()->route('allquotes.index')->with('success', 'Quote updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
           // \Log::error('Error updating quote: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while updating the quote.']);
        }
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

        //jobinfo
        $jobInfo = JobInformation::select('*')
        ->leftjoin('quotes','job_information.quote_id','=','quotes.id')
        ->where('job_information.quote_id',$id)
        ->first();


        
        return view('admin/quotes/process',compact(
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
            'vectordetails',
            'jobInfo'
        ));
    }

    //send email process quotes
    public function sendEmailAndQuotes(Request $request)
    {

        //quotes
        $quote = Quote::where('id', $request->quote_id)->first();

        //   //job process
        $job = JobInformation::updateOrCreate(
            ['quote_id' => $request->quote_id], // Condition to check if the record exists
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


        $quote->update(['status_id' => 1]);

     // Collect form data
     $height_A = $request->input('height_A');
     $width_A = $request->input('width_A');
     $stitches_A = $request->input('stitches_A');
     $price_A = $request->input('price_A');
     $height_B = $request->input('height_B');
     $width_B = $request->input('width_B');
     $stitches_B = $request->input('stitches_B');
     $price_B = $request->input('price_B');
     $total = $request->input('total');
     $comment = $request->input('comment');
 
     // Collect selected files for Option A and Option B
     $filesA = $request->input('optionSendFilesA', []);  // Default to empty array if no files selected
     $filesB = $request->input('optionSendFilesB', []);  // Default to empty array if no files selected
 
     // Collect selected email addresses
     $emails = [];
     if ($request->has('gridCheckemail1')) {
         $emails[] = $request->input('gridCheckemail1');
     }
     if ($request->has('gridCheckemail2')) {
         $emails[] = $request->input('gridCheckemail2');
     }
     if ($request->has('gridCheckemail3')) {
         $emails[] = $request->input('gridCheckemail3');
     }
     if ($request->has('gridCheckemail4')) {
         $emails[] = $request->input('gridCheckemail4');
     }
     if ($request->has('gridCheckinvoiceemail')) {
         $emails[] = $request->input('gridCheckinvoiceemail');
     }
 
     // Correctly define the path for the ZIP file
     $zipFile = storage_path('app/public/quote_files.zip');  // Path to storage/app/public/quote_files.zip
     $zip = new ZipArchive();
 
     // Try to open the zip file
     if ($zip->open($zipFile, ZipArchive::CREATE) !== TRUE) {
         return back()->with('error', 'Unable to create ZIP file');
     }
 
     // Add files for Option A and Option B
     foreach ($filesA as $fileName) {
         $filePath = storage_path('app/public/' . $fileName);  // Correct path to files in storage/app/public
         if (file_exists($filePath)) {
             $zip->addFile($filePath, 'OptionA/' . basename($filePath));  // Use basename for file inside the ZIP
         }
     }
 
     foreach ($filesB as $fileName) {
         $filePath = storage_path('app/public/' . $fileName);  // Correct path to files in storage/app/public
         if (file_exists($filePath)) {
             $zip->addFile($filePath, 'OptionB/' . basename($filePath));  // Use basename for file inside the ZIP
         }
     }
 
     // Close the ZIP file
     $zip->close();
 
     // Check if the zip file size exceeds 256MB
     $maxFileSize = 256 * 1024 * 1024; // 256MB in bytes
     if (filesize($zipFile) > $maxFileSize) {
         // Remove the zip file after validation
         unlink($zipFile);
         return back()->with('error', 'The generated ZIP file exceeds the 256MB size limit and cannot be sent via email.');
     }
 
     // Prepare the email data
     $emailData = [
         'height_A' => $height_A,
         'width_A' => $width_A,
         'stitches_A' => $stitches_A,
         'price_A' => $price_A,
         'height_B' => $height_B,
         'width_B' => $width_B,
         'stitches_B' => $stitches_B,
         'price_B' => $price_B,
         'total' => $total,
         'comment' => $comment,
         'emails' => $emails,  // Add the emails array here
     ];
 
     // Check if emails are available
     if (!empty($emails)) {
         foreach ($emails as $email) {
             try {
                 // Send the email with the ZIP attachment
                 Mail::to($email)->send(new QuoteMail($emailData, $zipFile));  // Send the email with the ZIP attachment
 
                 // Optionally, you can dispatch a job for background processing if needed
                 ProcessEmail::dispatch($emailData, $zipFile);
             } catch (\Exception $e) {
                 // Log the error or handle it
                 // Log::error("Error sending email to $email: " . $e->getMessage());
             }
         }
     }
 
     // Clean up the zip file after sending the email
     if (file_exists($zipFile)) {
         unlink($zipFile); // Delete the zip file after sending email
     }

           return redirect()->route('allquotes.show',$request->quote_id)->with('success', 'Quote updated successfully!');


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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
       
    }

    //delete Quotes

    public function deleteQuotes(Request $request)
     {
         $request->validate([
             'quote_id' => 'required|exists:quotes,id', // Adjust according to your leaders table
         ]);
 
         $order = Quote::findOrFail($request->quote_id);
        //  $order->delete_status = 1;
        //  $order->support_user_id = Auth::id();
         $order->delete();

        //  $orderLast = Quote::orderBy('*', 'desc')->first(); // To get the latest quote by ID
        //  $orderLast->edit_status = 1;
         

 
         return redirect()->back()->with('success', 'Delete Successfully!');
     }
   

    //delete all quotes where id related history.. 
    // public function deleteQuotes(Request $request)
    // {
    //     // Log the entire request to examine the incoming data
    //     Log::info('Incoming Request:', $request->all());

    //     // Extract 'quote_id' from the request instead of 'id'
    //     $quoteId = $request->input('quote_id');  // Or use $request->quote_id

    //     // Find the quote by 'quote_id'
    //     $quote = DB::table('quotes')->where('id', $quoteId)->first();

    //     if ($quote) {
    //         // Extract IDs from description using regex
    //         preg_match_all('/QT-(\d+)/', $quote->description, $matches);
    //         $relatedIds = array_map('intval', $matches[1]);

    //         // Include the main ID in the deletion list
    //         $idsToDelete = array_merge([$quoteId], $relatedIds);

    //         // Log the IDs to be deleted
    //         Log::info('Deleting Quotes with IDs:', $idsToDelete);

    //         // Delete all rows matching the IDs
    //         DB::table('quotes')->whereIn('id', $idsToDelete)->delete();

    //         return response()->json([
    //             'message' => 'Related quotes deleted successfully.',
    //             'deleted_ids' => $idsToDelete
    //         ]);
    //     }

    //     Log::warning('Quote not found for ID:', ['quote_id' => $quoteId]);

    //     return response()->json(['message' => 'Quote not found.'], 404);
    // }

    // public function testMail() {
    //     // $to = "abc@gmail.com";
    //     // $msg ="test mail";
    //     // $subject="ads";
    //     // Mail::to($to)->send(new TestMail($msg,$subject));
    //     // Dispatch the job
    //     TestEmailJob::dispatch();

    //     return response()->json(['message' => 'Test email job has been dispatched.']);

    // }
    
    
}

