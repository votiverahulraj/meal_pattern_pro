<?php

namespace App\Http\Controllers;

use App\Models\ApexSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ApexAuthController extends Controller
{
    /**
     * Generate access and refresh tokens for a user.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate access token (JWT-like)
        $accessToken = $this->generateAccessToken($user);
        
        // Generate refresh token
        $refreshToken = $this->generateRefreshToken($user, $request);

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_in' => 15 * 60, // 15 minutes
            'refresh_token' => $refreshToken,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'role' => $user->roles->pluck('name')->first(),
                'district_id' => null, // Add district_id if applicable
            ]
        ]);
    }

    /**
     * Refresh an access token using a refresh token.
     */
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $session = ApexSession::where('refresh_token', $request->refresh_token)
                             ->active()
                             ->first();

        if (!$session) {
            return response()->json(['error' => 'Invalid or expired refresh token'], 401);
        }

        // Generate new access token
        $accessToken = $this->generateAccessToken($session->user);
        
        // Rotate refresh token
        $newRefreshToken = Str::random(64);
        $session->update([
            'refresh_token' => $newRefreshToken,
            'expires_at' => now()->addDays(7),
            'last_used_at' => now(),
        ]);

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_in' => 15 * 60, // 15 minutes
            'refresh_token' => $newRefreshToken,
        ]);
    }

    /**
     * Logout the user and invalidate the refresh token.
     */
    public function logout(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $session = ApexSession::where('refresh_token', $request->refresh_token)->first();

        if ($session) {
            $session->update(['is_active' => false]);
        }

        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Generate an access token (simulating JWT).
     */
    private function generateAccessToken($user)
    {
        // In a real implementation, this would be a proper JWT
        // For now, we'll simulate it with a base64 encoded payload
        $payload = json_encode([
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->roles->pluck('name')->first(),
            'district_id' => null, // Add district_id if applicable
            'exp' => now()->addMinutes(15)->timestamp,
        ]);

        return base64_encode($payload) . '.' . hash('sha256', $payload . config('app.key'));
    }

    /**
     * Generate a refresh token and store it in the database.
     */
    private function generateRefreshToken($user, $request)
    {
        $refreshToken = Str::random(64);

        ApexSession::create([
            'user_id' => $user->id,
            'refresh_token' => $refreshToken,
            'expires_at' => now()->addDays(7),
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip(),
        ]);

        return $refreshToken;
    }
}