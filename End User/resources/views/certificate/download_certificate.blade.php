@extends('layout.user_master')

@section('title', 'Cerificate Download')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/download_certificate.css') }}">
@endpush

@section('content')


    <div class="pagetitle">
        <h1>Certificate</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('certificate.index') }}">Certificate</a></li>
                <li class="breadcrumb-item active"> Download</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12 d-flex">

                <div class="certificate-poster">
                    {{-- <img src="{{ asset('assets/img/'. $certificate->image) }}" alt=""> --}}
                    <img src="{{ asset('assets/img/certificate.jpg') }}" alt=""  id="certImg">
                </div>

                <div class="certificate-content">
                    <h1>CERTIFICATE</h1>
                    <h1>{{ ucwords($certificate->title) . ' ' . ucwords($certificate->test->type) }}</h1>
                    <h1>{{ ucwords($certificate->test->poster->year) . ' ' . ucwords($certificate->test->poster->month) }}</h1>
                    <h4>{{ ucwords($certificate->test->poster->level . ' (Test ' . $certificate->test->order . ')') }}</h4>

                    <p>
                        Result: 90%<br>
                        Grade: Excellent<br>
                        Test Taken Date: {{ $certificate->issue_date }}
                    </p>

                    <a class="btn btn-purple"
                        onclick="
                                // download
                                var certImg = document.getElementById('certImg');
                                var link = document.createElement('a');
                                link.href = certImg.src;
                                link.download = 'certificate.jpg';
                                link.click();
                                "><i
                            class="bi bi-download"></i> Download</a>
                </div>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <h1 class="other-title">Other Achievement</h1>
                <div class="other-achievement d-flex">

                    @foreach ($otherCertificates as $otherCertificate)
                        <div class="small-poster">
                            <div class="poster-img">
                                {{-- <img src="{{asset('assets/img/' . $otherCertificate->image)}}" alt=""> --}}
                                <img src="{{ asset('assets/img/certificate.jpg') }}" alt="">
                            </div>
                            <div class="poster-content">
                                <h1>CERTIFICATE</h1>
                                <h1>{{ $otherCertificate->title . ' ' . ucwords($certificate->test->type) . ' ' . ucwords($certificate->test->poster->year) . ' ' . ucwords($certificate->test->poster->month) }}
                                </h1>
                                <h4>{{ ucwords($otherCertificate->test->poster->level . ' (Test ' . $certificate->test->order . ')') }}
                                </h4>

                                <p>Test Taken Date: {{ $otherCertificate->issue_date }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
