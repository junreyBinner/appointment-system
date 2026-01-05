<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedWithOtp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->email_verified_at === null) {
        // Redirect to OTP verification page if email is not verified
        return redirect()->route('otp.verify', [
            'email' => auth()->user()->email
        ]);
    }

    return $next($request);
}


}
