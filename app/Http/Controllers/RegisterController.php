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
        'email' => 'required|email|unique:users,userEmail|max:255', // Check if email exists
        'password' => 'required|string|min:8|confirmed', // Ensure passwords match
        'phoneNumber' => 'required|regex:/^08[0-9]{7,}$/', // Must start with '08' and be at least 9 digits
        'userType' => 'required|in:member,organizer', // Ensure valid user type
        'organizerAddress' => 'required_if:userType,organizer|max:255', // Required only for organizers
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
        ]);
    }

    // Redirect back to the registration page with success message
    return redirect()->route('login');
}



}
