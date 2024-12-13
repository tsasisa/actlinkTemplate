@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Edit Member</h5>

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

                <!-- Form untuk mengedit member -->
                <form action="{{ route('admin.members.updateMember', $member->memberId) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama -->
                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" name="userName" id="userName" class="form-control" value="{{ old('userName', $member->user->userName) }}" required>
                    </div>

                    <!-- Input Phone Number -->
                    <div class="form-group">
                        <label for="userPhoneNumber">Phone Number</label>
                        <input type="text" name="userPhoneNumber" id="userPhoneNumber" class="form-control" value="{{ old('userPhoneNumber', $member->user->userPhoneNumber) }}">
                    </div>

                    <!-- Input Date of Birth -->
                    <div class="form-group">
                        <label for="memberDOB">Date of Birth</label>
                        <input type="date" name="memberDOB" id="memberDOB" class="form-control" value="{{ old('memberDOB', $member->memberDOB) }}">
                    </div>

                    <!-- Input Points -->
                    <div class="form-group">
                        <label for="memberPoints">Points</label>
                        <input type="number" name="memberPoints" id="memberPoints" class="form-control" value="{{ old('memberPoints', $member->memberPoints) }}">
                    </div>

                    <!-- Dropdown untuk role (userType) -->
                    <div class="form-group">
                        <label for="userType">Role</label>
                        <select name="userType" id="userType" class="form-control">
                            <option value="admin" {{ $member->user->userType == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="organizer" {{ $member->user->userType == 'organizer' ? 'selected' : '' }}>Organizer</option>
                        </select>
                    </div>
                    
                    <!-- Tombol Save Changes -->
                    <br>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('admin.members.indexMember') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
