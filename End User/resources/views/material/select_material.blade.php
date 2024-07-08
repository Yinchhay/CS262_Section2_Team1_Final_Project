@extends('layout.user_master')

@section('title', 'Select Material')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select_material.css') }}">
@endpush

@section('content')

    <div class="pagetitle">
        <h1>Material</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('material.index') }}">Material</a></li>
                <li class="breadcrumb-item active">{{ ucwords($poster->level) }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <img class="poster" src="{{ asset('assets/img/english_material_image.png') }}">
                <div class="material-content">
                    <h2>{{ ucwords($poster->title) }}</h2>
                    <div class="small-text">
                        <div class="line d-flex">
                            <i class="bi bi-calendar-event"></i>
                            <p>Published on: {{ $poster->publish_date }}</p>
                        </div>
                        {{-- <div class="line d-flex">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <p>Material taken: {{ $poster->taken }}</p>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">

            @foreach ($poster->tests as $test)
                <div class="col-lg-12 card">
                    <h2>English Material {{ $test->order }}</h2>
                    <div class="card-body d-flex">
                        @foreach ($test->testSkills as $testSkill)
                            @php
                                $skillName = strtolower($testSkill->skill->name);
                            @endphp
                            <div
                                class="performance-card border-{{ $skillName == 'vocabulary' ? 'primary' : ($skillName == 'grammar' ? 'success' : 'danger') }}">

                                @if ($skillName == 'vocabulary')
                                    <i class="bi bi-book"></i>
                                @elseif($skillName == 'grammar')
                                    <i class="bi bi-journal-check"></i>
                                @else
                                    <i class="bi bi-headphones"></i>
                                @endif

                                <h5>{{ ucfirst($skillName) }}</h5>
                                <p>0%</p>
                                <a href="{{ route('material.testSkill.form', ['testSkill' => $testSkill->id]) }}"
                                    class="btn btn-{{ $skillName == 'vocabulary' ? 'primary' : ($skillName == 'grammar' ? 'success' : 'danger') }}">Take
                                    Material</a>
                            </div>
                        @endforeach

                    </div>



                    <div class="container ">
                        <div class="progress-container">
                            <span class="font-weight-bold" style="color: #4b0082;">Full Material</span>
                            <div class="progress" style="width: 80%; height: 25px; border-radius: 15px; margin: 0 10px; ">
                                <div class="progress-bar progress-bar-custom" role="progressbar"
                                    style="width: 80%; color: white; background-color: #9B5BDC;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100">80%</div>
                            </div>
                            {{-- <a class="start-button" href="{{ route('material.test.form', $test->id) }}">
                                <i class="bi bi-lightning-fill"></i>
                                Start
                            </a> --}}
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </section>


@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
