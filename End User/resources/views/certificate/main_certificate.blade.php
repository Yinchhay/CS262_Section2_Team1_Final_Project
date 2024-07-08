@extends('layout.user_master')

@section('title', 'Certificate')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/main_certificate.css') }}">
@endpush

@section('content')



    <div class="pagetitle">
        <h1>Certificate</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Certificate</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12 ">

                <div class="certificate-container">
                    <div class="search-bar">
                        <form class="search-input" action="{{ route('certificate.index') }}" method="get">
                            <input type="text" name="search" placeholder="Search...">
                        </form>
                    </div>

                    <table class="table table-striped table-borderless">
                        <tbody>
                            @foreach ($certificates as $certificate)
                                <tr>
                                    <td>{{ ucwords($certificate->title) . ' (' . ucwords($certificate->test->poster->level) . ')  ' . ucwords($certificate->test->poster->year) . ' (' . ucwords($certificate->test->poster->month) . ') Test ' . $certificate->test->order }}
                                    </td>
                                    <td class="text-right"><a href="{{ route('certificate.download', $certificate->id) }}"
                                            class="btn ">Get Certificate</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



@endsection

@push('scripts')
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
@endpush
