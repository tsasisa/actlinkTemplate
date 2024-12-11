<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginCOntroller extends Controller
{
    public function showLoginForm()
    {
        return view('unregistered.login');
    }

    /**
     * Check if email exists in the database.
     */
    public function checkEmail(Request $request)
    {
        Log::info('Test log from controller');
        $email = $request->input('email');
        $exists = User::where('userEmail', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function login(Request $request)
    {
        // Validate the credentials
        Log::info('Test log from controller');
        $credentials = $request->validate([
            
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt(['userEmail' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
        
            // Redirect based on user role
            $user = Auth::user();
            if ($user->userType === 'admin') {
                return redirect()->intended('/admin/home');
            } elseif ($user->userType === 'organizer') {
                return redirect()->intended('/organizer/home');
            } elseif ($user->userType === 'member') {
                return redirect()->intended('/member/home');
            }
        }
    
        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'login' => 'The provided credentials are incorrect.',
        ])->withInput(); // Retain the entered email
    }
    
}
