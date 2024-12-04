<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\VectorRequiredFormat;
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
use App\Models\PricingCriteria;
use App\Models\Option;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use App\Models\JobInformation;
use App\Models\VectorDetail;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class SalesCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function allCustomer()
    {
        //
        $customers = User::all();
        return view('sales.customers.allcustomer',[
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
        $user = User::find($id);
        
        $billInfo = CustomerBillInfo::select('*','card_types.name as cardType')
        ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
        ->where('customer_bill_infos.customer_id',$id)
        ->first();

        //pricing
        $pricing = PricingCriteria::select('*')
        ->leftjoin('users','pricing_criterias.customer_id','=','users.id')
       ->where('pricing_criterias.customer_id',$id)
        ->first();

        //vector details
        $vectordetails = VectorDetail::select('*')
        ->leftjoin('users','vector_details.customer_id','=','users.id')
        ->where('vector_details.customer_id',$id)
        ->first();
    

        
    
    
        return view('sales.customers.profile-details.index',compact(
            'user',
           'billInfo',
            'pricing',
            'vectordetails'
        ));
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
