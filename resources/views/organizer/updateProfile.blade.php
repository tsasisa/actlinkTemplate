@extends('layouts.navbar.navbar')
@section('content')
<div id="app">
<div class="container my-3">
    <form action="{{ route('organizer.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">@lang('organizer.Name')</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control"
                    value="{{ $user->userName }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label for="email">@lang('organizer.Email')</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="{{ $user->userEmail }}" 
                    required
                >
            </div>

            <div class="mb-3">
                <label for="phone">@lang('organizer.Phone')</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="form-control" 
                    value="{{ $user->userPhoneNumber }}" 
                >
            </div>

            <div class="mb-3">
                <label for="phone">@lang('organizer.Address')</label>
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    class="form-control" 
                    value="{{ $organizer->organizerAddress }}" 
                >
            </div>

            <div class="mb-3">
                <label for="phone">@lang('organizer.Social-Media')</label>
                <input 
                    type="text" 
                    id="sosmed" 
                    name="sosmed" 
                    class="form-control" 
                    value="{{ $organizer->officialSocialMedia }}" 
                >
            </div>

            <button type="submit" class="btn btn-primary">@lang('organizer.Submit')</button>
        </form>
    </div>
</div>
    
@endsection