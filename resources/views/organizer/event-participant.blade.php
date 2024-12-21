@extends('layouts.navbar.navbar')
@section('content')
<div class="container my-4">
    <h1 class="page-title">Participants</h1>
    
    @if ($participants->isEmpty())
        <div class="alert alert-warning text-center animate__animated animate__fadeInUp">
            <h4>This Event Doesn't Have Any Participants Yet</h4>
        </div>
    @else
        <div class="table-responsive animate__animated animate__fadeInUp">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Participant Name</th>
                        <th scope="col">Join Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $index => $participant)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $participant->userName }}</td>
                            <td>{{ \Carbon\Carbon::parse($participant->registeredDate)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .page-title {
        font-family: 'Roboto', sans-serif !important;
        font-size: 2.5rem;
        font-weight: 500;
    }
</style>
@endsection
