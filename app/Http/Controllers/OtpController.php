<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailOtp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OtpController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Auth/VerifyOtp', [
            'email' => $request->email
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $record = EmailOtp::where('email', $request->email)->first();

       if (
    ! $record ||
    ! Hash::check($request->otp, $record->otp) ||
    now()->gt($record->expires_at)
) {
    return back()->withErrors(['otp' => 'Invalid or expired OTP']);
}


        $user = User::where('email', $request->email)->firstOrFail();
        $user->update(['email_verified_at' => now()]);

        auth()->login($user);
        $record->delete();

        return redirect()->route('customer.dashboard');
    }


public function resend(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $otp = rand(100000, 999999);
    $expiresAt = now()->addMinutes(5);

  EmailOtp::updateOrCreate(
    ['email' => $request->email],
    [
        'otp' => Hash::make($otp), 
        'expires_at' => $expiresAt,
    ]
);


    // Send OTP email using Blade template
try {
   Mail::to($request->email)->send(new OtpMail($otp, $expiresAt->format('h:i A')));

} catch (\Throwable $e) {
    \Log::error('OTP mail failed: ' . $e->getMessage());

    dd($e->getMessage());
}



    // Redirect to OTP verification page with email
    return redirect()->route('otp.verify', ['email' => $request->email]);
}


}
