<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    /**
     * Show the terms acceptance form.
     */
    public function showTermsForm()
    {
        return view('auth.terms');
    }

    /**
     * Accept the terms and conditions.
     */
    public function acceptTerms(Request $request)
    {
        $request->validate([
            'terms' => 'required|accepted',
        ]);

        $user = Auth::user();
        $user->update([
            'terms_accepted_at' => now(),
        ]);

        return redirect()->intended('/home');
    }
}