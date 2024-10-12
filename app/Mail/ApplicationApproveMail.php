<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;




class ApplicationApproveMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $application;
    /**
     * Create a new message instance.
     *
     * @param $application
     * @return void
     */
    public function __construct($application)
    {
        $this->application = $application;    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = "<p>Dear {$this->application->name},</p>
                    <p>Your application has been approved! Thank you for your patience.</p>
                    <p>Best regards,<br>Mindset Team</p>";
    
        return $this
                    ->subject('Your Application Has Been Approved')
                    ->html($message);
    }
    
}