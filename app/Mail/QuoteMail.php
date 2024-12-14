<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class QuoteMail extends Mailable
{
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
        $email = $this->view('emails.quote')
                      ->with(['emailData' => $this->emailData])
                      ->subject('Quote Mail');

        // Add files for Option A
        foreach ($this->filesA as $fileName) {
            $filePath = storage_path('app/public/' . $fileName);
            if (file_exists($filePath)) {
                $email->attach($filePath, [
                    'as' => basename($filePath),
                    'mime' => mime_content_type($filePath),
                ]);
            }
        }

        // Add files for Option B
        foreach ($this->filesB as $fileName) {
            $filePath = storage_path('app/public/' . $fileName);
            if (file_exists($filePath)) {
                $email->attach($filePath, [
                    'as' => basename($filePath),
                    'mime' => mime_content_type($filePath),
                ]);
            }
        }

        return $email;
    }

}
