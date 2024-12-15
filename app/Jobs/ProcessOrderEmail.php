<?php

namespace App\Jobs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Log;

class ProcessOrderEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $emailData;
    protected $filesA;
    protected $filesB;

    /**
     * Create a new job instance.
     *
     * @param array $emailData
     * @param array $filesA
     * @param array $filesB
     */
    public function __construct($emailData, $filesA, $filesB)
    {
        $this->emailData = $emailData;
        $this->filesA = $filesA;
        $this->filesB = $filesB;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Check if 'emails' key exists in the data passed
        if (isset($this->emailData['emails']) && is_array($this->emailData['emails'])) {
            $emails = $this->emailData['emails'];  // Access the 'emails' array

            // Log the email addresses to ensure they're correct
            //Log::info("Sending emails to: ", $emails);

            // Send the email to each recipient
            foreach ($emails as $email) {
                try {
                    Mail::to($email)->send(new OrderMail($this->emailData, $this->filesA, $this->filesB));
                } catch (\Exception $e) {
                   // Log::error("Error sending email to $email: " . $e->getMessage());
                }
            }
        } else {
          //  Log::error("Emails key is missing in the provided data.");
        }
    }
}