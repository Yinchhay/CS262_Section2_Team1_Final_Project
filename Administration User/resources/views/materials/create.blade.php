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

        {{-- <div class="modal fade" id="choosePosterModal" tabindex="-1" aria-labelledby="choosePosterModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="choosePosterModalLabel">Choose Option</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-primary w-100 mb-2" id="createNewPosterBtn">Create New Poster</button>
                        <button class="btn btn-secondary w-100" id="chooseExistingPosterBtn">Add to Existing Poster</button>
                    </div>
                </div>
            </div>
        </div> --}}

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
            {{-- <div class="col-auto py-0 pe-0">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#choosePosterModal">Add New Material</button>
            </div> --}}
        </div>

        @include('materials.poster-create')

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
        {{-- <div class="row collapse" id="addQuestionForm"
            style="margin: 0; border: 1px solid var(--dark-purple); border-radius: 0 7px 7px; box-shadow: 0 4px 4px 0 rgba(0,0,0,.25);">
            <div class="col-lg-5" style="padding: 16px; border-right: 1px solid var(--dark-purple);">
                <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" id="questionForm">
                    @csrf
                    <input type="hidden" name="type" value="question">
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <select name="skills" id="skills" class="form-control">
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->name }}">{{ ucwords($skill->name) }}</option>
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
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
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
                        <button type="button" class="btn" id="cancel">Cancel</button>
                        <button type="button" class="btn btn-dark-purple" id="addQuestion">Add</button>
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
                    <div class="qtns-result p-5 py-3 d-flex flex-column gap-3" id="questionsResult">
                        <!-- Questions will be appended here dynamically -->
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/add-materials.js') }}"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('questionForm');
            const questionsResult = document.getElementById('questionsResult');
            let questions = [];

            document.getElementById('addQuestion').addEventListener('click', function() {
                const formData = new FormData(form);
                const questionData = {
                    skills: formData.get('skills'),
                    instruction: formData.get('instruction'),
                    qtnType: formData.get('qtnType'),
                    question: formData.get('question'),
                    desc: formData.get('desc'),
                    options: formData.get('options').split('\n'),
                    answer: formData.get('answer')
                };
                questions.push(questionData);
                displayQuestions();
            });

            function displayQuestions() {
                questionsResult.innerHTML = '';
                questions.forEach((question, index) => {
                    const questionElement = document.createElement('div');
                    questionElement.classList.add('qtn-result', 'flex-grow-1');
                    questionElement.innerHTML = `
                    <h5 class="qtn-number m-0 fs-20 text-primary">Question ${index + 1}</h5>
                    <div class="qtn-desc">
                        <p class="qtn">${question.question}</p>
                        <p class="desc fs-14">${question.desc}</p>
                    </div>
                    <div class="options py-1">
                        ${question.options.map((option, i) => `<div class="option d-flex align-items-center gap-2">
                                                                    <input type="radio" name="option${index}" id="option${index}${i}" value="${i + 1}">
                                                                    <label for="option${index}${i}">${String.fromCharCode(65 + i)}. ${option}</label>
                                                                </div>`).join('')}
                    </div>
                    <div class="answer">
                        <p class="fs-14" style="color: red;">Answer: <span class="ans">${question.options[question.answer - 1]}</span></p>
                    </div>
                    <button class="edit-question btn btn-sm btn-primary" data-index="${index}">Edit</button>
                    <button class="delete-question btn btn-sm btn-danger" data-index="${index}">Delete</button>
                    `;
                    questionsResult.appendChild(questionElement);
                });

                document.querySelectorAll('.edit-question').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        editQuestion(index);
                    });
                });

                document.querySelectorAll('.delete-question').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        deleteQuestion(index);
                    });
                });
            }

            function editQuestion(index) {
                const question = questions[index];
                document.getElementById('skills').value = question.skills;
                document.getElementById('instruction').value = question.instruction;
                document.getElementById('qtnType').value = question.qtnType;
                document.getElementById('question').value = question.question;
                document.getElementById('desc').value = question.desc;
                document.getElementById('options').value = question.options.join('\n');
                document.getElementById('answer').value = question.answer;
                questions.splice(index, 1);
                displayQuestions();
            }

            function deleteQuestion(index) {
                questions.splice(index, 1);
                displayQuestions();
            }

            document.getElementById('cancel').addEventListener('click', function() {
                form.reset();
            });
        });
    </script> --}}
@endpush
