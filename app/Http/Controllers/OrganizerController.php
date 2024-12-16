<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function index(){          
        $user = Auth::user(); 
        return view('organizer.organizer', compact( 'user'));
    }

    public function waitingAccept()
    {
        $user = Auth::user();

        // Ensure the logged-in user is an organizer
        if ($user && $user->userType === 'organizer' && $user->organizer->activeFlag == 0) {
            return view('organizer.waiting'); // Organizer's waiting page view
        }


        return redirect()->route('organizer.organizer');
    }

}
