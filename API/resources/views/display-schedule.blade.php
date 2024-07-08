@extends('layout.master')

@section('title', 'Exam Scheduling')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/schedule.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30"><a href="{{ route('schedule.index') }}"
                                class="text-decoration-none dark-purple">Exam Scheduling</a></li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">Jimmy James</li>
                    </ol>
                </nav>
            </div>
        </div>
        {{-- <div class="row mb-4">
            <div class="col-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search . . ." aria-label="Search"
                        aria-describedby="search-icon">
                    <button class="btn btn-outline-secondary" type="button" id="search-icon">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div> --}}
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table class="table table-hover table-striped table-display">
                    <caption>Request Information</caption>
                    <tbody>
                        <tr>
                            <td>First Name</td>
                            <td>Jimmy</td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>James</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>Cambodia</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>12 345 678</td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td>jimmyjames12@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Difficulty</td>
                            <td>Beginner</td>
                        </tr>
                        <tr>
                            <td>Published Date</td>
                            <td>April 2024</td>
                        </tr>
                        <tr>
                            <td>Test Selection</td>
                            <td>Test 2</td>
                        </tr>
                        <tr>
                            <td>Exam Date</td>
                            <td>April 14, 2024 9:00 AM</td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-gp d-flex justify-content-end gap-2">
                    <button type="submit" class="btn">Reject</button>
                    <button type="submit" class="btn btn-dark-purple">Approve</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/schedule.js') }}"></script>
@endpush
