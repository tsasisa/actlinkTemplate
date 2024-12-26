@extends('layouts.navbar.navbar')
@section('content')
<div class="container my-4">
    <form action="{{route('organizer.create-event')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Event-Name')</label>
            <input type="text" class="form-control" id="event-name" name="event-name" required>  
            @error('event-name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Event-Description')</label>
            <input type="text" class="form-control" id="event-description" name="event-description" required>  
            @error('event-description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Upload-Image')</label>
            <input type="file" class="form-control" id="image" name="image" required>  
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Event-Date')</label>
            <input type="date" class="form-control" id="event-date" name="event-date" required>  
            @error('event-date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Event-Location')</label>
            <input type="text" class="form-control" id="event-location" name="event-location" required>  
            @error('event-location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Event-Participant-Quota')</label>
            <input type="text" class="form-control" id="event-quota" name="event-quota" required>  
            @error('event-quota')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Points')</label>
            <input type="text" class="form-control" id="event-points" name="event-points" required>  
            @error('event-points')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">@lang('organizer.Event-Type')</label>
            <select name="event-type" id="event-type" class="form-control">
                <option value="Environment">@lang('organizer.Environment')</option>
                <option value="Healthcare">@lang('organizer.Healthcare')</option>
                <option value="Education">@lang('organizer.Education')</option>
                <option value="Social">@lang('organizer.Social')</option>
            </select>  
            @error('event-points')
                <div class="text-type">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">@lang('organizer.Submit')</button>
    </form>
</div>

@endsection