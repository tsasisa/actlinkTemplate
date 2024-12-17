@extends('layouts.navbar.navbar')
@section('content')
<div class="container">

    <a href="{{route('organizer.create-event')}}"><button type="button" class="btn btn-success">Create Event</button></a>
    <h1>Your Events</h1>
</div>
@endsection