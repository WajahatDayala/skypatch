<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Admin;
use App\Models\BillingType;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
class AccountsReportController extends Controller
{
    //

    public function index()
    {

        $billingTypes = BillingType::all();
        return view('reports.accounts-user-report.accounts-report.index',compact('billingTypes'));
    }

    public function searchAccount(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $billType =  $request->input('billing_type');  // Can be null
        
        $billingTypes = BillingType::all(); // This is fine if you need to load all billing types for selection options
        
        // Query for orders with additional billing type filter
        $orders = DB::table('invoice_details')
            ->select(
                'invoice_details.order_id as order_id',
                'invoice_details.price as total',
                'invoice_details.released_date as releasedDate',
                'invoice_details.updated_at as action_date',
                'invoice_details.created_at as createdAt',
                'billing_types.name as billingType',
                'users.name as customer_name',
                DB::raw("CONCAT('OR-', orders.id) as design_number"),
                'orders.name as design_name',
                'statuses.name as status',
                DB::raw("'orders' as source_table") // Identify that this row is from the orders table
            )
            ->join('orders', 'invoice_details.order_id', '=', 'orders.id')
            ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
            ->join('billing_types', 'invoices.billingtype_id', '=', 'billing_types.id')
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->leftJoin('statuses', 'orders.status_id', '=', 'statuses.id')
            ->where('invoice_details.paid_on', 1)
            ->whereBetween('invoice_details.released_date', [$fromDate, $toDate])  // Filter orders within the date range
            ->when($billType, function ($query) use ($billType) {
                if ($billType) {
                    return $query->where('invoices.billingtype_id', '=', $billType); // Apply billing type filter if provided
                }
                return $query;  // If billing type is null, just return the query without additional filters
            })
            ->orderBy('design_number', 'ASC') // Sort by design_number to keep proper order
            ->get();
        
        // Query for vector orders with additional billing type filter
        $vectorOrders = DB::table('invoice_details')
            ->select(
                'invoice_details.vector_id as vector_id',
                'invoice_details.price as total',
                'invoice_details.released_date as releasedDate',
                'invoice_details.created_at as createdAt',
                'invoice_details.updated_at as action_date',
                'billing_types.name as billingType',
                'users.name as customer_name',
                DB::raw("CONCAT('VO-', vector_orders.id) as design_number"),
                'vector_orders.name as design_name',
                'statuses.name as status',
                DB::raw("'vector_orders' as source_table") // Identify that this row is from the vector_orders table
            )
            ->join('vector_orders', 'invoice_details.vector_id', '=', 'vector_orders.id')
            ->join('users', 'vector_orders.customer_id', '=', 'users.id')
            ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
            ->join('billing_types', 'invoices.billingtype_id', '=', 'billing_types.id')
            ->leftJoin('statuses', 'vector_orders.status_id', '=', 'statuses.id')
            ->where('invoice_details.paid_on', 1)
            ->whereBetween('invoice_details.released_date', [$fromDate, $toDate])  // Filter vector orders within the date range
            ->when($billType, function ($query) use ($billType) {
                if ($billType) {
                    return $query->where('invoices.billingtype_id', '=', $billType); // Apply billing type filter if provided
                }
                return $query;  // If billing type is null, just return the query without additional filters
            })
            ->orderBy('design_number', 'ASC') // Sort by design_number to keep proper order
            ->get();
        
            return view('reports.accounts-user-report.accounts-report.search',compact(
                'orders',
                'vectorOrders',
                'billingTypes'
            ));

    }
}
