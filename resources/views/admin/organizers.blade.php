@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
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
                @if (\Session::has('success_delete'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success_delete') !!}</p>
                    </div>
                @endif

                <h5 class="card-title mb-4">Organizer Management</h5>

                <!-- Filter Organizer -->
                <form method="GET" action="{{ route('admin.organizers') }}">
                    <div class="form-inline mb-4">
                        <label for="status" class="mr-2">Filter Status:</label>
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option> 
                        </select>
                    </div>
                </form>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Social Media</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizers as $organizer)
                            <tr>
                                <td>{{ $organizer->organizerId }}</td>
                                <td>{{ $organizer->user->userName }}</td>
                                <td>{{ $organizer->organizerAddress ?? 'No Address' }}</td>
                                <td>{{ $organizer->officialSocialMedia }}</td>
                                <td>{{ $organizer->user->userEmail }}</td>
                                <td>
                                    @if ($organizer->activeFlag)
                                        <span class="badge badge-success">Accepted</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$organizer->activeFlag)
                                        <a href="{{ route('admin.organizers.accept', $organizer->organizerId) }}" class="btn btn-success btn-sm">Accept</a>
                                        <a href="{{ route('admin.organizers.decline', $organizer->organizerId) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to decline this organizer?')">Decline</a>
                                    @else
                                        <a href="{{ route('admin.organizers.edit', $organizer->organizerId) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $organizers->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
