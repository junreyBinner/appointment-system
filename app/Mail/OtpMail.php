<?php

namespace App\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class OtpMail extends Mailable implements ShouldQueue
{
     use SerializesModels;

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
