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
use App\Models\JobInformation;



use App\Mail\QuoteMail;
use Illuminate\Support\Facades\Mail;
//use ZipArchive;
use App\Jobs\ProcessEmail;


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

           //jobinfo
        $jobInfo = JobInformation::select('*')
        ->leftjoin('quotes','job_information.quote_id','=','quotes.id')
        ->where('job_information.quote_id',$id)
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
            'vectordetails',
            'jobInfo'
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
         'ordersStatus.name as order_status_name',
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
        ->leftjoin('statuses as ordersStatus', 'quotes.quotes_status', 'ordersStatus.id')
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
               'vectordetails',
               'jobInfo'
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



                                //jobinfo
        $jobInfo = JobInformation::select('*')
        ->leftjoin('quotes','job_information.quote_id','=','quotes.id')
        ->where('job_information.quote_id',$id)
        ->first();
   
   
   
   
           return view('admin/quotes/printview', compact(
               'order',
               'designer',
               'orderStatus',
               'orderFiles',
               'orderInstruction',
               'adminInstruction',
               'jobInfo'
           ));
       }


       //send email process quotes
       public function sendEmailAndQuotes(Request $request)
       {

            //quotes
            $quote = Quote::where('id',$request->quote_id)->first();

            //job process
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
            // Start creating the mail instance, passing emailData, filesA, and filesB
            $mail = new QuoteMail($emailData, $filesA, $filesB);

            // Send the email with attachments
            Mail::to($email)->send($mail);  // Send the email with attachments

            // Dispatch a job for background processing, passing all 3 arguments
            ProcessEmail::dispatch($emailData, $filesA, $filesB);

        } catch (\Exception $e) {
            // Log the error or handle it
            // Log::error("Error sending email to $email: " . $e->getMessage());
        }
    }
}


        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('supportquotes.show', $request->quote_id)->with('success', 'Quote updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {

            return redirect()->route('account-allquotes.show', $request->quote_id)->with('success', 'Quote created successfully!');
      
        } else if (Auth::user()->role->name == 'Sales') {

            return redirect()->route('sales-allquotes.show', $request->quote_id)->with('success', 'Quote created successfully!');
        }


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


        return view('support/quotes/edit',compact(
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
          //  return redirect()->route('allquotes.index')->with('success', 'Quote updated successfully!');
          if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('supportquotes.index')->with('success', 'Quote updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {

            return redirect()->route('account-allquotes.index')->with('success', 'Quote created successfully!');
        }
        else if (Auth::user()->role->name == 'Sales') {

        return redirect()->route('sales-allquotes.index')->with('success', 'Quote created successfully!');
        }


       
       
        } catch (\Exception $e) {
            DB::rollBack();
           // \Log::error('Error updating quote: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while updating the quote.']);
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
