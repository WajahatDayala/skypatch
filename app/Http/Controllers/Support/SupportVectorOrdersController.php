<?php

namespace App\Http\Controllers\Support;

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
class SupportVectorOrdersController extends Controller
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

      

        return view('support/vector-orders/index',
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
        ->where('vector_orders.delete_status',0)
        ->whereDate('vector_orders.created_at', today())
        ->get();

      

        return view('support/vector-orders/today',
        [
            'orders'=>$orders
           
        ]);

    }

    public function deleteOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:Vector_orders,id', // Adjust according to your leaders table
        ]);

        $order = VectorOrder::findOrFail($request->order_id);
        $order->delete_status = 1;
        $order->support_user_id = Auth::id();
        $order->save();

        return redirect()->back()->with('success', 'Delete Successfully!');
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
 

        return view('support/vector-orders/show',compact(
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







        return view('support/vector-orders/process', compact(
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
 
           //return redirect()->route('support-vector-orders.show',$request->order_id)->with('success', 'Vector Order updated successfully!');

        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('support-vector-orders.show', $request->order_id)->with('success', 'Order updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {

            return redirect()->route('account-allvectors.show', $request->order_id)->with('success', 'Order created successfully!');
        }

        else if (Auth::user()->role->name == 'Sales') {

            return redirect()->route('sales-allvectors.show', $request->order_id)->with('success', 'Order created successfully!');
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


        return view('support/vector-orders/edit',compact(
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

          // return redirect()->route('support-vector-orders.index')->with('success', 'Order updated successfully!');

            if (Auth::user()->role->name === 'Customer Support') {
                return redirect()->route('support-vector-orders.index')->with('success', 'Order updated successfully!');

            } else if (Auth::user()->role->name == 'Accounts') {

                return redirect()->route('account-allvectors.index')->with('success', 'Order created successfully!');
            }
            else if (Auth::user()->role->name == 'Sales') {

                return redirect()->route('sales-allvectors.index')->with('success', 'Order created successfully!');
            }



        } catch (\Exception $e) {
            DB::rollBack();
            //\Log::error('Error updating Vector: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while updating the Vector.']);
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
