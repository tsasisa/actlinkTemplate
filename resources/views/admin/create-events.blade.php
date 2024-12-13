@extends('layouts.admin.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create New Event</h5>
                <form method="POST" action="{{ route('admin.storeEvent') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Event Name -->
                    <div class="form-outline mb-4">
                        <input type="text" name="eventName" class="form-control" placeholder="Event Name" required />
                        @error('eventName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Description -->
                    <div class="form-outline mb-4">
                        <textarea name="eventDescription" class="form-control" placeholder="Event Description" required></textarea>
                        @error('eventDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Date -->
                    <div class="form-outline mb-4">
                        <input type="datetime-local" name="eventDate" class="form-control" required id="eventDate" />
                        @error('eventDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Location -->
                    <div class="form-outline mb-4">
                        <input type="text" name="eventLocation" class="form-control" placeholder="Event Location" required />
                        @error('eventLocation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Participant Quota -->
                    <div class="form-outline mb-4">
                        <input type="number" name="eventParticipantQuota" class="form-control" placeholder="Participant Quota" required />
                        @error('eventParticipantQuota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Image -->
                    <div class="form-outline mb-4">
                        <input type="file" name="eventImage" class="form-control" />
                        @error('eventImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Organizer Dropdown -->
                    <div class="form-outline mb-4">
                        <select name="organizerId" class="form-control" required>
                            <option value="">Select Organizer</option>
                            @foreach($organizers as $organizer)
                                <option value="{{ $organizer->organizerId }}">{{ $organizer->user->userName }}</option>
                            @endforeach
                        </select>
                        @error('organizerId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Type Dropdown -->
                    <div class="form-outline mb-4">
                        <select name="eventType" class="form-control" required>
                            <option value="">Select Event Type</option>
                            <option value="Environment">Environment</option>
                            <option value="Social">Social</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Education">Education</option>
                        </select>
                        @error('eventType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Updates -->
                    <div class="form-outline mb-4">
                        <textarea name="eventUpdates" class="form-control" placeholder="Event Updates" rows="3"></textarea>
                        @error('eventUpdates')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Event Points -->
                    <div class="form-outline mb-4">
                        <input type="number" name="eventPoints" class="form-control" placeholder="Event Points" required />
                        @error('eventPoints')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
