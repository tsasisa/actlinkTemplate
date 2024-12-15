<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOrganizer
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->userType === 'organizer') {
            return $next($request);
        }

        return redirect('home')->with('error', 'You do not have organizer access.');
    }
}
