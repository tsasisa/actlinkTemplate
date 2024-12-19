@extends('layouts.navbar.navbar')
@section('content')
<div class="container">
    <h1>Participants</h1>
    @if ($participants->isEmpty())
        <div>
            <h1>This event doesn't have any participants yet</h1>
        </div>
        @else
            @foreach ($participants as $participant)
            <p>{{ $participant->userName }}</p>
        @endforeach
    @endif
    
</div>
@endsection