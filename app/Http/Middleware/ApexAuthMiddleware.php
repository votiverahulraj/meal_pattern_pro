<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApexAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Access token required'], 401);
        }

        // Decode the simulated JWT
        $parts = explode('.', $token);
        if (count($parts) !== 2) {
            return response()->json(['error' => 'Invalid token format'], 401);
        }

        $payload = json_decode(base64_decode($parts[0]), true);
        
        // Verify the token signature
        $expectedSignature = hash('sha256', base64_decode($parts[0]) . config('app.key'));
        if ($expectedSignature !== $parts[1]) {
            return response()->json(['error' => 'Invalid token signature'], 401);
        }

        // Check if token is expired
        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return response()->json(['error' => 'Token expired'], 401);
        }

        // Find user and authenticate
        $user = User::find($payload['user_id']);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 401);
        }

        Auth::login($user);

        return $next($request);
    }
}