@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/user-management-activities.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="container mt-3 mb-4">
            <h2 class="purple-text link-mn">
                <a href="#user-management">User Management</a> >
                <a href="#jimmy-james">Jimmy James</a> >
                <a href="#activities">Activities</a>
              </h2>

            <div class="input-group gap-3 mb-4 mt-5">
                <div class="search-input">
                    <input type="text" class="form-control rounded-input" placeholder="Search...">
                </div>
                <div class="dropdown-input-1 input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle rounded-input purple-button" type="button" data-toggle="dropdown">Recently Taken</button>
                    <div class="dropdown-menu">
                        <!-- Dropdown menu items -->
                    </div>
                </div>
                <div class="dropdown-input-2 input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle rounded-input purple-button" type="button" data-toggle="dropdown">Year</button>
                    <div class="dropdown-menu">
                        <!-- Dropdown menu items -->
                    </div>
                </div>
            </div>

            <div class='info-box'>
              <h4>Request Online Test</h4>
              <p>Online Test for April 4, 2024 at 9:00 AM, on April 12, 2024 10:00 AM.</p>
            </div>

        </div>

        <div class="container mt-3">
            <div class="row align-items-center mb-3">
                <div class="col-md-2">
                    <h2 class="purple-text">Materials</h2>
                </div>
                <div class="col-md-6">
                    <div class="progress">
                        <div id="progress-bar-m" class="progress-bar bg-custom-pro" role="progressbar" style="width: 86%;" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100">Overall Score: 86%</div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_material_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">English Materials</h5>
                            <p class="card-text">Beginner 2024 January</p>

                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_material_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">English Materials</h5>
                            <p class="card-text">Beginner 2024 February</p>

                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_material_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">English Materials</h5>
                            <p class="card-text">Beginner 2024 March</p>

                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_material_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">English Materials</h5>
                            <p class="card-text">Beginner 2024 April</p>

                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_material_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">English Materials</h5>
                            <p class="card-text">Beginner 2024 May</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-3">
                <div class="col-md-2">
                    <h2 class="purple-text">Online Test</h2>
                </div>
                <div class="col-md-6">
                    <div class="progress">
                        <div id="progress-bar-o" class="progress-bar purple-bg" role="progressbar" style="width: 86%;" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100">Overall Score: 86%</div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_online_test_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">English Online Test</h5>
                            <p class="card-text">Beginner 2024 January</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_online_test_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">English Online Test</h5>
                            <p class="card-text">Beginner 2024 February</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_online_test_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">English Online Test</h5>
                            <p class="card-text">Beginner 2024 March</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_online_test_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">English Online Test</h5>
                            <p class="card-text">Beginner 2024 April</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4 card-col">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/english_online_test_image.png') }}" class="card-img-top" alt="English Material">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">English Online Test</h5>
                            <p class="card-text">Beginner 2024 May</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user-management-activities.js') }}"></script>
@endpush
