<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Quote;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use Validator;

use Illuminate\Support\Facades\DB;

use Auth;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/customer/quotes';
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
        'quotes.name as design_name'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->where('customer_id',Auth::id())
        ->get();
        return view('customer/quotes/index',['quotes'=>$quotes]);
    }

    public function todayDayQuote()
    {
        $quotes = Quote::select('*', 
        'quotes.id as order_id', 
        'users.name as customer_name', 
        'quotes.name as design_name')
            ->join('users', 'quotes.customer_id', '=', 'users.id')
            ->where('customer_id', Auth::id())
            ->whereDate('quotes.created_at', today()) 
            ->get();

        return view('customer.quotes.today', ['quotes' => $quotes]);
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
       
        return view('customer/quotes/add',
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
            $quote = Quote::create([
                'customer_id' => Auth::id(), // Get the authenticated user's ID
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

            // Handle file uploads
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        // Store the file and get its path
                        $filePath = $file->store('uploads/quotes', 'public'); // Store in public/uploads/quotes
                        
                        // Insert into QuoteFileLog
                        QuoteFileLog::create([
                            'quote_id' => $quote->id,
                            'cust_id' => Auth::id(),
                            'files' => $filePath,
                        ]);
                    }
                }

                //check additonal fields
                if($request->filled('additional_instruction')){
                    Instruction::create([
                        'cust_id' => Auth::id(),
                        'description' => $request->additional_instruction,
                        'quote_id' => $quote->id,
                    ]);
                }


            // Commit the transaction
            DB::commit();
            
            $request->session()->flash('quote',$request['name']);

            return redirect()->route('quotes.index')->with('success', 'Quote created successfully!');
            
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
           // DB::rollBack();
            
            // Log the error
            \Log::error('Error creating quote: ' . $e->getMessage());

            // Redirect back with error message
            return back()->withErrors(['error' => 'An error occurred while creating the quote.']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
      
        $quote = Quote::findOrFail($id);

        $quote = Quote::select('*', 
        'quotes.id as order_id',
        'quotes.name as design_name',
        'users.name as customer_name', 
        'statuses.name as status',
        'fabrics.name as fabric_name',
        'required_formats.name as format',
        'placements.name as placement',
        'users.name as customer_name',
        'instructions.description',
        'quotes.created_at as received_date',
        'quotes.name as design_name')
        ->join('users', 'quotes.customer_id', '=', 'users.id')
        ->join('statuses','quotes.status_id','=','statuses.id')
        ->join('fabrics','quotes.fabric_id','=','fabrics.id')
        ->join('placements','quotes.placement_id','=','placements.id')
        ->join('required_formats','quotes.required_format_id','=','required_formats.id')
        ->leftjoin('instructions','quotes.customer_id','=','instructions.cust_id')
        ->where('customer_id', Auth::id())
        ->where('quotes.id', $quote->id) 
        ->first(); 


        return view('customer/quotes/show',compact('quote'));
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
        'instructions.description',
        'quotes.created_at as received_date',
        'quotes.name as design_name')
        ->join('users', 'quotes.customer_id', '=', 'users.id')
        ->join('statuses','quotes.status_id','=','statuses.id')
        ->join('fabrics','quotes.fabric_id','=','fabrics.id')
        ->join('placements','quotes.placement_id','=','placements.id')
        ->join('required_formats','quotes.required_format_id','=','required_formats.id')
        ->leftjoin('instructions','quotes.customer_id','=','instructions.cust_id')
        ->where('customer_id', Auth::id())
        ->where('quotes.id', $quote->id) 
        ->first(); 




        return view('customer/quotes/edit',compact(
            'quote',
            'requiredFormat',
            'fabric',
            'placement'
        ));
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
