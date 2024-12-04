@extends('layouts.admin')


@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <div class="container">

                    {{-- @if(\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{!! \Session::get('success') !!}</p>
                        </div>
                    @endif --}}
                </div>

                <h5 class="card-title mb-4 d-inline">Admins</h5>
                <a href="#" class="btn btn-primary mb-4 text-center float-right">
                    Filter</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Entity Name</th>
                            <th scope="col">Operation</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($allAdmins as $allAdmin)
                            <tr>
                                <th scope="row">#</th>
                                <td>#</td>
                                <td>#</td>

                            </tr>
                        @endforeach --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
