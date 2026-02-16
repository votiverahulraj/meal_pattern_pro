<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TermsGateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Assuming there's a terms_accepted_at column in users table
            // or a terms_version_accepted column to track which version they accepted
            if (!$user->terms_accepted_at) {
                // Redirect to terms acceptance page if terms not accepted
                if (!$request->is('terms*')) {
                    return redirect()->route('terms.accept');
                }
            }
        }

        return $next($request);
    }
}