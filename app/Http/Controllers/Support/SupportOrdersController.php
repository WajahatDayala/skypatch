<?php

namespace App\Http\Controllers\Support;

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
use App\Models\Option;
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\PricingCriteria;
use App\Models\VectorDetail;
use App\Models\JobInformation;

class SupportOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::select(
            '*',
            'orders.id as order_id',
            'users.name as customer_name',
            'admins.name as designerName',
            'orders.name as design_name',
            'statuses.name as status',
            'orders.created_at as createdAt'
        )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('statuses', 'orders.status_id', 'statuses.id')
            ->leftjoin('admins', 'orders.designer_id', '=', 'admins.id')
            ->where('orders.delete_status',0)
            ->orderBy('design_name', 'ASC')
            ->get();


        return view('support/orders/index', ['orders' => $orders]);
    }

    
    public function toDayOrders()
    {
        $orders = Order::select(
            '*',
            'orders.id as order_id',
            'users.name as customer_name',
            'admins.name as designerName',
            'orders.name as design_name',
            'delivery_types.type as deliveryType',
            'statuses.name as status',
            'orders.created_at as createdAt'
        )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('delivery_types', 'orders.delivery_type_id', 'delivery_types.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->leftjoin('admins', 'orders.designer_id', '=', 'admins.id')
            ->whereDate('orders.created_at', today())
            ->where('orders.delete_status',0)
            ->orderBy('orders.id', 'Asc')
            ->get();



        return view('support.orders.today', ['orders' => $orders]);
    }
    public function toDayEditOrders()
    {
        $orders = Order::select(
            '*',
            'orders.id as order_id',
            'users.name as customer_name',
            'admins.name as designerName',
            'orders.name as design_name',
            'statuses.name as status',
            'delivery_types.type as deliveryType',
            'orders.created_at as createdAt'
        )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('delivery_types', 'orders.delivery_type_id', 'delivery_types.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->leftjoin('admins', 'orders.designer_id', 'admins.id')
            ->whereNotNull('edit_order_id')
            ->whereDate('orders.created_at', today())
            ->where('orders.status_id', 1)
            ->where('orders.delete_status',0)
            ->get();



        return view('support.orders.today-edit', ['orders' => $orders]);
    }

        //delete Order

        public function deleteOrder(Request $request)
        {
            $request->validate([
                'order_id' => 'required|exists:orders,id', // Adjust according to your leaders table
            ]);
    
            $order = Order::findOrFail($request->order_id);
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
        $order = Order::findOrFail($id);

        $order = Order::select(
            '*',
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
            'orders.name as design_name'
        )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->join('fabrics', 'orders.fabric_id', '=', 'fabrics.id')
            ->join('placements', 'orders.placement_id', '=', 'placements.id')
            ->join('required_formats', 'orders.required_format_id', '=', 'required_formats.id')
            ->leftjoin('admins', 'orders.designer_id', '=', 'admins.id')
            ->leftjoin('statuses as ordersStatus', 'orders.order_status', 'ordersStatus.id')
            ->leftjoin('reason_edits', 'orders.edit_reason_id', 'reason_edits.id')
            ->where('orders.id', $order->id)
            ->first();

        //instruction
        $orderInstruction = Order::select('*', 'instructions.description as instruction')
            ->leftjoin('instructions', 'instructions.order_id', '=', 'orders.id')
            ->where('instructions.order_id', $id)
            ->first();


        //admin instruction
        $adminInstruction = Order::select('*', 'instructions.description as instruction')
            ->join('instructions', 'instructions.order_id', '=', 'orders.id')
            ->leftjoin('admins', 'instructions.emp_id', 'admins.id')
            ->leftjoin('roles', 'admins.role_id', 'roles.id')
            ->where('instructions.order_id', $id)
            ->where('roles.name', 'Admin')
            ->first();

        //files
        $orderFiles = QuoteFileLog::select('*', 'quote_file_logs.id as fileId')
            ->where('order_id', $id)->get();

        //order status
        $orderStatus = Status::where('status_value', 1)->get();

        //Allreasons
        $allReasons = ReasonEdit::all();


        //designer
        $designer = Admin::select('*', 'admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
            ->join('roles', 'admins.role_id', '=', 'roles.id')
            ->whereIn(
                'roles.name',
                ['Quote Worker', 'Order Worker', 'Vector Worker']
            )
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
            ->leftjoin('users', 'vector_details.customer_id', '=', 'users.id')
            ->where('vector_details.customer_id', $order->customer_id)
            ->first();


         //jobinfo
         $jobInfo = JobInformation::select('*')
         ->leftjoin('orders','job_information.order_id','=','orders.id')
         ->where('job_information.order_id',$id)
         ->first();
 


        


        return view('support/orders/show', compact(
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

    //process for order
    public function processOrder(string $id)
    {

        $order = Order::findOrFail($id);

        $order = Order::select(
            '*',
            'orders.id as order_id',
            'orders.name as design_name',
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
            'fabrics.name as fabric_name',
            'required_formats.name as format',
            'placements.name as placement',
            'users.name as customer_name',
            'orders.created_at as received_date',
            'reason_edits.reason as reason_name'
        )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->join('fabrics', 'orders.fabric_id', '=', 'fabrics.id')
            ->join('placements', 'orders.placement_id', '=', 'placements.id')
            ->join('required_formats', 'orders.required_format_id', '=', 'required_formats.id')
            ->leftjoin('admins', 'orders.designer_id', '=', 'admins.id')
            ->leftjoin('statuses as ordersStatus', 'orders.order_status', 'ordersStatus.id')
            ->leftjoin('reason_edits', 'orders.edit_reason_id', 'reason_edits.id')
            ->where('orders.id', $order->id)
            ->first();

        //instruction
        $orderInstruction = Order::select('*', 'instructions.description as instruction')
            ->leftjoin('instructions', 'instructions.order_id', '=', 'orders.id')
            ->where('instructions.order_id', $id)
            ->first();


        //admin instruction
        $adminInstruction = Order::select('*', 'instructions.description as instruction')
            ->join('instructions', 'instructions.order_id', '=', 'orders.id')
            ->leftjoin('admins', 'instructions.emp_id', 'admins.id')
            ->leftjoin('roles', 'admins.role_id', 'roles.id')
            ->where('instructions.order_id', $id)
            ->where('roles.name', 'Admin')
            ->first();

        //files
        $orderFiles = QuoteFileLog::select('*', 'quote_file_logs.id as fileId')
            ->where('order_id', $id)->get();

        //order status
        $orderStatus = Status::where('status_value', 1)->get();

        //Allreasons
        $allReasons = ReasonEdit::all();


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
         ->leftjoin('orders','job_information.order_id','=','orders.id')
         ->where('job_information.order_id',$id)
         ->first();
 




        return view('support/orders/process', compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction',
            'allReasons',
            'optionA',
            'optionB',
            'jobInfo',
            'vectordetails',
             'pricing'
        ));
    }

    public function printOrder(string $id)
    {

        $order = Order::findOrFail($id);

        $order = Order::select(
            '*',
            'orders.id as order_id',
            'orders.name as design_name',
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
            'orders.created_at as received_date',
            'reason_edits.reason as reason_name',
            'orders.name as design_name'
        )
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->join('fabrics', 'orders.fabric_id', '=', 'fabrics.id')
            ->join('placements', 'orders.placement_id', '=', 'placements.id')
            ->join('required_formats', 'orders.required_format_id', '=', 'required_formats.id')
            ->leftjoin('admins', 'orders.designer_id', '=', 'admins.id')
            ->leftjoin('statuses as ordersStatus', 'orders.order_status', 'ordersStatus.id')
            ->leftjoin('reason_edits', 'orders.edit_reason_id', 'reason_edits.id')
            ->where('orders.id', $order->id)
            ->first();

        //instruction
        $orderInstruction = Order::select('*', 'instructions.description as instruction')
            ->leftjoin('instructions', 'instructions.order_id', '=', 'orders.id')
            ->where('instructions.order_id', $id)
            ->first();


        //admin instruction
        $adminInstruction = Order::select('*', 'instructions.description as instruction')
            ->join('instructions', 'instructions.order_id', '=', 'orders.id')
            ->leftjoin('admins', 'instructions.emp_id', 'admins.id')
            ->leftjoin('roles', 'admins.role_id', 'roles.id')
            ->where('instructions.order_id', $id)
            ->where('roles.name', 'Admin')
            ->first();

        //files
        $orderFiles = QuoteFileLog::select('*', 'quote_file_logs.id as fileId')
            ->where('order_id', $id)->get();

        //order status
        $orderStatus = Status::where('status_value', 1)->get();

        //Allreasons
        $allReasons = ReasonEdit::all();


        //designer
        $designer = Admin::select('*', 'admins.id as designer_id', 'admins.name as designerName', 'roles.name as roles')
            ->join('roles', 'admins.role_id', '=', 'roles.id')
            ->whereIn(
                'roles.name',
                ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker']
            )
            ->get();




        return view('admin/orders/printview', compact(
            'order',
            'designer',
            'orderStatus',
            'orderFiles',
            'orderInstruction',
            'adminInstruction',
            'allReasons'
        ));
    }


      //send email process quotes
      public function sendEmailAndOrder(Request $request)
      {

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
        
          //relased o9rders
          $order->update(['status_id' => 1]);

        //  return redirect()->route('support-allorders.show',$request->order_id)->with('success', 'Order updated successfully!');

        if (Auth::user()->role->name === 'Customer Support') {
            return redirect()->route('support-allorders.show',$request->order_id)->with('success', 'Order updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {

            return redirect()->route('account-allorders.show', $request->order_id)->with('success', 'Order created successfully!');
        }
         else if (Auth::user()->role->name == 'Sales') {

            return redirect()->route('sales-allorders.show', $request->order_id)->with('success', 'Order created successfully!');
        }


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


        return view('support/orders/edit',compact(
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

             
            
        //status update 
        $order->update(['edit_status' => 0]);

            
        if ($order->order_id == null) {

            $order = order::create([
                'customer_id' => $request->customer_id, // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'fabric_id' => $request->fabric_id,
                'placement_id' => $request->placement_id,
                'edit_order_id' => $order->id,
                'edit_status' => 1,
                'description' => $request->desc . '(' . 'OR-' . $order->id.')',
                'status_id' => $request->status,
                'name' => $request->name,
                'height' => $request->height,
                'width' => $request->width,
                'number_of_colors' => $request->number_of_colors,
                'super_urgent' => $request->has('super_urgent'),

            ]);
        }
        else{
            $order = order::create([
                'customer_id' => $request->customer_id, // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'fabric_id' => $request->fabric_id,
                'placement_id' => $request->placement_id,
                'edit_order_id' => $order->id,
                'edit_status' => 1,
                
                'description' => $request->desc . '(OR-' . (string)$id . '),(OR-' . (string)$order->id . ')',
                'status_id' => $request->status,
                'name' => $request->name,
                'height' => $request->height,
                'width' => $request->width,
                'number_of_colors' => $request->number_of_colors,
                'super_urgent' => $request->has('super_urgent'),

            ]);
        }
           

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

                    // Get the original filename
                    $originalFilename = $file->getClientOriginalName();

        // Create a structured string to store both path and original filename
            $fileData = [
                        'path' => $filePath,
                        'original_name' => $originalFilename,
                        ];
                 
                    QuoteFileLog::create([
                        'order_id' => $order->id,
                        'cust_id' => Auth::id(),
                        'files' => json_encode($fileData),
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
            //return redirect()->route('support-allorders.index')->with('success', 'Order updated successfully!');

            if (Auth::user()->role->name === 'Customer Support') {
                return redirect()->route('support-allorders.index')->with('success', 'Order updated successfully!');
    
            } else if (Auth::user()->role->name == 'Accounts') {
    
                return redirect()->route('account-allorders.index')->with('success', 'Order updated successfully!');
            }
            else if (Auth::user()->role->name == 'Sales') {
    
                return redirect()->route('sales-allorders.index')->with('success', 'Order updated successfully!');
            }
    


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
