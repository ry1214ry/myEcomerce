<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page — block admin from even seeing it
     */
    public function create(): View|RedirectResponse
    {
        // ✅ Admin already logged in → kick to admin dashboard
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // ✅ Customer already logged in → kick to home
        if (auth()->check() && auth()->user()->isCustomer()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle login submit — BLOCK admin completely
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate credentials first
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        // ✅ ADMIN IS BLOCKED — logout immediately, send to admin portal
        if ($user->isAdmin()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('admin.login')
                ->with('info',
                    'Admin accounts cannot sign in here. Please use the Admin Portal.');
        }

        // ✅ CUSTOMER ONLY — allowed to proceed
        return redirect()
            ->intended(route('home'))
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Logout customer
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}