<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AccountLockoutMiddleware
{
    /**
     * Maximum number of failed attempts before lockout
     */
    const MAX_ATTEMPTS = 5;
    
    /**
     * Lockout duration in minutes
     */
    const LOCKOUT_DURATION = 30;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'login_attempts_' . $request->ip();
        
        // Check if IP is locked out
        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($key);
            
            return response()->json([
                'error' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',
            ], 429);
        }

        return $next($request);
    }
}