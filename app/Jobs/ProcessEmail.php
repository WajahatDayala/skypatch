<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteMail;
class ProcessEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $emailData;
    protected $zipFile;

    /**
     * Create a new job instance.
     *
     * @param array $emailData
     * @param string $zipFile
     */
    public function __construct($emailData, $zipFile)
    {
        $this->emailData = $emailData;
        $this->zipFile = $zipFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       // Check if 'emails' key exists in the data passed
    // Check if 'emails' key exists in the data passed
    if (isset($this->emailData['emails']) && is_array($this->emailData['emails'])) {
        $emails = $this->emailData['emails'];  // Access the 'emails' array
        
        // Send the email to each recipient
        foreach ($emails as $email) {
            Mail::to($email)->send(new QuoteMail($this->emailData, $this->zipFile));
        }
    } else {
        // Log an error or take appropriate action if 'emails' key is missing
        \Log::error("Emails key is missing in the provided data.");
    }
    }
}
