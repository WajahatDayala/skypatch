<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\InvoiceDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FollowUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoiceDetail;
    public $invoice;

    public function __construct(InvoiceDetail $invoiceDetail)
    {
        $this->invoiceDetail = $invoiceDetail;
        $this->invoice = $invoiceDetail->invoice;  // Assuming InvoiceDetail has an 'invoice' relationship
    }

    public function build()
    {
        return $this->subject('Reminder: Payable Invoice #'.$this->invoice->invoice_number)
                    ->view('emails.follow-up');
    }
}
