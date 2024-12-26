@extends('layouts.regislogin.regis')

@section('content')
<div class="container text-center py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h2 class="fw-bold">@lang('organizer.Pending-Approval')</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted fs-5">
                        @lang('organizer.Thankyou')
                    </p>
                    <p class="text-muted fs-6">
                        @lang('organizer.Please-wait')
                    </p>
                </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">@lang('organizer.Back-To-Home')</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
