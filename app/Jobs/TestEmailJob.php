<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TestEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
         // Send the test email
         Mail::raw('This is a test email sent from a job in Laravel 11.', function ($message) {
            $message->to('jazibsaleem58@gmail.com')  // Replace with your recipient
                    ->subject('Test Email from TestEmailJob');
        });
    }
}
