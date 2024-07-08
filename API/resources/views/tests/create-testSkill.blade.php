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
                        Add {{ $prefix == 'materials' ? 'Material' : 'Online Test' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="row" id="addQuestionForm">
            @include('shared.success-message')

            <div class="col-lg-8 mx-auto question-box">
                <form action="{{ route($prefix . '.posters.tests.store', $poster->id) }}" method="POST" id="questionForm"
                    enctype="multipart/form-data">
                    @csrf

                    <h4 class="text-center mb-2 dark-purple">Add Instruction and Audio</h4>

                    <input type="hidden" name="type" value="{{ $prefix == 'materials' ? 'material' : 'online test' }}">

                    @foreach ($skills as $skill)
                        @php
                            if ($skill->name == 'vocabulary') {
                                $color = '#0000FF';
                            } elseif ($skill->name == 'grammar') {
                                $color = '#008000';
                            } elseif ($skill->name == 'listening') {
                                $color = '#FF0000';
                            } else {
                                $color = '#cce5ff';
                            }
                        @endphp

                        <span class="badge text-capitalize my-2"
                            style="font-size: 18px; background-color: {{ $color }};">{{ $skill->name }}</span>

                        <div class="mb-3">
                            <label for="{{ $skill->name . '-instruction' }}" class="form-label">Instruction</label>
                            <textarea class="form-control" name="{{ $skill->name . '-instruction' }}" id="{{ $skill->name . '-instruction' }}"
                                rows="3">Instruction</textarea>
                        </div>

                        @if ($prefix == 'online-tests')
                            <div class="mb-3">
                                <label for="{{ $skill->name . '-duration' }}" class="form-label">Duration</label>
                                <input type="number" class="form-control" id="{{ $skill->name . '-duration' }}"
                                    name="{{ $skill->name . '-duration' }}" min="0" value="0">
                            </div>
                        @endif

                        @if ($skill->name == 'listening')
                            <div class="mb-3">
                                <label for="audio" class="form-label">Audio Upload</label>
                                <input type="file" class="form-control" id="audioFileInput" name="audio_file"
                                    accept=".mp3,.wav">
                                @error('audio_file')
                                    <span class="d-block text-danger mt-1" style="font-size: 14px;">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    @endforeach

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
