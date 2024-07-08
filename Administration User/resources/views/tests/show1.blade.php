@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        <div class="col-12 text-start dark-purple">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-baseline">
                    <li class="breadcrumb-item fs-30">
                        <a href="{{ route($prefix . '.posters.index') }}" class="text-decoration-none dark-purple">
                            {{ $prefix == 'materials' ? 'Materials' : 'Online Tests' }}
                        </a>
                    </li>
                    <li class="breadcrumb-item fs-20" aria-current="page">
                        <a href="{{ route($prefix . '.posters.show', $poster->id) }}"
                            class="text-decoration-none dark-purple">Posters</a>
                    </li>
                    <li class="breadcrumb-item active fs-20" aria-current="page">
                        {{ $poster->title }}
                    </li>
                    <li class="breadcrumb-item active fs-20" aria-current="page">
                        View {{ $prefix == 'materials' ? 'Material' : 'Online Test' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="text-uppercase dark-purple m-0">ENGLISH {{ $test->type . ' ' . $test->order }}</h4>

                @foreach ($test->testSkills as $testSkill)
                    @php
                        if ($testSkill->skill->name == 'vocabulary') {
                            $color = '#0000FF';
                        } elseif ($testSkill->skill->name == 'grammar') {
                            $color = '#008000';
                        } elseif ($testSkill->skill->name == 'listening') {
                            $color = '#FF0000';
                        } else {
                            $color = '#cce5ff';
                        }
                    @endphp

                    <span class="badge text-capitalize my-2"
                        style="font-size: 18px; background-color: {{ $color }};">
                        {{ $testSkill->skill->name . ($testSkill->duration != null ? ' (' . $testSkill->duration . 'mns)' : '') }}
                    </span>
                    <div class="mb-3">
                        <h5 class="m-0">Instruction</h5>
                        <p class="m-0">{!! $testSkill->instruction !!}</p>
                    </div>

                    @if ($testSkill->audio != 'null')
                        <audio controls class="mb-3">
                            <source src="{{ asset('storage/' . $testSkill->audio) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif

                    @if ($testSkill->questions->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            No questions found for this skill.
                        </div>
                    @endif
                    @foreach ($testSkill->questions as $index => $question)
                        <div class="mb-3">
                            <h5 class="m-0 d-flex align-items-center" style="color: {{ $color }};">
                                <span>Question
                                    {{ $index + 1 . ' (' . $question->points . ' pts)' }}</span>
                                <span class="d-flex gap-2">
                                    <a
                                        href="{{ route($prefix . '.posters.tests.questions.edit', ['poster' => $poster->id, 'test' => $test->id, 'question' => $question->id]) }}">
                                        <i class="bx bx-edit text-primary" style="font-size: 20px; vertical-align: middle;">
                                        </i>
                                    </a>
                                    <form
                                        action="{{ route($prefix . '.posters.tests.questions.destroy', ['poster' => $poster->id, 'test' => $test->id, 'question' => $question->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm d-inline">X</button>
                                    </form>
                                </span>
                            </h5>
                            <div>
                                <p class="m-0">
                                    {{ $question->question_text }}
                                </p>
                                @foreach ($question->options as $option)
                                    {{-- @if ($question->type == 'multiple choice' || $question->type == 'checkboxes') --}}
                                    <div class="form-check">
                                        <input class="form-check-input opacity-100"
                                            type="{{ $question->type == 'multiple choice' ? 'radio' : 'checkbox' }}"
                                            name="question_{{ $question->id }}"
                                            id="question_{{ $question->id }}_option_{{ $option->id }}"
                                            value="{{ $option->id }}" {{ $option->is_correct ? 'checked' : '' }}
                                            disabled />
                                        <label class="form-check-label opacity-100"
                                            for="question_{{ $question->id }}_option_{{ $option->id }}">{{ $option->option_text }}</label>
                                    </div>
                                    {{-- @else
                                        <small class="text-danger">Answer: {{ $option->option_text }}</small>
                                    @endif --}}
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="d-flex justify-content-center gap-2">
                        @if ($testSkill->paginated_questions->onFirstPage())
                            <span
                                class="btn disabled rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                                <i class='bx bx-chevron-left' style="font-size: 25px; color: #0d6efd;"></i>
                            </span>
                        @else
                            <a href="{{ $testSkill->paginated_questions->previousPageUrl() }}"
                                class="btn rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                                <i class='bx bx-chevron-left' style="font-size: 25px; color: #0d6efd;"></i>
                            </a>
                        @endif

                        @if ($testSkill->paginated_questions->hasMorePages())
                            <a href="{{ $testSkill->paginated_questions->nextPageUrl() }}"
                                class="btn rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                                <i class='bx bx-chevron-right' style="font-size: 25px; color: #0d6efd;"></i>
                            </a>
                        @else
                            <span
                                class="btn disabled rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                                <i class='bx bx-chevron-right' style="font-size: 25px; color: #0d6efd;"></i>
                            </span>
                        @endif
                    </div> --}}
                @endforeach

            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12">
                <h4 class="text-uppercase dark-purple m-0">ENGLISH {{ $test->type . ' ' . $test->order }}</h4>

                @php
                    $previousTestSkillId = null;
                    $nextTestSkillId = null;
                    $questionsPerSkillCount = 0;
                @endphp

                @foreach ($paginatedQuestions as $question)
                    @php
                        $testSkill = $question->testSkill;
                    @endphp

                    @if ($loop->first || $previousTestSkillId !== $testSkill->id)
                        @if (!$loop->first)
            </div>
            @endif
            <span class="badge bg-primary text-capitalize my-2"
                style="font-size: 18px;">{{ $testSkill->skill->name }}</span>
            <div class="mb-3">
                <h5 class="m-0">Instruction</h5>
                <p class="m-0">{!! $testSkill->instruction !!}</p>
                @endif

                <div class="mb-3">
                    <h5 class="m-0" style="color: #0d6efd;">Question
                        {{ $loop->index + 1 . ' (' . $question->points . ' pts)' }}</h5>
                    <div>
                        <p class="m-0">
                            {!! str_replace(
                                '{}',
                                '<span style="white-space: nowrap; display: inline-block; width: 2em; border-bottom: 1px solid black;"></span>',
                                $question->question_text,
                            ) !!}
                        </p>
                        @foreach ($question->options as $option)
                            @if ($question->type == 'multiple choice' || $question->type == 'checkboxes')
                                <div class="form-check">
                                    <input class="form-check-input opacity-100"
                                        type="{{ $question->type == 'multiple choice' ? 'radio' : 'checkbox' }}"
                                        name="question_{{ $question->id }}"
                                        id="question_{{ $question->id }}_option_{{ $option->id }}"
                                        value="{{ $option->id }}" {{ $option->is_correct ? 'checked' : '' }} disabled />
                                    <label class="form-check-label opacity-100"
                                        for="question_{{ $question->id }}_option_{{ $option->id }}">{{ $option->option_text }}</label>
                                </div>
                            @else
                                <small class="text-danger">Answer: {{ $option->option_text }}</small>
                            @endif
                        @endforeach
                    </div>
                </div>

                @php
                    $questionsPerSkillCount++;
                    $previousTestSkillId = $testSkill->id;
                    $nextTestSkillId = optional($paginatedQuestions[$loop->index + 1])->testSkill->id ?? null;
                @endphp

                @if ($loop->last || $nextTestSkillId !== $testSkill->id)
                    @if ($questionsPerSkillCount < 5)
            </div>
            <div class="col-12">
                @endif
                @php
                    $questionsPerSkillCount = 0;
                @endphp
                @endif
                @endforeach

                <div class="d-flex justify-content-center gap-2">
                    @if ($paginatedQuestions->onFirstPage())
                        <span class="btn disabled rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                            <i class='bx bx-chevron-left' style="font-size: 25px; color: #0d6efd;"></i>
                        </span>
                    @else
                        <a href="{{ $paginatedQuestions->previousPageUrl() }}"
                            class="btn rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                            <i class='bx bx-chevron-left' style="font-size: 25px; color: #0d6efd;"></i>
                        </a>
                    @endif

                    @if ($paginatedQuestions->hasMorePages())
                        <a href="{{ $paginatedQuestions->nextPageUrl() }}"
                            class="btn rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                            <i class='bx bx-chevron-right' style="font-size: 25px; color: #0d6efd;"></i>
                        </a>
                    @else
                        <span class="btn disabled rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px; border: 1px solid #0d6efd;">
                            <i class='bx bx-chevron-right' style="font-size: 25px; color: #0d6efd;"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/tests/create.js') }}"></script>
@endpush
