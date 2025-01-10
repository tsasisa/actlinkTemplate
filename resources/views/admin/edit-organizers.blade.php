@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <!-- Language Switcher -->
                <div class="d-flex flex-row-reverse mb-3">
                    <a class="btn btn-primary" style="margin-left: 10px;" href="{{ route('set-locale', 'id') }}">{{ __('admin.indonesia') }}</a>
                    <a class="btn btn-primary" href="{{ route('set-locale', 'en') }}">{{ __('admin.english') }}</a>
                </div>

                <h5 class="card-title mb-4">{{ __('admin.edit_organizer') }}</h5>

                <!-- Form untuk mengedit organizer -->
                <form action="{{ route('admin.organizers.update', $organizer->organizerId) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Input Name -->
                    <div class="form-group">
                        <label for="userName">{{ __('admin.name') }}</label>
                        <input 
                            type="text" 
                            name="userName" 
                            id="userName" 
                            class="form-control @error('userName') is-invalid @enderror" 
                            value="{{ old('userName', $organizer->user->userName) }}" 
                            required>
                        @error('userName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Address -->
                    <div class="form-group">
                        <label for="organizerAddress">{{ __('admin.address') }}</label>
                        <input 
                            type="text" 
                            name="organizerAddress" 
                            id="organizerAddress" 
                            class="form-control @error('organizerAddress') is-invalid @enderror" 
                            value="{{ old('organizerAddress', $organizer->organizerAddress) }}" 
                            required>
                        @error('organizerAddress')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Official Social Media -->
                    <div class="form-group">
                        <label for="officialSocialMedia">{{ __('admin.official_social_media') }}</label>
                        <input 
                            type="url" 
                            name="officialSocialMedia" 
                            id="officialSocialMedia" 
                            class="form-control @error('officialSocialMedia') is-invalid @enderror" 
                            value="{{ old('officialSocialMedia', $organizer->officialSocialMedia) }}" 
                            required>
                        @error('officialSocialMedia')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <button type="submit" class="btn btn-primary">{{ __('admin.save_changes') }}</button>
                    <a href="{{ route('admin.organizers') }}" class="btn btn-secondary">{{ __('admin.cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
