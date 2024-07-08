@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/user-management-activities-display.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="container mt-3 mb-4">
            <h2 class="purple-text link-mn">
                <a href="#user-management">User Management</a> >
                <a href="#jimmy-james">Jimmy James</a> >
                <a href="#activities">Activities</a>
            </h2>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 image-container">
                    <img src="{{ asset('images/english_material_image.png') }}" alt="English Materials" class="img-fluid material-image">
                </div>
                <div class="col-md-8 ml-4 d-flex align-items-start flex-column justify-content-center">
                    <h3 class="purple-text">ENGLISH MATERIALS</h3>
                    <h4 class="text-orr">Beginner 2024 January</h4>
                    <p class="mt-4">
                        <img src="{{ asset('images/calen-icon.png') }}" alt="Published Icon" width="25px" height="25px"> Published on: April 14, 2024<br>
                        <img src="{{ asset('images/lightning-icon.png') }} " alt="Materials Taken Icon" width="25px" height="25px"> Materials taken: 123,256
                    </p>
                </div>
            </div>

            <div class="container no-padding mt-5">
                <div class="card mt-5 resizable-card pad-s" style="width: fit-content;">
                    <div class="card-body">
                        <h5 class="card-title mb-4 custom-text">English Material 1 <small class="custom-text">(Taken Date: April 14, 2024)</small></h5>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-4 pb-1 border rounded resizable-box border-blue">
                                    <img src="{{ asset('images/vocab-icon.png') }}" alt="Vocabulary" class="img-fluid img-filter blue-filter mb-0">
                                    <p class="mt-2">Vocabulary</p>
                                    <div class="circular-progress border-blue" data-progress="80">
                                        <svg width="60" height="60">
                                            <circle class="circle-bg" cx="30" cy="30" r="25" style="stroke: rgb(118, 171, 242);"></circle>
                                            <circle class="circle" cx="30" cy="30" r="25"></circle>
                                        </svg>
                                        <div class="inner">80%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 pb-1 border rounded resizable-box border-green">
                                        <img src="{{ asset('images/grammar-icon.png') }}" alt="Grammar" class="img-fluid img-filter green-filter mb-0">
                                        <p class="mt-2">Grammar</p>
                                        <div class="circular-progress border-green" data-progress="80">
                                            <svg width="60" height="60">
                                                <circle class="circle-bg" cx="30" cy="30" r="25" style="stroke: rgb(180, 210, 179);"></circle>
                                                <circle class="circle" cx="30" cy="30" r="25"></circle>
                                            </svg>
                                            <div class="inner">80%</div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 pb-1 border rounded resizable-box border-red">
                                    <img src="{{ asset('images/listen-icon.png') }}" alt="Listening" class="img-fluid img-filter-lis red-filter mb-0">
                                    <p class="mt-2">Listening</p>
                                    <div class="circular-progress border-red" data-progress="80">
                                        <svg width="60" height="60">
                                            <circle class="circle-bg" cx="30" cy="30" r="25" style="stroke: lightcoral;"></circle>
                                            <circle class="circle" cx="30" cy="30" r="25"></circle>
                                        </svg>
                                        <div class="inner">80%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 fullM-sty">
                            <div class="row align-items-center">
                                <div class="col-3 text-center ">
                                    <p class="font-weight-bold mb-0 custom-text">Full Material</p>
                                </div>
                                <div class="col-9">
                                    <div class="progress resizable-progress">
                                        <div id="progress-bar-fullM" class="progress-bar bg-custom d-flex align-items-center justify-content-center" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <span class="font-weight-bold">80%</span>
                                        </div>
                                    </div>
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
    <script src="{{ asset('js/user-management-activities-display.js') }}"></script>
@endpush
