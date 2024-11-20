<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\Quote;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;

use App\Models\Country;
use App\Models\CustomerBillInfo;
use App\Models\CardType;

use App\Models\RequiredFormat;
use App\Models\Fabric;
use App\Models\Placement;
use App\Models\Admin;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;


use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupportCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $redirectTo = '/customers';
     public function __construct()
     {
         $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
     }
 

    public function index()
    {
        //
    }

    public function allCustomer()
    {
        //
        $customers = User::all();
        return view('support.customers.allcustomer',[
            'customers'=>$customers
        ]);

    }

    public function showPanel(string $id)
    {
        $user = User::find($id);
        return view('support.customers.customer-dashboard.dashboard',compact('user'));
    }

     //showAllQuotes from Admin
     public function allQuotes(string $id)
     {
         $user = User::find($id);
       
         $quotes = Quote::select('*',
         'quotes.id as order_id',
         'users.name as customer_name',
         'quotes.name as design_name',
         'statuses.name as status',
         'admins.name as designer_name'
         )
         ->join('users','quotes.customer_id','=','users.id')
         ->join('statuses','quotes.status_id','statuses.id')
         ->leftjoin('admins','quotes.designer_id','=','admins.id')
         ->where('customer_id',$user->id)
         ->where('quotes.delete_status',0)
         ->orderBy('design_name','ASC')
         ->get();
     
         //convertQuotes
         $quoteConvertedOrder = Order::select('*','orders.quote_id as orderQuoteId')
         ->join('quotes','orders.quote_id','=','quotes.id')
         ->where('orders.customer_id',$user->id)
         ->get();
 
        
 
         return view('supoort/customers/quotes/index',compact('user'),
         [
         'quotes'=>$quotes,   
         'quoteConvertedOrder' => $quoteConvertedOrder 
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
