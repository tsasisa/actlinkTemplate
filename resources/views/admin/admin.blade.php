@extends('layouts.admin.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- Language Switcher -->
                    <div class="d-flex flex-row-reverse">
                        <div class="dropdown">
                            <a 
                                href="#" 
                                class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                                id="localeDropdown" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                            >
                                <i class="bi bi-globe me-3"></i>
                                <span class="text-dark" style="font-weight: 500;">
                                    {{ app()->getLocale() == 'en' ? __('admin.english') : __('admin.indonesia') }}
                                </span>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="localeDropdown">
                                <li>
                                    <a 
                                        class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" 
                                        href="{{ route('set-locale', 'en') }}"
                                    >
                                        {{ __('admin.english') }}
                                    </a>
                                </li>
                                <li>
                                    <a 
                                        class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}" 
                                        href="{{ route('set-locale', 'id') }}"
                                    >
                                        {{ __('admin.indonesia') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="container">
                        <form method="GET" action="{{ route('admin.home') }}" class="mb-4">
                            
                 

                            <div class="row">
                                <!-- Filter by operation -->
                                <div class="col-md-3">
                                    <select name="action" class="form-control">
                                        <option value="">{{ __('admin.select_action') }}</option>
                                        <option value="Created">{{ __('admin.created') }}</option>
                                        <option value="Updated">{{ __('admin.updated') }}</option>
                                        <option value="Deleted">{{ __('admin.deleted') }}</option>
                                        <option value="Accepted">{{ __('admin.accepted') }}</option>
                                        <option value="Declined">{{ __('admin.declined') }}</option>
                                        <option value="Login">{{ __('admin.login') }}</option>
                                    </select>
                                </div>

                                <!-- Filter by date -->
                                <div class="col-md-3">
                                    <!-- Start Date -->
                                    <input type="date" name="start_date" class="form-control" placeholder="{{ __('admin.start_date') }}">
                                </div>

                                <div class="col-md-3">
                                    <!-- End Date -->
                                    <input type="date" name="end_date" class="form-control" placeholder="{{ __('admin.end_date') }}">
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.filter') }}</button>
                                </div>

                            </div>
                        </form>


                    </div>

                        

                    <h5 class="card-title mb-4 d-inline">{{ __('admin.system_logs') }}</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('admin.entity_name') }}</th>
                                <th scope="col">{{ __('admin.operation') }}</th>
                                <th scope="col">{{ __('admin.description') }}</th>
                                <th scope="col">{{ __('admin.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->entityName }}</td>
                                    <td>{{ __('admin.operation_' . strtolower($log->entityOperation)) }}</td>
                                    <td>{{ $log->operationDescription }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->Datetime)->format('d M, Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('no_logs') }}</td> 
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
