@extends('layouts.admin.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="container">
                        <form method="GET" action="{{ route('admin.home') }}" class="mb-4">
                            <div class="row">
                                <!-- Filter by operation -->
                                <div class="col-md-3">
                                    <select name="action" class="form-control">
                                        <option value="">Select Action</option>
                                        <option value="Created">Created</option>
                                        <option value="Updated">Updated</option>
                                        <option value="Deleted">Deleted</option>
                                        <option value="Accepted">Accepted</option>
                                        <option value="Declined">Declined</option>
                                        <option value="Login">Login</option>
                                    </select>
                                </div>

                                <!-- Filter by date -->
                                <div class="col-md-3">
                                    <!-- Start Date -->
                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                </div>

                                <div class="col-md-3">
                                    <!-- End Date -->
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>


                    </div>

                    <h5 class="card-title mb-4 d-inline">System Logs</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Entity Name</th>
                                <th scope="col">Operation</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->entityName }}</td>
                                    <td>{{ ucfirst($log->entityOperation) }}</td>
                                    <td>{{ $log->operationDescription }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->Datetime)->format('d M, Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No logs found</td>
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
