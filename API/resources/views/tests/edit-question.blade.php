@extends('layout.master')

@section('title', $prefix == 'materials' ? 'Materials' : 'Online Tests')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@section('content')
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

    <div class="container-fluid poppins">
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
                        Edit Question
                    </li>
                </ol>
            </nav>
        </div>

        <div class="row" id="addQuestionForm">
            <div class="col-lg-8 mx-auto question-box">
                <form
                    action="{{ route('materials.posters.tests.questions.update', [
                        'poster' => $poster,
                        'test' => $test,
                        'question' => $question,
                    ]) }}"
                    method="POST" id="questionForm" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <h4 class="text-center mb-2 dark-purple">Edit Question</h4>

                    <input type="hidden" name="type" value="{{ $prefix == 'materials' ? 'material' : 'online test' }}">
                    {{-- <input type="hidden" name="testSkills" id="testSkills"> --}}

                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <select name="skill_id" id="skills" class="form-control">
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}"
                                    @php
if ($skill->id == $question->testSkill->skill->id) {
                                            echo 'selected';
                                        } @endphp>
                                    {{ ucwords($skill->name) }}</option>
                            @endforeach
                        </select>

                        <div id="skillNames" data-skills='@json($skills->pluck('name'))'></div>
                    </div>

                    <div class="mb-3">
                        <label for="qtnType" class="form-label">Question Type</label>
                        <select name="qtnType" id="qtnType" class="form-control">
                            @foreach ($questionTypes as $questionType)
                                <option value="{{ $questionType }}"
                                    @php
if ($questionType == $question->type) {
                                            echo 'selected';
                                        } @endphp>
                                    {{ ucwords($questionType) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3">{{ $question->question_text }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="point" class="form-label">Point</label>
                        <input type="number" name="point" id="point" class="form-control" min="0"
                            value="{{ $question->points }}">
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="desc" name="desc" rows="2">{{ $question->description }}</textarea>
                    </div>

                    <div class="mb-3" id="optionsSection">
                        <div>
                            <label for="options" class="form-label">Options</label>
                            @foreach ($question->options as $option)
                                <div class="optionDiv">
                                    <label for="option1">Option {{ $option->order }}</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control option-input" name="option[]"
                                            value="{{ $option->option_text }}" id="option{{ $option->order }}">
                                        <button type="button" class="btn btn-danger remove-option">X</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" id="addOption">Add Option</button>
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <div id="answerContainer">
                            @foreach ($question->options as $option)
                                <div class="form-check answerOptionDiv">
                                    <input id="asnwerOption{{ $option->order }}" type="checkbox"
                                        class="form-check-input answer-option" name="answer[]"
                                        value="{{ $option->order }}" @if ($option->is_correct) checked @endif>
                                    <label for="asnwerOption{{ $option->order }}" class="form-check-label">Option
                                        {{ $option->order }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <button type="button" class="btn btn-secondary btn-sm" id="addQuestionBtn">Add Question</button>
                    </div> --}}

                    <div class="btn-gp d-flex justify-content-end gap-2">
                        <button type="button" class="btn">Cancel</button>
                        <button type="submit" class="btn btn-dark-purple">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/tests/createQuestion.js') }}"></script>
@endpush
