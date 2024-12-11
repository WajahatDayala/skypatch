<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    public $zipFilePath;

    // Constructor to accept email data and zip file path
    public function __construct($emailData, $zipFilePath)
    {
        $this->emailData = $emailData;
        $this->zipFilePath = $zipFilePath;
    }

    // Build the email
    public function build()
    {
        // Use the public path to access the file inside public/storage folder
        $filePath = public_path("storage/quote_files.zip");  // Correct path inside the public directory

        // Check if the file exists
        if (!file_exists($filePath)) {
            Log::error("File does not exist at path: $filePath");
            throw new \Exception("The specified ZIP file was not found.");
        }

        return $this->view('emails.quote')
                    ->with(['emailData' => $this->emailData])
                    ->subject('Quote Mail')
                    ->attach($filePath, [
                        'as' => 'quote_files.zip',  // Name of the attachment
                        'mime' => 'application/zip',  // MIME type
                    ]);
    }
}
