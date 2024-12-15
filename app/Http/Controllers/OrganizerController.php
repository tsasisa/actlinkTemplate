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

}
