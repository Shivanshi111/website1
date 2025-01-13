<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectIfAuthenticated
{
    public function handle($request, Closure $next): Response
    {
        if (!Auth::check() ) {
            return $next($request);
        } elseif(Auth::check() && Auth::user()->role == 1){
            return redirect()->route('admin.dashboard');
        } 
        
        return $next($request);
    }
}

