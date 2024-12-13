@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Organizer</h5>

                <!-- Display errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.organizers.update', $organizer->organizerId) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" name="userName" id="userName" class="form-control" value="{{ old('userName', $organizer->user->userName) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="organizerAddress">Address</label>
                        <input type="text" name="organizerAddress" id="organizerAddress" class="form-control" value="{{ old('organizerAddress', $organizer->organizerAddress) }}">
                    </div>

                    <div class="form-group">
                        <label for="officialSocialMedia">Official Social Media</label>
                        <input type="text" name="officialSocialMedia" id="officialSocialMedia" class="form-control" value="{{ old('officialSocialMedia', $organizer->officialSocialMedia) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.organizers') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
