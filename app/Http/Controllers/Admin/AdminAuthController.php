<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // ── Show Admin Login Page ────────────────────────────────────
    public function showLogin()
    {
        // If already logged in as admin → go to dashboard
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    // ── Handle Admin Login Submit ────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->boolean('remember');

        // Attempt login
        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors([
                    'email' => 'These credentials do not match our records.',
                ])
                ->withInput($request->only('email'));
        }

        $user = Auth::user();

        // Check if user is admin
        if (!$user->isAdmin()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    'email' => 'You do not have permission to access the admin panel.',
                ])
                ->withInput($request->only('email'));
        }

        // Regenerate session for security
        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    // ── Handle Admin Logout ──────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')    
            ->with('success', 'You have been logged out successfully.');
    }
}