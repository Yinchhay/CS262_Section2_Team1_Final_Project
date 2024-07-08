@extends('layout.user_master')

@section('title', 'User Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush

@section('content')


    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12 ">

                <div class="profile-card mt-5">
                    <div class="profile-header d-flex">
                        <div class="avatar">
                            <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('profile/defaultProfile.jpg') }}" id="profileImage">
                        </div>
                        <h4>{{ ucwords(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}</h4>
                    </div>
                    <table class="table table-striped table-borderless mt-3">
                        <tbody>
                            <tr>
                                <th scope="row">User ID:</th>
                                <td>{{ str_pad(Auth::user()->id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">Full Name:</th>
                                <td><input type="text" value="{{ ucwords(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}" style="border: none"></td>
                                <td><i class="bi bi-pencil-square"></i></td>
                            </tr>
                            <tr>
                                <th scope="row">Registered Date:</th>
                                <td>{{ Auth::user()->created_at->format('Y-m-d') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">Email:</th>
                                <td>{{ Auth::user()->email }}</td>
                                <td></td>
                            </tr>


                        </tbody>
                    </table>
                    <div class="text-left mt-3 button">
                        <a class="btn btn-primary" href="{{ route('user.edit') }}">Edit</a>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
