@extends('layout.user_master')

@section('title', 'Online Test')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/main_online_test.css') }}">
@endpush

@section('content')


    <div class="pagetitle">
        <h1>Online Test</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Online Test</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12 ">

                <div class="material-container">
                    <div class="search-bar">
                        <form class="search-input" action="{{ route('test.index') }}" method="get">
                            <input type="text" name="search" placeholder="Search...">
                        </form>


                        {{-- <button class="btn btn-purple">Recently Added</button> --}}

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12 ">

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
                                                <a href="{{ route('test.select', $poster->id) }}">
                                                    <div class="material-img">
                                                        <img src="{{ url('/img?file_path=' . $poster->image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="material-text">
                                                        {{ $poster->title }} <br>
                                                        {{ ucfirst($poster->level) }} {{ $poster->year }}
                                                        {{ ucfirst($poster->month) }}
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
        </div>


        </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
