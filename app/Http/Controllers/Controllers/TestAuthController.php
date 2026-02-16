<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestAuthController extends Controller
{
    public function testApexAuth()
    {
        return response()->json([
            'message' => 'APEX Authentication is working!',
            'user' => auth()->user(),
            'authenticated' => auth()->check()
        ]);
    }
}