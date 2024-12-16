<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('unregistered.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,userEmail|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phoneNumber' => 'required|regex:/^08[0-9]{7,}$/',
            'userType' => 'required|in:member,organizer',
            'organizerAddress' => 'exclude_if:userType,member|required|max:255',
            'officialSocialMedia' => 'exclude_if:userType,member|required|url|max:255',
            'dob' => 'exclude_if:userType,organizer|required|date',
        ]);
        
    
        // Store the user in the database
        $user = User::create([
            'userName' => $validatedData['name'],
            'userEmail' => $validatedData['email'],
            'userPassword' => bcrypt($validatedData['password']),
            'userPhoneNumber' => $validatedData['phoneNumber'],
            'userType' => $validatedData['userType'],
        ]);
    
        // If the user is an organizer, add additional data
        if ($validatedData['userType'] === 'organizer') {
            $user->organizer()->create([
                'organizerAddress' => $validatedData['organizerAddress'],
                'officialSocialMedia' => $validatedData['officialSocialMedia'],
            ]);
        }
    
        // If the user is a member, add DOB
        if ($validatedData['userType'] === 'member') {
            $user->member()->create([
                'memberDOB' => $validatedData['dob'],
            ]);
        }
    
        // Redirect back to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
    


}
