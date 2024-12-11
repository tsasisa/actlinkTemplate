<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // dd('CheckRole middleware is triggered with role: ' . $role);

        // Check if the user is authenticated and has the correct userType
        if (Auth::check() && Auth::user()->userType === $role) {
            return $next($request);
        }

        // Redirect or abort if the user doesn't have the required userType
        return redirect('/login')->withErrors(['login' => 'You do not have permission to access this page.']);
    }
}
