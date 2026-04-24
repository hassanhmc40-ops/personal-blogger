<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        // Return the login view
        return view('auth.login');
    }

    /**
     * Process the login form submission
     */
    public function login(Request $request)
    {
        // 1. Validate Input (Email + Password required)
        $credentials = $request->validate([
            'email'    => ['required', 'email'],         // Must be email format
            'password' => ['required'],                  // Cannot be empty
        ]);

        // 2. Try to log the user in
        // Auth facade checks DB password hash automatically
        if (Auth::attempt($credentials)) {
            // 3. Security: Regenerate session to prevent hijacking
            $request->session()->regenerate();
            
            // 4. Redirect to Dashboard after success
            return redirect()->intended('/dashboard');
        }

        // 5. If failed, go back to form with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); // Keep email typed, clear password
    }

    /**
     * Log out the user
     */
    public function logout(Request $request)
    {
        // 1. Sign out
        Auth::logout();

        // 2. Invalidate session (remove old session data)
        $request->session()->invalidate();

        // 3. Regenerate CSRF token (security refresh)
        $request->session()->regenerateToken();

        // 4. Redirect to home page
        return redirect()->route('home');
    }
}
