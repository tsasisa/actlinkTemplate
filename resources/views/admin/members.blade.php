@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row-reverse">
                            <a class="btn btn-primary" style="margin-left: 10px;" href="{{ route('set-locale','id') }}">{{ __('admin.indonesia') }}</a>
                            <a class="btn btn-primary" href="{{ route('set-locale','en') }}">{{ __('admin.english') }}</a>
                </div>

                <!-- Title -->
                <h5 class="card-title mb-4">{{ __('admin.member_management') }}</h5>

                <!-- Search Form -->
                <form action="{{ route('admin.members.indexMember') }}" method="GET">
                    <div class="form-group">
                        <label for="searchName">{{ __('admin.search_by_name') }}</label>
                        <input type="text" id="searchName" name="searchName" class="form-control" placeholder="{{ __('admin.enter_name') }}" value="{{ request()->get('searchName') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">{{ __('admin.search') }}</button>
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
                            <th>{{ __('admin.id') }}</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.phone') }}</th>
                            <th>{{ __('admin.role') }}</th>
                            <th>{{ __('admin.points') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->memberId }}</td>
                                <td>{{ $member->user->userName }}</td>
                                <td>{{ $member->user->userPhoneNumber ?? __('admin.no_phone') }}</td>
                                <td>{{ $member->user->userType ?? __('admin.no_type') }}</td>
                                <td>{{ $member->memberPoints }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.members.edit', $member->memberId) }}" class="btn btn-warning btn-sm">{{ __('admin.edit') }}</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.members.delete', $member->memberId) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">{{ __('admin.delete') }}</button>
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
