@extends('layout.user_master')

@section('title', 'Material')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/main_material.css') }}">
@endpush

@section('content')

    <div class="pagetitle">
        <h1>Material</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Material</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-10 ">

                <div class="material-container">
                    <div class="search-bar">
                        <form class="search-input" action="{{ route('material.index') }}" method="get">
                            <input type="text" name="search" placeholder="Search...">
                        </form>


                        {{-- <div class="dropdown">
                            <select class="btn btn-outline-dark dropdown-toggle" name="level" class="form-select"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <option value="">Most Taken</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>


                        <div class="dropdown">
                            <select class="btn btn-outline-dark dropdown-toggle" name="level" class="form-select"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <option value="">Year</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div> --}}


                    </div>
                </div>

            </div>
        </div>

    </section>

    <section class="section">
        <div class="row">
            <div class=" col-lg-12 ">
                @if ($posters->count() == 0)
                    <div class="alert alert-info">
                        No materials found.
                    </div>
                @else
                    @foreach ($levels as $level)
                        @php
                            $levelPosters = $posters->filter(function ($poster) use ($level) {
                                return $poster->level === $level;
                            });
                        @endphp

                        @if ($levelPosters->count() > 0)
                            <div class="content-container">
                                <div class="row">
                                    <h1>{{ ucwords($level) }}</h1>
                                    <div class="side-scroll col-lg-4 d-flex">
                                        @foreach ($levelPosters as $poster)
                                            <div class="material-body">
                                                <a href="{{ route('material.select', $poster->id) }}">
                                                    <div class="material-img">
                                                        <img src="{{ url('/img?file_path=' . $poster->image ) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="material-text">
                                                        {{ $poster->title }}
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/materials.js') }}"></script>
@endpush
