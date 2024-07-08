@extends('layout.master')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        @include('shared.success-message')

        <div class="row">
            <div class="col-lg-12 text-start poppins dark-purple" style="line-height: 160%;">
                <span class="fs-20">Hey!</span><br>
                <span class="fs-30 text-capitalize">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
            </div>
        </div>
        <div class="row mt-2 g-4">
            <div class="col-lg-12 mx-auto card-box" >
                <div class="card-analysis d-flex flex-row gap-5">
                    <div class="circle-container">
                        <svg class="progress-circle" width="250" height="250" viewBox="0 0 250 250">
                            <circle class="progress-background progress-bg-outer" cx="125" cy="125" r="110">
                            </circle>
                            <circle class="progress-bar progress-bar-outer" cx="125" cy="125" r="110"></circle>
                        </svg>
                        <svg class="progress-circle" width="250" height="250" viewBox="0 0 250 250">
                            <circle class="progress-background progress-bg-inner" cx="125" cy="125" r="80">
                            </circle>
                            <circle class="progress-bar progress-bar-inner" cx="125" cy="125" r="80"></circle>
                        </svg>
                        <div class="numOfUser">
                            <span class="fs-14">Number Of Users</span><br>
                            <span class="fs-16">{{ $numOfUsers }}</span>
                        </div>
                    </div>
                    <div class="stats">
                        @php
                            $numOfUsersTakingTest = \App\Models\UserScore::getUserTakingTest();
                            $numOfUsersPassTest = \App\Models\Certificate::getUserGotCertificates();
                        @endphp
                        <span class="fs-14"><i class="circle-orange"></i>Number of users taking the test - <span
                                class="percentage-inner">{{ number_format($numOfUsersTakingTest * 100 / $numOfUsers, 2) }}</span>%</span>
                        <span class="fs-14"><i class="circle-purple"></i>Percentage of users pass the test - <span
                                class="percentage-outer">{{ number_format($numOfUsersPassTest * 100 / $numOfUsersTakingTest, 2) }}</span>%</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 card-box">
                <div class="card popular-activities" style="height: 372px;">
                    <div class="card-body">
                        <h5 class="card-title">Most Popular Activities</h5>
                        <div class="card-sections">
                            <div class="card-section">
                                <h6 class="card-subtitle">Materials</h6>
                                <div class="card-content">
                                    @forelse ($mostPopularPosters['materials'] as $material)
                                        <div class="poster">
                                            <a href="{{ route('materials.posters.show', $material->id) }}">
                                                <img class="poster_img" src="{{ $material->getImageUrl() }}"
                                                    alt="{{ $material->title }}" height="100">
                                            </a>
                                            <span class="text">
                                                <svg width="10" height="10" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_176_3877)">
                                                        <path
                                                            d="M8.73948 11.4443L5.71579 18.743L14.0483 10.8711L11.0255 9.61905L14.0491 2.32036L5.89009 10.0285L8.73948 11.4443Z"
                                                            stroke="#9B5BDC" stroke-width="1.23386" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_176_3877">
                                                            <rect width="19" height="19" fill="white"
                                                                transform="translate(0.615234 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ $material->taken }}
                                            </span>
                                        </div>
                                    @empty
                                        <p>No materials found</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-section">
                                <h6 class="card-subtitle">Online Tests</h6>
                                <div class="card-content">
                                    @forelse ($mostPopularPosters['online tests'] as $onlineTest)
                                        <div class="poster">
                                            <a href="{{ route('online-tests.posters.show', $onlineTest->id) }}">
                                                <img class="poster_img" src="{{ $onlineTest->getImageUrl() }}"
                                                    alt="{{ $onlineTest->title }}" height="100">
                                            </a>
                                            <span class="text">
                                                <svg width="10" height="10" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_176_3877)">
                                                        <path
                                                            d="M8.73948 11.4443L5.71579 18.743L14.0483 10.8711L11.0255 9.61905L14.0491 2.32036L5.89009 10.0285L8.73948 11.4443Z"
                                                            stroke="#9B5BDC" stroke-width="1.23386" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_176_3877">
                                                            <rect width="19" height="19" fill="white"
                                                                transform="translate(0.615234 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ $onlineTest->taken }}
                                            </span>
                                        </div>
                                    @empty
                                        <p>No online tests found</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 card-box">
                <div class="card recently-uploaded" style="height: 372px;">
                    <div class="card-body">
                        <h5 class="card-title">Recently Uploaded</h5>
                        <div class="card-sections">
                            <div class="card-section">
                                <h6 class="card-subtitle">Materials</h6>
                                <div class="card-content">
                                    @forelse ($recentPosters['materials'] as $material)
                                        <div class="poster">
                                            <a href="{{ route('materials.posters.show', $material->id) }}">
                                                <img class="poster_img" src="{{ $material->getImageUrl() }}"
                                                    alt="{{ $material->title }}" height="100">
                                            </a>
                                            <span class="text">
                                                <svg width="10" height="10" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_176_3877)">
                                                        <path
                                                            d="M8.73948 11.4443L5.71579 18.743L14.0483 10.8711L11.0255 9.61905L14.0491 2.32036L5.89009 10.0285L8.73948 11.4443Z"
                                                            stroke="#9B5BDC" stroke-width="1.23386"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_176_3877">
                                                            <rect width="19" height="19" fill="white"
                                                                transform="translate(0.615234 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ $material->taken }}
                                            </span>
                                        </div>
                                    @empty
                                        <p>No materials found</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-section">
                                <h6 class="card-subtitle">Online Tests</h6>
                                <div class="card-content">
                                    @forelse ($recentPosters['online tests'] as $onlineTest)
                                        <div class="poster">
                                            <a href="{{ route('online-tests.posters.show', $onlineTest->id) }}">
                                                <img class="poster_img" src="{{ $onlineTest->getImageUrl() }}"
                                                    alt="{{ $onlineTest->title }}" height="100">
                                            </a>
                                            <span class="text">
                                                <svg width="10" height="10" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_176_3877)">
                                                        <path
                                                            d="M8.73948 11.4443L5.71579 18.743L14.0483 10.8711L11.0255 9.61905L14.0491 2.32036L5.89009 10.0285L8.73948 11.4443Z"
                                                            stroke="#9B5BDC" stroke-width="1.23386"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_176_3877">
                                                            <rect width="19" height="19" fill="white"
                                                                transform="translate(0.615234 0.5)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ $onlineTest->taken }}
                                            </span>
                                        </div>
                                    @empty
                                        <p>No online tests found</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endpush
