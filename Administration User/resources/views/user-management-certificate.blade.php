@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/user-management-certificate.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="container mt-3 mb-5">
            <h2 class="purple-text link-mn">
                <a href="#user-management">User Management</a> >
                <a href="#jimmy-james">Jimmy James</a> >
                <a href="#activities">Certificate</a>
            </h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h3>Certificate</h3> -->
                    <div class="card no-border-cert">
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <img src="{{ asset('images/certificate.jpg') }}" class="certificate-img-big" alt="Certificate">
                            </div>
                            <div class="col-md-4">
                                <div class="card-body-big">
                                    <h5 class="certificate-title">CERTIFICATE</h5>
                                    <p class="certificate-text">English Online Test</p>
                                    <p class="certificate-text1">2024 March</p>
                                    <p class="certificate-subtext">Beginner (Test 1)</p>
                                    <p class="certificate-text2">Result: 90%</p>
                                    <p class="certificate-text2">Grade: Excellent</p>
                                    <p class="certificate-text2">Test Taken Date: April 14, 2024</p>
                                    <a href="#" class="btn download-btn"><i class="fas fa-download"></i> Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-5 purple-text mb-4">Other Achievements</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card no-border-card">
                        <a href="#">
                            <img src="{{ asset('images/certificate.jpg') }}" class="card-img-top certificate-img" alt="Certificate">
                        </a>
                        <div class="card-body px-0">
                            <h5 class="card-title">CERTIFICATE</h5>
                            <p class="card-text">English Online Test 2024 March</p>
                            <p class="card-text1">Beginner (Test 3)</p>
                            <p class="card-text2">Test Taken Date: March 14, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card no-border-card">
                        <a href="#">
                            <img src="{{ asset('images/certificate.jpg') }}" class="card-img-top certificate-img" alt="Certificate">
                        </a>
                        <div class="card-body px-0">
                            <h5 class="card-title">CERTIFICATE</h5>
                            <p class="card-text">English Online Test 2024 March</p>
                            <p class="card-text1">Beginner (Test 1)</p>
                            <p class="card-text2">Test Taken Date: May 14, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card no-border-card">
                        <a href="#">
                            <img src="{{ asset('images/certificate.jpg') }}" class="card-img-top certificate-img" alt="Certificate">
                        </a>
                        <div class="card-body px-0">
                            <h5 class="card-title">CERTIFICATE</h5>
                            <p class="card-text">English Online Test 2024 March</p>
                            <p class="card-text1">Beginner (Test 2)</p>
                            <p class="card-text2">Test Taken Date: January 14, 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
