@extends('layouts.regislogin.regis')

@section('content')
<div class="container text-center py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h2 class="fw-bold">Pending Approval</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted fs-5">
                        Thank you for signing up as an organizer! Your registration is currently under review.
                    </p>
                    <p class="text-muted fs-6">
                        Please wait for the admin to approve your account. We will notify you once the process is complete.
                    </p>
                </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Back to Home</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
