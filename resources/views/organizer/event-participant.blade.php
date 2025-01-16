@extends('layouts.navbar.navbar')
@section('content')
<div id="app">
    <div class="container my-4">
        <h1 class="page-title">@lang('organizer.Participants')</h1>
        
        <!-- Search Form -->
        <form method="GET" action="{{ route('organizer.search-participant') }}" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="@lang('organizer.Search-Placeholder')" name="searchTerm">
                <button class="btn btn-outline-secondary" type="submit">@lang('organizer.Search-Button')</button>
            </div>
        </form>
        
        @if ($participants->isEmpty())
            <div class="alert alert-warning text-center animate__animated animate__fadeInUp">
                <h4>@lang('organizer.No-Participants')</h4>
            </div>
        @else
            <div class="table-responsive animate__animated animate__fadeInUp">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">@lang('organizer.Participant-Name')</th>
                            <th scope="col">@lang('organizer.Email')</th>
                            <th scope="col">@lang('organizer.Phone')</th>
                            <th scope="col">@lang('organizer.Photo')</th>
                            <th scope="col">@lang('organizer.Join-Date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $index => $participant)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $participant->userName }}</td>
                                <td>{{ $participant->userEmail }}</td>
                                <td>{{ $participant->userPhoneNumber }}</td>
                                <td>
                                    <img src="data:image/jpeg;base64,{{ $participant->userImage }}" 
                                         alt="Participant Photo" 
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td>{{ \Carbon\Carbon::parse($participant->registeredDate)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
</div>

<style>
    .page-title {
        font-family: 'Roboto', sans-serif !important;
        font-size: 2.5rem;
        font-weight: 500;
    }
</style>
@endsection
