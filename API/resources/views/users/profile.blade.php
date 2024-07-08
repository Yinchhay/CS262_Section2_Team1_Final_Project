@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30">
                            <a href="{{ route('users.index') }}" class="text-decoration-none dark-purple">
                                User Management
                            </a>
                        </li>
                        <li class="breadcrumb-item active fs-20 text-capitalize" aria-current="page">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-7 mx-auto">
                <div class="profile d-flex flex-row align-items-center gap-3 mb-4">
                    <div class="profile-img">
                        <span
                            class="tag d-flex justify-content-center align-items-center overflow-hidden saria-condensed">
                            {{ $user->first_name[0] . $user->last_name[0] }}
                        </span>
                    </div>
                    <div class="username d-flex flex-column">
                        <h3 class="fw-medium m-0">{{ $user->first_name }}</h3>
                        <h3 class="fw-medium m-0">{{ $user->last_name }}</h3>
                    </div>
                </div>
                <div class="profile-information">
                    <table class="table table-hover table-striped">
                        <tr>
                            <td>User ID</td>
                            <td>{{ str_pad($user->id, 8, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Registerd Date</td>
                            <td>{{ date('F j, Y H:i:s', strtotime($user->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Updated Date</td>
                            <td>{{ date('F j, Y H:i:s', strtotime($user->updated_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('scripts')
    <script src=""></script>
@endpush
