@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/user-management-profile.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="container-fluid">
            <div class="row">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 ">

                            <div class="profile-card mt-5">
                                <div class="profile-header d-flex">
                                    <div class="avatar"><img src="{{ asset('images/profile.png') }}"></div>
                                    <h4>Jimmy James</h4>
                                </div>
                                <table class="table table-striped table-borderless mt-3">
                                    <tbody>
                                        <tr>
                                            <th scope="row">User ID:</th>
                                            <td>00000001</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Full Name:</th>
                                            <td>Jimmy James</td>
                                            <td><i class="bi bi-pencil-square"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Registered Date:</th>
                                            <td>2024-April-14</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Country:</th>
                                            <td>Cambodia</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone Number:</th>
                                            <td>12 345 678</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email:</th>
                                            <td>jimmyjames12@gmail.com</td>
                                            <td><i class="bi bi-pencil-square"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Password:</th>
                                            <td>••••••••</td>
                                            <td><i class="bi bi-pencil-square"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-left mt-3 button">
                                    <button class="btn btn-primary">Edit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
