<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle the incoming request.
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, ['web']); // Authenticate using the default guard

        $user = Auth::user();
        $routePrefix = $request->route()->getPrefix();

        // Role-based access control
        if ($routePrefix === '/admin' && $user->userType !== 'Admin') {
            return redirect()->route('home')->with('error', 'Access denied. Admins only.');
        }

        if ($routePrefix === '/organizer' && $user->userType !== 'Organizer') {
            return redirect()->route('home')->with('error', 'Access denied. Organizers only.');
        }

        if ($routePrefix === '/member' && $user->userType !== 'Member') {
            return redirect()->route('home')->with('error', 'Access denied. Members only.');
        }

        return $next($request);
    }
}
