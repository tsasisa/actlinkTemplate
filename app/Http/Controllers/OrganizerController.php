<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function index(){          
        $user = Auth::user(); 
        $organizer = Organizer::where('organizerId', $user->userId)->first();
        return view('organizer.organizer', compact( 'user', 'organizer'));
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


    public function updateProfile(Request $request)
    {
        $user = Auth::user(); 
        $organizer = Organizer::where('organizerId', $user->userId)->first();
        return view('organizer.updateProfile', compact('user', 'organizer'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $organizer = Organizer::where('organizerId', $user->userId)->first();

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,userEmail,' . $user->userId . ',userId',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'sosmed' => 'nullable|string|max:255',
        ]);

        // Update the user data
        $user->userName = $request->name;
        $user->userEmail = $request->email;
        $user->userPhoneNumber = $request->phone;
        $user->save();

        // Update the organizer data
        if ($organizer) {
            $organizer->organizerAddress = $request->address;
            $organizer->officialSocialMedia = $request->sosmed;
            $organizer->save();
        }

        // Redirect to the profile edit page with success message
        return redirect()->route('organizer.home')->with('success', 'Profile updated successfully!');
    }

    public function manageEvent(){

        return view('organizer.manage-event');
    }

    public function createEvent(){

        return view('organizer.create-event');
    }

    public function create(Request $request){
        $user = Auth::user();
        $request->validate([
            'event-name' => 'required|string|max:255',
            'event-description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'event-date' => 'required|date',
            'event-location' => 'required|string|max:255',
            'event-quota' => 'required|integer',
            'event-points' => 'required|integer',
            'event-type' => 'required|string',
            'event-update' => 'nullable|string',
        ]);
       
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $fileContents = file_get_contents($imageFile);
            $base64Image = base64_encode($fileContents);
        } else {
            $base64Image = null; 
        }
        
        Event::create([
            'eventName' => $request->input('event-name'),
            'eventDescription' => $request->input('event-description'),
            'eventImage' => $base64Image,
            'eventDate' => $request->input('event-date'),
            'eventLocation' => $request->input('event-location'),
            'isHeld' => 0,
            'eventParticipantQuota' => $request->input('event-quota'),
            'eventPoints' => $request->input('event-points'),
            'eventType' => $request->input('event-type'),
            'eventUpdates' => $request->input('event-update'),
            'organizerId' => $user->userId
        ]);

        return redirect()->back()->with('success', 'Event created successfully!');
    }
}
