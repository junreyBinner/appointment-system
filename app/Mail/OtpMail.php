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
    return $this->from(
            config('mail.from.address'),
            config('mail.from.name')
        )
        ->replyTo('randomind211@gmail.com', 'Appointment System Support')
        ->subject('Your verification code for Appointment System')
        ->view('emails.otp')
        ->text('emails.otp-text');
}


}
