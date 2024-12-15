<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VectorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    public $filesA;
    public $filesB;

    /**
     * Create a new message instance.
     *
     * @param  array  $emailData
     * @param  array  $filesA
     * @param  array  $filesB
     * @return void
     */
    public function __construct($emailData, $filesA, $filesB)
    {
        $this->emailData = $emailData;
        $this->filesA = $filesA;
        $this->filesB = $filesB;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.vector')
                      ->with(['emailData' => $this->emailData])
                      ->subject('Vector Mail');

// Attach files for Option A
foreach ($this->filesA as $fileName) {
    $filePath = storage_path('app/public/' . $fileName);  // Full server path
    if (file_exists($filePath)) {
        $email->attach($filePath, [
            'as' => basename($filePath),
            'mime' => mime_content_type($filePath),
        ]);
    } else {
        //Log::error("File not found: " . $filePath);  // Log if the file doesn't exist
    }
}

// Attach files for Option B
foreach ($this->filesB as $fileName) {
    $filePath = storage_path('app/public/' . $fileName);  // Full server path
    if (file_exists($filePath)) {
        $email->attach($filePath, [
            'as' => basename($filePath),
            'mime' => mime_content_type($filePath),
        ]);
    } else {
       // Log::error("File not found: " . $filePath);  // Log if the file doesn't exist
    }
}


        return $email;
    }
}
