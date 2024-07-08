    @extends('layout.user_master')

    @section('title', 'Online Test Form')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/form_online_test.css') }}">
    @endpush

    @section('content')
        <div class="pagetitle">
            <h1>Online Test</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('test.index') }}">Online Test</a></li>
                    <li class="breadcrumb-item active">{{ ucwords($testSkill->test->poster->level) }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <!-- Left side columns -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-content">
                        <h3>English Online {{ $testSkill->test->order }} - {{ ucwords($testSkill->skill->name) }}</h3>
                        <div class="instruction-content">
                            <p>Instruction:</p>
                            <p>{{ $testSkill->instruction }}</p>
                            @if ($testSkill->audio != 'null')
                                <audio controls class="mb-3">
                                    <source src="{{ url('/img?file_path=' . $testSkill->audio ) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif
                            <hr>
                        </div>
                        <div class="time-counter d-flex justify-content-end">
                            <p>Time Remaining: <span id="time">Calculating..</span><i
                                    class="bi bi-hourglass-split"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form class="question-form" method="POST" action="{{ route('test.store', $testSkill->id) }}"
                        id="testForm">
                        @csrf
                        @foreach ($questions as $index => $question)
                            <label class="question-title text-primary text-bold fw-bold fs-5 mt-2 mb-2">Question
                                {{ $index + 1 . ' (' . $question->points . ' pts)' }}</label>
                            <p class="question-problem">
                                {!! str_replace(
                                    '{}',
                                    '<span style="white-space: nowrap; display: inline-block; width: 2em; border-bottom: 1px solid black;"></span>',
                                    $question->question_text,
                                ) !!}
                            </p>
                            @if ($question->type == 'multiple choice' || $question->type == 'checkboxes')
                                @foreach ($question->questionOption as $option)
                                    <div class="form-check">
                                        <input class="form-check-input opacity-100"
                                            type="{{ $question->type == 'multiple choice' ? 'radio' : 'checkbox' }}"
                                            name="questions[{{ $question->id }}][selected_option_id]"
                                            value="{{ $option->id }}"
                                            id="question_{{ $question->id }}_option_{{ $option->id }}" />
                                        <label class="form-check-label opacity-100"
                                            for="question_{{ $question->id }}_option_{{ $option->id }}">{{ $option->order }}.
                                            {{ $option->option_text }}</label>
                                    </div>
                                @endforeach
                            @endif
                            <input type="hidden" name="questions[{{ $question->id }}][score]"
                                value="{{ $question->points }}">
                        @endforeach

                        {!! $questionPage->links('pagination::bootstrap-5') !!}

                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    @endsection

    @push('scripts')
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script>
            function startTimer(duration, display) {
                var startTime = localStorage.getItem('startTime');
                var currentTime = Date.now();
                var timer;

                if (startTime && (currentTime - startTime < duration * 1000)) {
                    // Timer is still running, calculate remaining time
                    var remainingTime = Math.ceil((duration * 1000 - (currentTime - startTime)) / 1000);
                    runTimer(remainingTime);
                } else {
                    // Timer not started or expired, start a new one
                    localStorage.setItem('startTime', currentTime);
                    runTimer(duration);
                }

                function runTimer(timerDuration) {
                    timer = timerDuration;
                    var minutes, seconds;

                    var t = setInterval(function() {
                        minutes = parseInt(timer / 60, 10);
                        seconds = parseInt(timer % 60, 10);
                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        display.textContent = minutes + ":" + seconds;

                        if (--timer < 0) {
                            clearInterval(t);
                            localStorage.removeItem('startTime'); // Remove the start time when timer expires
                            document.forms.exam.submit(); // Submit the form when timer expires
                        }
                    }, 1000);
                }
            }

            window.onload = function() {
                var duration = {{ $testSkill->duration }};
                var examTime = duration * 60;
                var display = document.querySelector('#time');
                startTimer(examTime, display);
            };
        </script>
    @endpush
