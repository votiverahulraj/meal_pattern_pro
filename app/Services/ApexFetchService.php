<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApexFetchService
{
    /**
     * Base URL for API calls
     */
    protected $baseUrl;

    /**
     * Access token for authorization
     */
    protected $accessToken;

    /**
     * Refresh token for token renewal
     */
    protected $refreshToken;

    public function __construct()
    {
        $this->baseUrl = config('app.url') . '/api';
    }

    /**
     * Perform an authenticated API request
     */
    public function request($method, $endpoint, $data = [])
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->{$method}($this->baseUrl . $endpoint, $data);

        // If the response is unauthorized, try to refresh the token
        if ($response->status() === 401) {
            $this->refreshToken();
            
            // Retry the request with the new token
            $headers['Authorization'] = 'Bearer ' . $this->getAccessToken();
            $response = Http::withHeaders($headers)->{$method}($endpoint, $data);
        }

        // If still unauthorized, redirect to login
        if ($response->status() === 401) {
            $this->handleAuthFailure();
        }

        return $response;
    }

    /**
     * Get the current access token
     */
    protected function getAccessToken()
    {
        if (!$this->accessToken) {
            $this->accessToken = session('access_token');
        }
        
        return $this->accessToken;
    }

    /**
     * Refresh the access token using the refresh token
     */
    protected function refreshToken()
    {
        $refreshToken = $this->getRefreshToken();
        
        if (!$refreshToken) {
            $this->handleAuthFailure();
        }

        $response = Http::post($this->baseUrl . '/auth/refresh', [
            'refresh_token' => $refreshToken,
        ]);

        if ($response->successful()) {
            $tokens = $response->json();
            
            session([
                'access_token' => $tokens['access_token'],
                'refresh_token' => $tokens['refresh_token'],
            ]);
            
            $this->accessToken = $tokens['access_token'];
            $this->refreshToken = $tokens['refresh_token'];
        } else {
            $this->handleAuthFailure();
        }
    }

    /**
     * Get the current refresh token
     */
    protected function getRefreshToken()
    {
        if (!$this->refreshToken) {
            $this->refreshToken = session('refresh_token');
        }
        
        return $this->refreshToken;
    }

    /**
     * Handle authentication failure
     */
    protected function handleAuthFailure()
    {
        // Clear session tokens
        session()->forget(['access_token', 'refresh_token']);
        
        // Redirect to login
        if (request()->expectsJson()) {
            abort(401, 'Authentication required');
        }
        
        redirect()->route('login')->send();
    }

    /**
     * GET request wrapper
     */
    public function get($endpoint)
    {
        return $this->request('get', $endpoint);
    }

    /**
     * POST request wrapper
     */
    public function post($endpoint, $data = [])
    {
        return $this->request('post', $endpoint, $data);
    }

    /**
     * PUT request wrapper
     */
    public function put($endpoint, $data = [])
    {
        return $this->request('put', $endpoint, $data);
    }

    /**
     * DELETE request wrapper
     */
    public function delete($endpoint)
    {
        return $this->request('delete', $endpoint);
    }
}