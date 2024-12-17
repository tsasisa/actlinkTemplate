@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
    <form action="{{route('organizer.create-event')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" class="form-control" id="event-name" name="event-name" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Description</label>
            <input type="text" class="form-control" id="event-description" name="event-description" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event-date" name="event-date" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Location</label>
            <input type="text" class="form-control" id="event-location" name="event-location" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Participant Quota</label>
            <input type="text" class="form-control" id="event-quota" name="event-quota" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Points</label>
            <input type="text" class="form-control" id="event-points" name="event-points" required>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Type</label>
            <select name="event-type" id="event-type" class="form-control">
                <option value="Environment">Environment</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Education">Education</option>
                <option value="Social">Social</option>
            </select>  
        </div>
        <div class="mb-3">
            <label class="form-label">Event Updates</label>
            <input type="text" class="form-control" id="event-update" name="event-update">  
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection