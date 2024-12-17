@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
    <a href="{{ route('organizer.updateProfile') }}"><button type="button" class="btn btn-success">Edit Profile</button></a>
    <a href="{{ route('organizer.manage-event') }}"><button type="button" class="btn btn-success">Manage Event</button></a>
</div>
@endsection