@extends('layout.master')

@section('title', 'Online Tests')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/tests.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30"><a href="{{ route('test.index') }}"
                                class="text-decoration-none dark-purple">Online Tests</a></li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">Add Test</li>
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
        </div>
        <div class="row" id="addPosterForm"
            style="margin: 0; border: 1px solid var(--dark-purple); border-radius: 0 7px 7px; box-shadow: 0 4px 4px 0 rgba(0,0,0,.25);">
            <div class="col-lg-4" style="padding: 16px; border-right: 1px solid var(--dark-purple);">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="difficulty" class="form-label">Difficulty</label>
                        <select name="difficulty" id="difficulty" class="form-control" required>
                            <option value="0">Level</option>
                            <option value="1">Beginner</option>
                            <option value="2">Intermediate</option>
                            <option value="3">Upper Intermediate</option>
                            <option value="4">Advance</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ date('Y') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <select name="month" id="month" class="form-control" required>
                            <option value="0">Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vocabularyInstruction" class="form-label">Vocabulary</label>
                        <textarea class="form-control" id="vocabularyInstruction" name="vocabularyInstruction" rows="3" required>1. Instruction 1</textarea>
                        <input type="number" class="form-control mt-2" name="vocabularyDuration" id="vocabularyDuration" min="10" max="120" value="60">
                    </div>
                    <div class="mb-3">
                        <label for="grammarInstruction" class="form-label">Grammar</label>
                        <textarea class="form-control" id="grammarInstruction" name="grammarInstruction" rows="3" required>1. Instruction 1</textarea>
                        <input type="number" class="form-control mt-2" name="grammarDuration" id="grammarDuration" min="10" max="120" value="60">
                    </div>
                    <div class="mb-3">
                        <label for="listeningInstruction" class="form-label">Listening</label>
                        <textarea class="form-control" id="listeningInstruction" name="listeningInstruction" rows="3" required>1. Instruction 1</textarea>
                        <input type="number" class="form-control mt-2" name="listeningDuration" id="listeningDuration" min="10" max="120" value="60">
                    </div>
                    <div class="btn-gp d-flex justify-content-end gap-2">
                        <button type="submit" class="btn">Cancel</button>
                        <button type="submit" class="btn btn-dark-purple">Add</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 ps-lg-0" style="background-color: rgba(155,91,220,.20);">
                <div class="result" style="padding: 16px;">
                    <div class="poster-result">
                        <div class="poster gap-4">
                            <div class="poster-img">
                                <img src="{{ asset('images/english_online_test_sample_poster.png') }}" alt="poster"
                                    height="285">
                                <span class="l fw-normal" id="l">Level</span>
                                <span class="y fw-bold" id="y">2024</span>
                                <span class="m fw-bold" id="m">Month</span>
                            </div>
                            <div class="poster-desc d-flex flex-column gap-3">
                                <div class="poster-title text-start" style="width: 310px;">
                                    <h3 class="title text-uppercase" style="font-size: 30px;">ENGLISH ONLINE TEST</h3>
                                    <span class="title-desc orange font-weigth-medium text-capitalize"
                                        style="font-size: 25px; line-height: 120%;">
                                        <span class="difficulty l">Level</span>
                                        <span class="year y">2024</span>
                                        <span class="month m">Month</span>
                                    </span>
                                </div>
                                <div class="poster-info">
                                    <div class="publication">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_183_147)">
                                                <path
                                                    d="M18.753 6.99167V17.4417C18.753 18.2333 18.1197 18.9458 17.2488 18.9458H2.36549C1.57383 18.9458 0.861328 18.3125 0.861328 17.4417V6.99167H18.753Z"
                                                    stroke="#9B5BDC" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M18.7529 4.22083V6.99166H0.94043V4.22083C0.94043 3.42916 1.57376 2.71666 2.4446 2.71666H17.3279C18.0404 2.79583 18.7529 3.42916 18.7529 4.22083Z"
                                                    stroke="#9B5BDC" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M6.40325 12.9292H4.66159C4.34492 12.9292 4.10742 12.6917 4.10742 12.375V10.5542C4.10742 10.2375 4.34492 10 4.66159 10H6.48242C6.79909 10 7.03659 10.2375 7.03659 10.5542V12.375C7.03659 12.6917 6.71992 12.9292 6.40325 12.9292Z"
                                                    stroke="#9B5BDC" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M5.53223 3.98333V1.13333" stroke="#9B5BDC" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M14.082 1.13333V3.98333" stroke="#9B5BDC" stroke-width="1.5"
                                                    stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_183_147">
                                                    <rect width="19" height="19" fill="white"
                                                        transform="translate(0.307617 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <span>Publised on: {{ now()->format('F j, Y') }}</span>
                                    </div>
                                    <div class="no-taken">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_183_165)">
                                                <path
                                                    d="M8.43186 11.4443L5.40817 18.743L13.7406 10.8711L10.7178 9.61905L13.7415 2.32036L5.58247 10.0285L8.43186 11.4443Z"
                                                    stroke="#9B5BDC" stroke-width="1.23386" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_183_165">
                                                    <rect width="19" height="19" fill="white"
                                                        transform="translate(0.307617 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <span>Tests Taken: 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="instructions p-5 py-4 d-flex flex-column gap-3">
                            <div class="vocabularyInst">
                                <h5 class="skills-name">Vocabulary (<span id="vocabDur">60</span> minutes)</h5>
                                <p>Instruction:</p>
                                <p id="vocabularyInst">1. Instruction 1</p>
                            </div>
                            <div class="grammarInst">
                                <h5 class="skills-name">Grammar (<span id="grammarDur">60</span> minutes)</h5>
                                <p>Instruction:</p>
                                <p id="grammarInst">1. Instruction 1</p>

                            </div>
                            <div class="listeningInst">
                                <h5 class="skills-name">Listening (<span id="listeningDur">60</span> minutes)</h5>
                                <p>Instruction:</p>
                                <p id="listeningInst">1. Instruction 1</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row collapse" id="addQuestionForm"
            style="margin: 0; border: 1px solid var(--dark-purple); border-radius: 0 7px 7px; box-shadow: 0 4px 4px 0 rgba(0,0,0,.25);">
            <div class="col-lg-4" style="padding: 16px; border-right: 1px solid var(--dark-purple);">
                <form action="" method="POST" enctype="multipart/form-data" id="questionForm">
                    @csrf
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <select name="skills" id="skills" class="form-control" required>
                            <option value="0">Skill</option>
                            <option value="1">Vocabulary</option>
                            <option value="2">Grammar</option>
                            <option value="3">Listening</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qtnType" class="form-label">Question Type</label>
                        <select name="qtnType" id="qtnType" class="form-control" required>
                            <option value="0">Question Type</option>
                            <option value="1">Radio Question</option>
                            <option value="2">Select Box Question</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3" required>Your Question</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3" required>Select one of the provided options.</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="options" class="form-label">Options</label>
                        <textarea class="form-control" id="options" name="options" rows="5" required>
Option 1
Option 2
Option 3</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <select name="answer" id="answer" class="form-control" required>
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
            <div class="col-lg-8 ps-lg-0" style="background-color: rgba(155,91,220,.20);">
                <div class="result" style="padding: 16px;">
                    <div class="qtn-title">
                        <h5 class="text-uppercase dark-purple text-center" style="font-size: 25px;">ENGLISH ONLINE TESTS -
                            <span class="skill-name text-capitalize">Vocabulary</span></h5>
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
    <script src="{{ asset('js/add-tests.js') }}"></script>
@endpush
