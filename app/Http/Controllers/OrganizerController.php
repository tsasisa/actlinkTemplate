<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Organizer;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use App\Traits\LogsSystemActivity;


class OrganizerController extends Controller
{
    use LogsSystemActivity;
    public function index(){          
        $user = Auth::user(); 
        $organizer = Organizer::where('organizerId', $user->userId)->first();
        $events = Event::where('organizerId', $user->userId)->orderBy('eventDate', 'asc')->paginate(6);

        return view('organizer.organizer', compact( 'user', 'organizer', 'events'));
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

        
        $user = $organizer->user;

        $this->logActivity(
            'Organizer',
            'Updated', 
            'Updated organizer: ' . $user->userName 
        );

        // Redirect to the profile edit page with success message
        return redirect()->route('organizer.home')->with('success', 'Profile updated successfully!');
    }

    public function manageEvent(){

        $eventOrg = Auth::user(); 
        $events = Event::where('organizerId', $eventOrg->userId)->paginate(6); 
         

        return view('organizer.manage-event', compact('events' ));
    }

    public function createEvent(){

        return view('organizer.create-event');
    }

    public function create(Request $request){
        $user = Auth::user();
        $request->validate([
            'event-name' => 'required|string|max:255|min:5',
            'event-description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'event-date' => 'required|date',
            'event-location' => 'required|string|max:255',
            'event-quota' => 'required|integer',
            'event-points' => 'required|integer',
            'event-type' => 'required|string',
        ]);
       
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $fileContents = file_get_contents($imageFile);
            $base64Image = base64_encode($fileContents);
        } else {
            $base64Image = null; 
        }
        
        $event = Event::create([
            'eventName' => $request->input('event-name'),
            'eventDescription' => $request->input('event-description'),
            'eventImage' => $base64Image,
            'eventDate' => $request->input('event-date'),
            'eventLocation' => $request->input('event-location'),
            'isHeld' => 0,
            'eventParticipantQuota' => $request->input('event-quota'),
            'eventPoints' => $request->input('event-points'),
            'eventType' => $request->input('event-type'),
            'organizerId' => $user->userId
        ]);
        
        $this->logActivity(
            'Event',
            'Created',
            'Created event: ' . $event->eventName . ' by organizer: ' . $user->userName
        );

        return redirect('organizer/manage-event');

    }

    public function detail($id){
        $event = Event::with('organizer.user')->findOrFail($id);

        return view('organizer.event-detail', compact('event'));
    }

    public function editEvent($id){
        $event = Event::with('organizer.user')->findOrFail($id);
        return view('organizer.event-edit', compact('event'));
    }

    public function edit($id, Request $request)
{
    $event = Event::with('organizer.user')->findOrFail($id);

    // Update validation rules to allow null values
    $request->validate([
        'event-name' => 'nullable|string|max:255|min:5',
        'event-description' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        'event-date' => 'nullable|date',
        'event-location' => 'nullable|string|max:255',
        'event-quota' => 'nullable|integer',
        'event-points' => 'nullable|integer',
        'event-type' => 'nullable|string',
        'event-update' => 'nullable|string',
    ]);

    // Handle the optional image file
    if ($request->hasFile('image')) {
        $imageFile = $request->file('image');
        $fileContents = file_get_contents($imageFile);
        $base64Image = base64_encode($fileContents);
        $event->eventImage = $base64Image; // Update only if a new image is uploaded
    }

    // Update fields only if they are provided
    if ($request->filled('event-name')) {
        $event->eventName = $request->input('event-name');
    }

    if ($request->filled('event-description')) {
        $event->eventDescription = $request->input('event-description');
    }

    if ($request->filled('event-date')) {
        $event->eventDate = $request->input('event-date');
    }

    if ($request->filled('event-location')) {
        $event->eventLocation = $request->input('event-location');
    }

    if ($request->filled('event-quota')) {
        $event->eventParticipantQuota = $request->input('event-quota');
    }

    if ($request->filled('event-points')) {
        $event->eventPoints = $request->input('event-points');
    }

    if ($request->filled('event-type')) {
        $event->eventType = $request->input('event-type');
    }

    if ($request->filled('event-update')) {
        $event->eventUpdates = $request->input('event-update');
    }

    // Save the updated event
    $event->save();

    return redirect('organizer/manage-event');
    }

    public function viewParticipant($id)
{
    $participants = EventParticipant::where('eventId', $id)
        ->join('users', 'eventparticipants.memberId', '=', 'users.userId')
        ->select('eventparticipants.*', 'users.userName')
        ->get();

    return view('organizer.event-participant', compact('participants'));
}

}
