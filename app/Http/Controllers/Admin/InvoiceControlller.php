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
use App\Mail\InvoiceMail;
use App\Mail\FollowUpMail;
use Illuminate\Support\Facades\Mail;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use App\Models\JobInformation;

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



        
        return view('/admin/customers/invoice/index',compact('invoices'));



    }

    //download pdf
    public function downloadPDF($id)
    {
         // Fetch the invoice by ID
    $invoice = Invoice::select('*')
    ->join('users', 'invoices.customer_id', '=', 'users.id')
    ->where('invoices.id', $id)
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

// Load HTML content for the PDF (passing $invoice and $orderInvoice)
$htmlContent = view('admin.customers.invoice.invoice_pdf', compact(
    'invoice', 
    'orderInvoice'
))->render();

// Load the HTML content into Dompdf
$dompdf->loadHtml($htmlContent);

// Render the PDF (first pass)
$dompdf->render();

// Output the PDF to a file
$pdfOutput = $dompdf->output();

// Define the file path to save the PDF
$pdfFilePath = public_path("invoices/invoice_{$id}.pdf");

// Save the PDF file to the specified path
file_put_contents($pdfFilePath, $pdfOutput);

// Now, stream the PDF so the user can download it
return $dompdf->stream("invoice_{$invoice->invoice_number}.pdf", array("Attachment" => true));

        
    }
    
    // Fetch invoice details for modal
    public function fetchInvoiceDetails($invoiceId)
    {
        //$invoice = InvoiceDetail::with('customer')->find($invoiceId);

        $invoice = InvoiceDetail::select('*', 'users.invoice_email','invoices.invoice_status')
        ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
        ->join('users', 'invoices.customer_id', '=', 'users.id')
        ->where('invoice_details.invoice_id', $invoiceId)
        ->first();

    if ($invoice) {
        return response()->json([
            'status' => 'success',
            'invoice' => [
                'invoiceId' => $invoice->invoice_id,
                'invoice_number' => $invoice->invoice_number,
                'invoice_email' => $invoice->invoice_email, // Fix typo: "invoce_email" to "invoice_email"
                'invoice_status' => $invoice->invoice_status,
                'paid_on' => $invoice->paid_on,
            ],
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Invoice not found'], 404);
    }

    //send invoice to email
    public function sendInvoiceEmail($id)
    {
        try {
            // Find the invoice record
            $invoice = Invoice::findOrFail($id);  // Use findOrFail to handle not-found errors automatically
    
            // Fetch the customer's email address
            $customerEmail = Invoice::select('users.invoice_email as customerEmail')
                ->join('users', 'invoices.customer_id', '=', 'users.id')
                ->where('invoices.id', $id)
                ->first();
    
            // Ensure that a customer email was retrieved
            if (!$customerEmail || !$customerEmail->customerEmail) {
                return response()->json(['status' => 'error', 'message' => 'Customer email not found.'], 404);
            }
    
            // Define the PDF file path
            $pdfFilePath = public_path("invoices/invoice_{$id}.pdf");
    
            // Check if the PDF file exists
            if (!file_exists($pdfFilePath)) {
                return response()->json(['status' => 'error', 'message' => 'PDF file not found.'], 404);
            }
    
            // Send the email with the PDF as an attachment
            Mail::to($customerEmail->customerEmail)->send(new InvoiceMail($invoice, $pdfFilePath));
    
            // Return success response
            return response()->json(['status' => 'success', 'message' => 'Invoice email sent successfully!']);
        } catch (\Exception $e) {
            // Log the exception for debugging
           // \Log::error('Error sending invoice email: ' . $e->getMessage());
    
            // Return error response
            return response()->json(['status' => 'error', 'message' => 'An error occurred while sending the email.'], 500);
        }
    }


    //send follow up email
      // Send follow-up reminder via email
      public function sendFollowUp($invoiceId)
      {
        try {
            $invoice = Invoice::findOrFail($invoiceId);  // Find the invoice
            // Fetch the customer's email address
            // $customerEmail = Invoice::select('*','users.name as customer_name','users.invoice_email as customerEmail')
            //     ->join('users', 'invoices.customer_id', '=', 'users.id')
            //     ->where('invoices.id', $invoiceId)
            //     ->first();



            $invoiceDetail = InvoiceDetail::select('*', 'users.name as customer_name', 'users.invoice_email as customerEmail')
            ->join('invoices', 'invoice_details.invoice_id', '=', 'invoices.id')
            ->join('users', 'invoices.customer_id', '=', 'users.id')  
            ->where('invoice_details.invoice_id', $invoiceId)
            ->first();
        
        if ($invoiceDetail) {
            $mail = Mail::to($invoiceDetail->customerEmail)->send(new FollowUpMail($invoiceDetail));
        } else {
            \Log::error('InvoiceDetail not found.');
        }
        

    
            return response()->json(['status' => 'success', 'message' => 'Follow-up reminder sent successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error sending follow-up email: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to send follow-up email.']);
        }
    
      }
    
    


    // Update invoice status (paid/unpaid)
    public function updateInvoiceStatus(Request $request, $invoiceId)
    {
        DB::beginTransaction();

    try {
        // Find the invoice
        $invoice = Invoice::findOrFail($invoiceId);

        // Get the new status (0 or 1)
        $newStatus = $request->input('status'); 

        // Update the invoice status
        $invoice->invoice_status = $newStatus;

        // If the status is 1 (Paid), set the paid_on date
        //$invoice->updated_at = $newStatus === 1 ? now() : null;

        // Save the invoice
        $invoice->save();

        // Update the corresponding invoice details
        InvoiceDetail::where('invoice_id', $invoiceId)
            ->update(['paid_on' => $newStatus === 1 ? : 0,'updated_at'=>$newStatus===1?now():null]);

        DB::commit();   

        return response()->json([
            'status' => 'success',
            'message' => 'Invoice status updated successfully',
        ]);
    } catch (\Exception $e) {
        DB::rollback();

        // Log the error with context
        Log::error('Error updating invoice status', [
            'error' => $e->getMessage(),
            'invoiceId' => $invoiceId,
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update invoice status',
            'error' => $e->getMessage(),
        ], 500);
    }
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
