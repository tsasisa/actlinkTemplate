@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
    <form action="{{route('organizer.create-event')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" class="form-control" id="event-name" name="event-name" required>  
            @error('event-name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Description</label>
            <input type="text" class="form-control" id="event-description" name="event-description" required>  
            @error('event-description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" required>  
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event-date" name="event-date" required>  
            @error('event-date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Location</label>
            <input type="text" class="form-control" id="event-location" name="event-location" required>  
            @error('event-location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Participant Quota</label>
            <input type="text" class="form-control" id="event-quota" name="event-quota" required>  
            @error('event-quota')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Points</label>
            <input type="text" class="form-control" id="event-points" name="event-points" required>  
            @error('event-points')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Type</label>
            <select name="event-type" id="event-type" class="form-control">
                <option value="Environment">Environment</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Education">Education</option>
                <option value="Social">Social</option>
            </select>  
            @error('event-points')
                <div class="text-type">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection