@extends('layout.user_master')

@section('title', 'User Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/suggestion.css') }}">
@endpush

@section('content')

    <div class="pagetitle">
        <h1>Suggestion</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Suggestion</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="title fs-4 text-center fw-bold">Suggestion Box</h3>
                <p class="text text-center mb-4">If you have any suggestion to improve the website please submit.</p>
                <div class="scheduling-container d-flex justify-content-center">

                    <form action="{{ route('suggestion.store') }}" method="POST" class="form-container">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control big" id="subject" name="subject" placeholder="Subject">
                            </div>

                            <div class="form-group">
                                <label for="message" class="form-label message">Message</label>
                                <textarea class="form-control" id="message" name="message" placeholder=" Place Your Suggestion"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
