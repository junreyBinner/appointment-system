<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check role
        if (auth()->user()->role !== $role) {
            // Redirect based on actual role instead of 403 error
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role === 'customer') {
                return redirect()->route('customer.dashboard');
            }
            
            // Fallback
            return redirect()->route('login');
        }

        return $next($request);
    }
}