<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailOtp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $otp = rand(100000, 999999);
    $expiresAt = now()->addMinutes(5);

    EmailOtp::updateOrCreate(
        ['email' => $user->email],
        [
            'otp' => Hash::make($otp),
            'expires_at' => $expiresAt,
        ]
    );

    try {
       Mail::to($user->email)->send(new OtpMail($otp, $expiresAt->format('h:i A')));

    } catch (\Exception $e) {
        \Log::error('REGISTER OTP MAIL FAILED: ' . $e->getMessage());

        return back()->withErrors([
            'email' => 'Failed to send OTP. Please try again later.'
        ]);
    }

    return redirect()->route('otp.verify', ['email' => $user->email]);
}

}