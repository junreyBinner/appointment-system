<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable implements ShouldQueue
{
     use Queueable, SerializesModels;

    public $otp;
    public $expiresAt;

    public function __construct($otp, $expiresAt)
    {
        $this->otp = $otp;
        $this->expiresAt = $expiresAt;
    }

    public function build()
    {
        return $this->subject('Your OTP Code - Appointment System')
                    ->view('emails.otp');
    }
}
