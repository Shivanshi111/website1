<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect unauthenticated users trying to access admin routes
            if ($request->is('admin/*')) {
                return redirect()->route('login.submit');
            }
        } else {
            $role = Auth::user()->role;

            // Redirect based on role
            if ($role === 0 && $request->is('admin/*')) {
                // Prevent non-admin users from accessing admin routes
                return redirect()->route('front.home');
            }

            if ($role === 1 && !$request->is('admin/*')) {
                // Prevent admin users from accessing non-admin routes
                return redirect()->route('admin.dashboard');
            }
        }

        // Allow the request to proceed
        return $next($request);
    }
}
