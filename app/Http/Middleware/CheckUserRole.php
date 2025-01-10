<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Check if the user is authenticated via the admin guard
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();

            // If the user has role 1, redirect them to the admin dashboard
            if ((int)$user->role === 1) {
                return redirect()->route('admin.dashboard');
            }
        }

        // Proceed with the request if the role condition isn't met
        return $next($request);
    }
}

      // if (Auth::check() && Auth::user()->role !==1){
        //     return redirect()->route('admin.login');
        // }