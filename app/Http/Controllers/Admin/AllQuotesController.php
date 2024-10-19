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
use Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

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
        'statuses.name as status'
        )
        ->join('users','quotes.customer_id','=','users.id')
        ->join('statuses','quotes.status_id','statuses.id')
        ->orderBy('design_name','ASC')
        ->get();

       

        //convertQuotes
        $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
        ->join('quotes','orders.quote_id','=','quotes.id')
        ->get();


        return view('admin/quotes/index',
        [
        'quotes'=>$quotes,   
        'quoteConvertedOrder' => $quoteConvertedOrder 
        ]);
    }

    public function todayDayQuote()
    {
        $quotes = Quote::select('*', 
        'quotes.id as order_id', 
        'users.name as customer_name', 
        'quotes.name as design_name')
            ->join('users', 'quotes.customer_id', '=', 'users.id')
            ->whereDate('quotes.created_at', today()) 
            ->get();

      
        return view('admin.quotes.today', ['quotes' => $quotes]);
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
