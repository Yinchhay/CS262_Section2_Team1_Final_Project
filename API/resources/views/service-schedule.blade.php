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
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search . . ." aria-label="Search"
                        aria-describedby="search-icon">
                    <button class="btn btn-outline-secondary" type="button" id="search-icon">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Request Information</th>
                            <th scope="col">Request Time</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-href="{{ route('schedule.display') }}">
                            <td>Jimmy James has requested an online test for April 14, 2024 at 9:00 AM</td>
                            <td>Apirl 12, 2024 10:30 AM</td>
                            <td>Active</td>
                        </tr>
                        <tr data-href="{{ route('schedule.display') }}">
                            <td>Jimmy James has requested an online test for April 14, 2024 at 9:00 AM</td>
                            <td>Apirl 12, 2024 10:30 AM</td>
                            <td>Active</td>
                        </tr>
                        <tr data-href="{{ route('schedule.display') }}">
                            <td>Jimmy James has requested an online test for April 14, 2024 at 9:00 AM</td>
                            <td>Apirl 12, 2024 10:30 AM</td>
                            <td>Active</td>
                        </tr>
                        <tr data-href="{{ route('schedule.display') }}">
                            <td>Jimmy James has requested an online test for April 14, 2024 at 9:00 AM</td>
                            <td>Apirl 12, 2024 10:30 AM</td>
                            <td>Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/schedule.js') }}"></script>
@endpush
