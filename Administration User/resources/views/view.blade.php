@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/materials/create.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30"><a href="{{ route('materials.index') }}"
                                class="text-decoration-none dark-purple">Materials</a></li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">Add Material</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row nav-links">
            <div class="col-auto py-0 pe-0">
                <a href="#addPosterForm" class="nav-link active" id="addPosterLink" style="padding: 10px;">Add Poster</a>
            </div>
            <div class="col-auto p-0">
                <a href="#addQuestionForm" class="nav-link" id="addQuestionLink" style="padding: 10px;">Add Questions</a>
            </div>
            <div class="col-auto ms-auto">
                <form action="{{ route('materials.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="poster" id="poster">
                    <input type="hidden" name="questions" id="questions">
                    <button type="submit" class="btn btn-outline-success">Save</button>
                </form>
            </div>
        </div>

        <div class="row form-container" id="addPosterForm">
            <div class="col-lg-5 form-box">
                <form enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="level" class="form-label">Difficulty</label>
                        <select name="level" id="level" class="form-control">
                            @foreach ($levels as $level)
                                <option value="{{ $level }}">{{ ucwords($level) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ date('Y') }}"
                            min="2022" max="2072">
                    </div>

                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <select name="month" id="month" class="form-control">
                            @foreach ($months as $month)
                                <option value="{{ $month }}">{{ ucwords($month) }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($skills as $skill)
                        <div class="mb-3">
                            <label for="{{ $skill->name . 'Instruction' }}"
                                class="form-label">{{ ucwords($skill->name) }}</label>
                            <textarea class="form-control" name="{{ $skill->name . 'Instruction' }}" id="{{ $skill->name . 'Instruction' }}"
                                rows="3">1. Instruction 1</textarea>
                        </div>
                    @endforeach
                </form>
            </div>

            <div class="col-lg-7 ps-lg-0">
                <div class="result" style="padding: 16px;">
                    <div class="poster-result">
                        <div class="poster gap-4">
                            <div class="poster-img">
                                <img src="{{ asset('images/Material_Poster_Sample.png') }}" alt="poster" height="285">
                                <span class="l font-weight-regular" id="l">Level</span>
                                <span class="y font-weight-bold" id="y">2024</span>
                                <span class="m font-weight-bold" id="m">Month</span>
                            </div>
                            <div class="poster-desc d-flex flex-column gap-3">
                                <div class="poster-title text-start" style="width: 300px;">
                                    <h3 class="title text-uppercase" style="font-size: 30px;">ENGLISH MATERIALS</h3>
                                    <span class="title-desc orange font-weigth-medium text-capitalize"
                                        style="font-size: 25px; line-height: 120%;">
                                        <span class="difficulty l">Level</span>
                                        <span class="year y">2024</span>
                                        <span class="month m">Month</span>
                                    </span>
                                </div>
                                <div class="poster-info">
                                    <div class="publication d-flex align-items-center gap-1">
                                        <i class='bx bx-calendar' style="font-size: 20px; color: var(--purple); text-align: center;"></i>
                                        <span>Publised on: {{ now()->format('F j, Y') }}</span>
                                    </div>
                                    <div class="no-taken d-flex align-items-center gap-1">
                                        <i class='bx bxs-zap' style="font-size: 20px; color: var(--purple); text-align: center; transform: rotateY(45deg)"></i>
                                        <span>Materials Taken: 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="instructions p-5 py-4 d-flex flex-column gap-3">
                            @foreach ($skills as $skill)
                                <div class="{{ $skill->name . 'Inst' }}">
                                    <h5 class="skills-name">{{ ucwords($skill->name) }}</h5>
                                    <p>Instruction:</p>
                                    <p id="{{ $skill->name . 'Inst' }}">1. Instruction 1</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-container collapse" id="addQuestionForm">
            <div class="col-lg-5 form-box">
                <form enctype="multipart/form-data" id="questionForm">
                    @csrf
                    <input type="hidden" name="type" value="question">
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <select name="skills" id="skills" class="form-control">
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}">{{ ucwords($skill->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="instruction" class="form-label">Instruction</label>
                        <textarea class="form-control" name="instruction" id="instruction" rows="3"></textarea>
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
                        <label for="point" class="form-label">Point</label>
                        <input type="number" class="form-control" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3">Your Question</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3">Select one of the provided options.</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="options" class="form-label">Options</label>
                        <textarea class="form-control" id="options" name="options" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <select name="answer" id="answer" class="form-control">
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>
                    <div class="btn-gp d-flex justify-content-end gap-2">
                        <button type="submit" class="btn">Cancel</button>
                        <button type="submit" class="btn btn-dark-purple">Add</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 ps-lg-0" style="background-color: rgba(155,91,220,.20);">
                <div class="result" style="padding: 16px;">
                    <div class="qtn-title">
                        <h5 class="text-uppercase dark-purple text-center" style="font-size: 25px;">ENGLISH MATERIALS -
                            <span class="skill-name text-capitalize">Vocabulary</span>
                        </h5>
                    </div>
                    <div class="qtns-result p-5 py-3 d-flex flex-column gap-3">
                        <div class="qtn-result flex-grow-1">
                            <h5 class="qtn-number m-0 fs-20 text-primary">Question 1</h5>
                            <div class="qtn-desc">
                                <p class="qtn">Your Question</p>
                                <p class="desc fs-14">Select one of the provided options.</p>
                            </div>
                            <div class="options py-1">
                                <div class="option d-flex align-items-center gap-2">
                                    <input type="radio" name="option" id="option1" value="1">
                                    <label for="option1">A. Option 1</label>
                                </div>
                                <div class="option d-flex align-items-center gap-2">
                                    <input type="radio" name="option" id="option2" value="2">
                                    <label for="option2">B. Option 2</label>
                                </div>
                                <div class="option d-flex align-items-center gap-2">
                                    <input type="radio" name="option" id="option3" value="3">
                                    <label for="option3">C. Option 3</label>
                                </div>
                            </div>
                            <div class="answer">
                                <p class="fs-14" style="color: red;">Answer: <span class="ans">Option 1</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/add-materials.js') }}"></script>
@endpush
