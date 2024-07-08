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
                        <li class="breadcrumb-item fs-30">
                            <a href="{{ route('suggestions.index') }}" class="text-decoration-none dark-purple">
                                Suggestions
                            </a>
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            Show
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table class="table table-hover table-striped table-display">
                    <caption>Suggestion Information</caption>
                    <tbody>
                        <tr>
                            <td>Full Name</td>
                            <td class="text-capitalize">{{ $suggestion->user->first_name . ' ' . $suggestion->user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td>{{ $suggestion->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Subject</td>
                            <td>{{ $suggestion->subject }}</td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td>{{ $suggestion->message }}</td>
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
