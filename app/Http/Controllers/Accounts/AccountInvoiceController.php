<?php

namespace App\Http\Controllers\Accounts;

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
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class AccountInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $invoices = InvoiceDetail::select(
            'invoice_details.invoice_id as invoiceId',
            'invoices.invoice_status',
            'invoices.invoice_number as invoiceNumber', // Select invoice_number
            'users.invoice_email as invoiceEmail', // Select invoice_email
            DB::raw('MIN(invoice_details.created_at) as createdAt'), // Aggregate for created_at
            DB::raw('MIN(invoice_details.updated_at) as updatedAt'), // Aggregate for created_at
            DB::raw('SUM(invoice_details.price) as total_amount') // Sum the price/amount
        )
        ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
        ->join('users', 'invoices.customer_id', '=', 'users.id') // Ensure this join is correct
        ->groupBy('invoice_details.invoice_id','invoices.invoice_status', 'invoices.invoice_number', 'users.invoice_email') // Group by both invoice_id, invoice_number, and invoice_email
        ->get();



        
        return view('/accounts/customers/invoice/index',compact('invoices'));
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
