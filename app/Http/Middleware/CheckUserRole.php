<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // Allow unauthenticated users to access the public home page
            if ($request->is('/')) {
                return $next($request);
            }
            return redirect()->route('login');
        }
    
        $user = Auth::user();
        $userType = $user->userType;
    
        // Redirect authenticated users accessing '/' to their role-specific home
        if ($request->is('/')) {
            return $this->redirectToRoleHome($userType);
        }
    
        // Define role-specific route prefixes
        $roleRoutes = [
            'admin' => 'admin',
            'organizer' => 'organizer',
            'member' => 'member',
        ];
    
        // Check if the current route matches the user's role
        if (!isset($roleRoutes[$userType]) || !$request->is($roleRoutes[$userType] . '/*')) {
            return $this->redirectToRoleHome($userType);
        }
    
        // Handle special case for inactive organizers
        if ($userType === 'organizer' && $user->organizer && $user->organizer->activeFlag == 0) {
            if (!$request->is('organizer/waitingAccept')) {
                return redirect()->route('organizer.waitingAccept');
            }
        }
    
        return $next($request);
    }
    
    /**
     * Redirect to the appropriate home route for the user's role.
     */
    private function redirectToRoleHome($userType)
    {
        switch ($userType) {
            case 'admin':
                return redirect()->route('admin.home');
            case 'organizer':
                return redirect()->route('organizer.home');
            case 'member':
                return redirect()->route('member.home');
            default:
                return redirect('/')->with('error', 'Unauthorized access.');
        }
    }
    
    
}
