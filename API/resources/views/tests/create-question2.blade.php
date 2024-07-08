@extends('layout.master')

@section('title', $prefix == 'materials' ? 'Materials' : 'Online Tests')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@section('content')
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
                        Add Question
                    </li>
                </ol>
            </nav>
        </div>

        <div class="row" id="addQuestionForm">
            <div class="col-lg-8 mx-auto question-box">
                <form action="{{ route($prefix . '.posters.tests.store', $poster->id) }}" method="POST" id="questionForm">
                    @csrf

                    <input type="hidden" name="type" value="{{ $prefix == 'materials' ? 'material' : 'online test' }}">

                    <h4 class="text-center mb-2 dark-purple">Add Question</h4>

                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <select name="skill_id" id="skills" class="form-control">
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}">{{ ucwords($skill->name) }}</option>
                            @endforeach
                        </select>

                        <div id="skillNames" data-skills='@json($skills->pluck('name'))'></div>
                    </div>

                    <div class="mb-3">
                        <label for="instruction" class="form-label">Instruction</label>
                        <textarea class="form-control" name="instruction" id="instruction" rows="3">Instruction</textarea>
                    </div>

                    <div class="mb-3" id="audioSection" style="display: none;">
                        <label for="audio" class="form-label">Audio Upload</label>
                        <input type="file" class="form-control" id="audioFileInput" name="audio_file" accept=".mp3">
                    </div>

                    <div class="mb-3">
                        <label for="qtnType" class="form-label">Question Type</label>
                        <select name="qtnType" id="qtnType" class="form-control">
                            @foreach ($questionTypes as $questionType)
                                <option value="{{ $questionType }}">{{ ucwords($questionType) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3">Your Question</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="point" class="form-label">Point</label>
                        <input type="number" name="point" id="point" class="form-control" min="0"
                            value="0">
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="desc" name="desc" rows="2">Description</textarea>
                    </div>

                    <div class="mb-3" id="optionsSection">
                        <label for="options" class="form-label">Options</label>
                        <div id="optionsContainer">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control option-input" name="option" value="Option 1">
                                <button type="button" class="btn btn-danger remove-option">X</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" id="addOption">Add Option</button>
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <div id="answerContainer">
                            <div class="form-check">
                                <input id="option1" type="radio" class="form-check-input answer-option"
                                    name="answer">
                                <label for="option1" class="form-check-label">Option 1</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary btn-sm" id="addQuestionBtn">Add Question</button>
                    </div>

                    <div class="btn-gp d-flex justify-content-end gap-2">
                        <button type="reset" class="btn">Cancel</button>
                        <button type="submit" class="btn btn-dark-purple">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/tests/create.js') }}"></script>
@endpush
