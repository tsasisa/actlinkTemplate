@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
    <h1>Participants</h1>
    @foreach ($participants as $participant)
        <p>{{ $participant->userName }}</p>
    @endforeach
</div>
@endsection