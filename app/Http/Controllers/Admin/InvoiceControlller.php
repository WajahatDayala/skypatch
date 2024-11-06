<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\Quote;
use App\Models\QuoteFileLog;
use App\Models\Instruction;
use App\Models\Status;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use PDF;


use Illuminate\Support\Facades\DB;

class InvoiceControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/invoices';
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    public function index()
    {
        //

        $invoices = InvoiceDetail::select(
            'invoice_details.invoice_id', // Group by invoice_id
            'orders.payment_status as paymentStatus', // Include payment_status from orders
            'vector_orders.payment_status as vectorPaymentStatus', // Include payment_status from vector_orders
            DB::raw('MIN(invoice_details.created_at) as createdAt'), // Aggregate for created_at
            DB::raw('GROUP_CONCAT(orders.id) as orders_ids'), // Get concatenated list of order IDs
            DB::raw('GROUP_CONCAT(vector_orders.id) as vector_orders_ids'), // Get concatenated list of vector order IDs
            DB::raw('SUM(invoice_details.price) as total_amount') // Sum the price/amount
        )
        ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
        ->leftJoin('orders', 'invoice_details.order_id', '=', 'orders.id')
        ->leftJoin('vector_orders', 'invoice_details.vector_id', '=', 'vector_orders.id')
        ->groupBy(
            'invoice_details.invoice_id', 
            'orders.payment_status', // Add orders.payment_status to GROUP BY
            'vector_orders.payment_status' // Add vector_orders.payment_status to GROUP BY
        )
        ->get();


      

        
        return view('/admin/customers/invoice/index',compact('invoices'));



    }

    //download pdf
    public function downloadPDF($id)
    {
        // Fetch the invoice by ID
        $invoice = Invoice::findOrFail($id);

        $invoiceDetails = InvoiceDetail::select(
            'invoice_details.invoice_id',
            'orders.payment_status as paymentStatus',
            'vector_orders.payment_status as vectorPaymentStatus'
        )
        ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
        ->leftJoin('orders', 'invoice_details.order_id', '=', 'orders.id')
        ->leftJoin('vector_orders', 'invoice_details.vector_id', '=', 'vector_orders.id')
        ->where('invoice_details.invoice_id',$invoice->id)
        ->get();


       // Pass data to the PDF view
        $pdf = PDF::loadView('admin.customers.invoice.invoice_pdf', compact('invoice'));

        // Return the generated PDF as a download
        return $pdf->download('invoice_'.$invoice->id.'.pdf');
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
