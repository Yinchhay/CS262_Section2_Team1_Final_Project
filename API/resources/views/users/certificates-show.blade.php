@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row mb-2">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30">
                            <a href="{{ route('users.index') }}" class="text-decoration-none dark-purple">
                                User Management
                            </a>
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            <a href="{{ route('users.certificates', [
                                'user' => $user->id,
                            ]) }}"
                                class="text-decoration-none dark-purple">
                                Certificates
                            </a>
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            Show
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12 d-flex flex-row justify-content-between">
                <div class="d-flex flex-row align-items-center gap-4">
                    <div class="">
                        <img src="{{ asset('images/certificate.jpg') }}" alt="" height="370"
                            style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);" id="certImg">
                    </div>

                    <div class="d-flex flex-column gap-3">
                        <div class="text-start w-100 mb-3">
                            <h3 class="title d-flex flex-column gap-1 mb-4 dark-purple">
                                <span>CERTIFICATES</span>
                                <span>ENGLISH ONLINE TESTS {{ ucwords($certificate->test->poster->year) . ' ' . ucwords($certificate->test->poster->month) }}</span>
                                <span
                                    style="font-size: 25px; color: var(--orange);">{{ ucwords($certificate->test->poster->level . ' (Test ' . $certificate->test->order . ')') }}</span>
                            </h3>
                            <span class="fw-normal text-capitalize d-flex flex-column gap-1" style="font-size: 16px;">
                                <span>Test Result: 90%</span>
                                <span>Grade: Excellent</span>
                                <span>Test Taken Date: {{ $certificate->issue_date }}</span>
                            </span>
                        </div>

                        <div class="downloadBtn">
                            <div href="" class="btn btn-dark-purple"
                                onclick="
                                // download
                                var certImg = document.getElementById('certImg');
                                var link = document.createElement('a');
                                link.href = certImg.src;
                                link.download = 'certificate.jpg';
                                link.click();
                                ">
                                <i class='bx bx-download'></i>
                                Download
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row mb-3">
            <div class="col-12">
                <h4>Other Achievement</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="">
                                <img class="img-fluid" src="{{ asset('images/certificate.jpg') }}" alt=""
                                    style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);">
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <div class="text-start w-100 mb-3">
                                    <h3 class="title d-flex flex-column gap-1 mb-1 dark-purple">
                                        <span style="font-size: 18px;">CERTIFICATES</span>
                                        <span style="font-size: 18px;">English Online Tests 2024 March</span>
                                        <span style="font-size: 16px; color: var(--orange);">Beginner (Test 1)</span>
                                    </h3>
                                    <span class="fw-normal text-capitalize" style="font-size: 14px;">
                                        Test Taken Date: April 14, 2024
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="">
                                <img class="img-fluid" src="{{ asset('images/certificate.jpg') }}" alt=""
                                    style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);">
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <div class="text-start w-100 mb-3">
                                    <h3 class="title d-flex flex-column gap-1 mb-1 dark-purple">
                                        <span style="font-size: 18px;">CERTIFICATES</span>
                                        <span style="font-size: 18px;">English Online Tests 2024 March</span>
                                        <span style="font-size: 16px; color: var(--orange);">Beginner (Test 1)</span>
                                    </h3>
                                    <span class="fw-normal text-capitalize" style="font-size: 14px;">
                                        Test Taken Date: April 14, 2024
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex flex-column gap-3">
                            <div class="">
                                <img class="img-fluid" src="{{ asset('images/certificate.jpg') }}" alt=""
                                    style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);">
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <div class="text-start w-100 mb-3">
                                    <h3 class="title d-flex flex-column gap-1 mb-1 dark-purple">
                                        <span style="font-size: 18px;">CERTIFICATES</span>
                                        <span style="font-size: 18px;">English Online Tests 2024 March</span>
                                        <span style="font-size: 16px; color: var(--orange);">Beginner (Test 1)</span>
                                    </h3>
                                    <span class="fw-normal text-capitalize" style="font-size: 14px;">
                                        Test Taken Date: April 14, 2024
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
    <script src=""></script>
@endpush
