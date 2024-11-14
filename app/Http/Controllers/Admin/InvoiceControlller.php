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
use Dompdf\Dompdf;
use Dompdf\Options;

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
            'invoice_details.invoice_id as invoiceId',
            'invoices.invoice_number as invoiceNumber', // Select invoice_number
            'users.invoice_email as invoiceEmail', // Select invoice_email
            DB::raw('MIN(invoice_details.created_at) as createdAt'), // Aggregate for created_at
            DB::raw('SUM(invoice_details.price) as total_amount') // Sum the price/amount
        )
        ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
        ->join('users', 'invoices.customer_id', '=', 'users.id') // Ensure this join is correct
        ->groupBy('invoice_details.invoice_id', 'invoices.invoice_number', 'users.invoice_email') // Group by both invoice_id, invoice_number, and invoice_email
        ->get();



        
        return view('/admin/customers/invoice/index',compact('invoices'));



    }

    //download pdf
    public function downloadPDF($id)
    {
        // Fetch the invoice by ID
    $invoice = Invoice::select('*')
    ->join('users','invoices.customer_id','=','users.id')
    ->where('invoices.id',$id)
    ->first();

    
    // Fetch invoice details
    $orderInvoice = InvoiceDetail::select('*',
        'invoice_details.invoice_id',
        'orders.payment_status as paymentStatus',
        'invoice_details.order_id as orderId',
        'invoice_details.vector_id as vectorId',
        'orders.name as orderDesign',
        'orders.created_at as ordersCreatedAt',
        'orders.sent_date as orderSentDate', 
        'vector_orders.name as vectorDesign',
        'vector_orders.created_at as vectorCreatedAt',
        'vector_orders.date_finalized as vectorSentDate'
    )
    ->leftjoin('orders', 'invoice_details.order_id', '=', 'orders.id')
    ->leftjoin('vector_orders', 'invoice_details.vector_id', '=', 'vector_orders.id')
    ->where('invoice_details.invoice_id', $id)
    ->get();
   

 

    // Initialize Dompdf
    $dompdf = new Dompdf();

    // Set options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);  // Enable HTML5 support
    $options->set('isPhpEnabled', true);          // Enable PHP functions (optional)
    $options->set('isExternalLinksEnabled', true); // Allow external links like image URLs
    $dompdf->setOptions($options);

    // Set base path for assets (important for resolving image paths)
    $dompdf->setBasePath(public_path()); // Use public path to resolve image URLs

    // Load HTML content for the PDF (passing $invoice and $invoiceDetails)
    $htmlContent = view('admin.customers.invoice.invoice_pdf', compact(
        'invoice', 
        'orderInvoice'
        ))->render();
    $dompdf->loadHtml($htmlContent);

    // // Render the PDF
     $dompdf->render();

    // // Stream the PDF to the browser (for download)
     return $dompdf->stream("invoice_{$id}.pdf", array("Attachment" => true));  // Download the file

    // return view('admin.customers.invoice.invoice_pdf', compact(
    //      'invoice', 
    //     'orderInvoice'));
        
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
