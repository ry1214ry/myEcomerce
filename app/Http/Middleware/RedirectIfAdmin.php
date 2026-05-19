<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // If admin tries to visit login/register → send to admin dashboard
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // If customer tries to visit login/register → send to home
        if (auth()->check() && auth()->user()->isCustomer()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}