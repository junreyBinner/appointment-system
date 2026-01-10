<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
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
        return $this->subject('Your verification code')
            ->view('emails.otp')
            ->text('emails.otp-text');
    }
}

