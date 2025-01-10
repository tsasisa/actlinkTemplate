@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <!-- Flash Messages -->
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

                <!-- Language Switcher -->
                <div class="d-flex flex-row-reverse">
                    <a class="btn btn-primary" style="margin-left: 10px;" href="{{ route('set-locale', 'id') }}">{{ __('admin.indonesia') }}</a>
                    <a class="btn btn-primary" href="{{ route('set-locale', 'en') }}">{{ __('admin.english') }}</a>
                </div>

                <h5 class="card-title mb-4">{{ __('admin.organizer_management') }}</h5>

                <!-- Filter Organizer -->
                <form method="GET" action="{{ route('admin.organizers') }}">
                    <div class="form-inline mb-4">
                        <label for="status" class="mr-2">{{ __('admin.filter_status') }}:</label>
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">{{ __('admin.all') }}</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('admin.pending') }}</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>{{ __('admin.accepted') }}</option>
                        </select>
                    </div>
                </form>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>{{ __('admin.id') }}</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.address') }}</th>
                            <th>{{ __('admin.social_media') }}</th>
                            <th>{{ __('admin.email') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizers as $organizer)
                            <tr>
                                <td>{{ $organizer->organizerId }}</td>
                                <td>{{ $organizer->user->userName }}</td>
                                <td>{{ $organizer->organizerAddress ?? __('admin.no_address') }}</td>
                                <td>{{ $organizer->officialSocialMedia }}</td>
                                <td>{{ $organizer->user->userEmail }}</td>
                                <td>
                                    @if ($organizer->activeFlag)
                                        <span class="badge badge-success">{{ __('admin.accepted') }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ __('admin.pending') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$organizer->activeFlag)
                                        <a href="{{ route('admin.organizers.accept', $organizer->organizerId) }}" class="btn btn-success btn-sm">{{ __('admin.accept') }}</a>
                                        <a href="{{ route('admin.organizers.decline', $organizer->organizerId) }}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('admin.confirm_decline') }}')">{{ __('admin.decline') }}</a>
                                    @else
                                        <a href="{{ route('admin.organizers.edit', $organizer->organizerId) }}" class="btn btn-warning btn-sm">{{ __('admin.edit') }}</a>
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
