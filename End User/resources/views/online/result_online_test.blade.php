@extends('layout.user_master')

@section('title', 'Online Test Result')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/result_online_test.css') }}">
@endpush

@section('content')


    <div class="pagetitle">
        <h1>Online Test Result</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('test.index') }}">Online Test</a></li>
                <li class="breadcrumb-item active">Result</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="title fs-4 fw-bold">English Online Test {{ $testSkill->test->order }}</h3>
                <div class="instruction-content d-flex mt-4 ">
                    <div class="col-lg-6 score-content text-center">
                        <h4>Your Score is:</h4>
                        <div class="row d-flex justify-content-center mt-100">

                            <div class="container mt-5">
                                <div class="chart-container">
                                    <canvas id="myDoughnutChart"></canvas>
                                    <div id="chartCenterText" class="chart-center-text"></div>
                                </div>
                            </div>

                            <p class="lead">Correct Answer <br> {{ $correctAnswers }}/{{ $totalQuestions }}</p>
                            <div class="button-group">
                                <a href="{{ route('user.dashboard') }}" class="btn ">Done</a>
                                <a href="{{ route('test.select', $poster->id) }}" class="btn ">Continue</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 download-content">
                        <h4>Your Certificate:</h4>
                        <div class="download-body ">
                            <div class="certificate-poster">
                                <img src="{{ asset('assets/img/certificate.jpg') }}" alt="" id="certImg">
                            </div>

                            <div class="certificate-content">
                                <h1>CERTIFICATE - English Online Test 2024 March </h1>
                                <h4>Beginner (Test 1)</h4>
                                <p>
                                    Result: 90%<br>
                                    Grade: Excellent<br>
                                    Test Taken Date: April 14, 2024
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="answer-content">
                    <h4>Answer Key:</h4>
                    <div class="row ">
                        <div class="col-md-4 text-left">
                            <div class="answer-key d-flex">
                                @foreach ($userAnswers as $answer)
                                    <li class="list-group-item border-0 d-flex">
                                        <span>{{ $loop->iteration }} </span>
                                        <h6 class="text-primary">{{ $answer->question->correct_option }}</h6>
                                        <h6> :
                                            {{-- @foreach ($orders as $order)

                                        @endforeach --}}
                                        </h6>
                                        <h6 class="user-answer">{{ $answer->selectedOption->option_text }}</h6>
                                        <i class="{{ $answer->score > 0 ? 'correct' : 'incorrect' }}">
                                            {{ $answer->score > 0 ? '✔' : '✘' }}
                                        </i>
                                    </li>
                                @endforeach
                            </div>
                        </div>

                        {{-- <div class="row ">
                            <div class="answer-key d-flex">
                                <div class="list-group-item border-0 d-flex">
                                    <span>9. </span>
                                    <h6 class="text-primary">C</h6>
                                    <h6> : </h6>
                                    <h6 class="user-answer">C</h6> <i class="correct">✔</i>
                                </div>

                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const correctAnswers = {{ $correctAnswers }};
            const totalQuestions = {{ $totalQuestions }};
            const percentage = Math.round((correctAnswers / totalQuestions) * 100);

            const ctx = document.getElementById('myDoughnutChart').getContext('2d');

            const data = {
                labels: ['Correct', 'Incorrect'],
                datasets: [{
                    data: [percentage, 100 - percentage],
                    backgroundColor: ['#9B5BDC',
                        '#e0e0e0'
                    ], // Primary color and light gray for remaining
                    hoverBackgroundColor: ['#808080', '#e0e0e0']
                }]
            };

            const options = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 70,
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                plugins: {
                    tooltip: {
                        enabled: false
                    }
                }
            };

            const myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });

            document.getElementById('chartCenterText').innerText = percentage + '%';
        });
    </script>
@endpush
