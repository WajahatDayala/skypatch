<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\Quote;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
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
       // $customers = User::all();
        
        // $customers = User::select("*",
        // 'users.name as customer_nick',
        // 'users.created_at as createdDate'
        
        // )
        // ->join('orders','orders.customer_id','=','orders.id')
        // ->get();
      
        $customers = User::select(
            'users.id', // User ID
            'users.name as customer_nick', // Customer nickname
            'users.contact_name', // Contact person
            'users.company_name', // Company name
            'users.phone', // Phone number
            'users.email', // Email address
            'users.created_at as createdDate', // Registration date
            'users.reference', // Reference field
            DB::raw('COUNT(orders.id) as order_count'), // Count of orders
            DB::raw('COUNT(quotes.id) as quote_count'), // Count of quotes
            DB::raw('COUNT(vector_orders.id) as vector_order_count') // Count of vector orders
        )
        ->join('orders', 'orders.customer_id', '=', 'users.id')
        ->leftJoin('quotes', 'quotes.customer_id', '=', 'users.id')
        ->leftJoin('vector_orders', 'vector_orders.customer_id', '=', 'users.id')
        ->where('orders.status_id', '=', 2)
        ->where('quotes.status_id', '=', 2)
        ->where('vector_orders.status_id', '=', 2)
        ->groupBy('users.id', 'users.name', 'users.contact_name', 'users.company_name', 'users.phone', 'users.email', 'users.created_at', 'users.reference') // Include reference in group by
        ->get();

    
    
    
    

      




       return view('admin.customers.index',[
            'customers'=>$customers
        ]);

    }

    public function allCustomer()
    {
        //
        $customers = User::all();
        return view('admin.customers.allcustomer',[
            'customers'=>$customers
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
