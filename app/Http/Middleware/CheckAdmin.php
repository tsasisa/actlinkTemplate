<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->userType === 'admin') {
            return $next($request);
        }

        return redirect('home')->with('error', 'You do not have admin access.');
    }
}
