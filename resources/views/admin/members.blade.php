@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Member Management</h5>

                <!-- Search Form -->
                <form action="{{ route('admin.members.indexMember') }}" method="GET">
                    <div class="form-group">
                        <label for="searchName">Search by Name</label>
                        <input type="text" id="searchName" name="searchName" class="form-control" placeholder="Enter name to search" value="{{ request()->get('searchName') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Search</button>
                </form>

                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success') !!}</p>
                    </div>
                @endif
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <p>{!! \Session::get('error') !!}</p>
                    </div>
                @endif

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Points</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->memberId }}</td>
                                <td>{{ $member->user->userName }}</td>
                                <td>{{ $member->user->userPhoneNumber ?? 'No Phone' }}</td>
                                <td>{{ $member->user->userType ?? 'No Type' }}</td>
                                <td>{{ $member->memberPoints }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.members.editMember', $member->memberId) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.members.deleteMember', $member->memberId) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
