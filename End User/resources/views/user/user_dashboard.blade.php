@extends('layout.user_master')

@section('title', 'User Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user_dashboard.css') }}">
@endpush

@section('content')
    @include('shared.success-message')

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12 d-flex">

                <!-- Default Card -->
                <div class="col-sm-4 card mb-4">
                    <div class="card-body">
                        <a href="{{ route('test.index') }}">
                            <h6>Take an</h6>
                            <h1 class="card-title">Online Test</h1>
                            <p>Take Now</p>
                        </a>

                    </div>
                </div><!-- End Default Card -->

                <!-- Default Card -->
                <div class="col-sm-4 card mb-4">
                    <div class="card-body">
                        <a href="{{ route('material.index') }}">
                            <h6>Take an</h6>
                            <h1 class="card-title">Online Study</h1>
                            <p>Practice Now</p>
                        </a>
                    </div>
                </div><!-- End Default Card -->

                <!-- Default Card -->
                <div class="col-sm-4 card mb-4">
                    <div class="card-body">
                        <a href="{{ route('scoreboard.index') }}">
                            <h6>See your</h6>
                            <h1 class="card-title">Scoreboard</h1>
                            <p>Watch Now</p>
                        </a>

                    </div>
                </div><!-- End Default Card -->

            </div>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-lg-12 d-flex">

                <div class="col-sm-4 activity-card mb-4">
                    <div class="card-body">
                        <h3>Current Activity</h3>
                        <hr>
                        <p>Material</p>
                        <div class="row">
                            <div class="side-scroll col-sm-1 d-flex">
                                @foreach ($materialPosters as $material)
                                    <div class="activity-poster">
                                        <a href="{{ route('material.select', $material->id) }}">
                                            <img src="{{ asset('assets/img/english_material_image.png') }}" alt="">
                                        </a>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        <p>Online Test</p>
                        <div class="row">
                            <div class="side-scroll col-sm-1 d-flex">
                                @foreach ($onlineTestPosters as $test)
                                    <div class="activity-poster">
                                        <a href="{{ route('test.select', $test->id) }}">
                                            <img src="{{ asset('assets/img/english_online_test_image.png') }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 performance-card mb-5 ">
                    <div class="card-body">
                        <h3>Performance</h3>

                        <h4 class="small font-weight-bold">Materials <span class="float-right">20%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>



                        <h4 class="small font-weight-bold">Online Test <span class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </section>



@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
