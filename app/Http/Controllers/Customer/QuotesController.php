<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Quote;
use App\Models\QuoteFileLog;
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
        $quotes = Quote::select('*','quotes.id as order_id','users.name as customer_name','quotes.name as design_name')
        ->join('users','quotes.customer_id','=','users.id')
        ->where('customer_id',Auth::id())
        ->get();
        return view('customer/quotes/index',['quotes'=>$quotes]);
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
            'placement'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'required_format_id' => 'required|exists:required_formats,id',
        //     'fabric_id' => 'required|exists:fabrics,id',
        //     'placement_id' => 'required|exists:placements,id',
        //     'height' => 'nullable|numeric',
        //     'width' => 'nullable|numeric',
        //     'number_of_colors' => 'nullable|integer',
        //     'additional_instruction' => 'nullable|string',
        //     'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf', // Validate multiple files
        //     'super_urgent' => 'boolean',
        // ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new Quote
            $quote = Quote::create([
                'customer_id' => Auth::id(), // Get the authenticated user's ID
                'required_format_id' => $request->required_format_id,
                'fabric_id' => $request->fabric_id,
                'placement_id' => $request->placement_id,
                'name' => $request->name,
                'height' => $request->height,
                'width' => $request->width,
                'number_of_colors' => $request->number_of_colors,
                'additional_instruction' => $request->additional_instruction,
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
                            'files' => $filePath,
                        ]);
                    }
                }

            // Commit the transaction
            DB::commit();

            return redirect()->route('quotes.index')->with('success', 'Quote created successfully!');
            
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollBack();
            
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

        $quote = Quote::select('*', 'quotes.id as order_id', 'users.name as customer_name', 'quotes.name as design_name')
        ->join('users', 'quotes.customer_id', '=', 'users.id')
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
