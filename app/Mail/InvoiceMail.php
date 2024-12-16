<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdfFilePath;

    public function __construct($invoice, $pdfFilePath)
    {
        $this->invoice = $invoice;
        $this->pdfFilePath = $pdfFilePath;
    }

    public function build()
    {
        return $this->subject('Your Invoice')
                    ->view('emails.invoice')
                    ->attach($this->pdfFilePath, [
                        'as' => 'invoice.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
