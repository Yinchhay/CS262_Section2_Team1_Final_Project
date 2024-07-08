@extends('layout.master')

@section('title', $prefix == 'materials' ? 'Materials' : 'Online Tests')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        @if (session('error'))
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

        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30"><a href="{{ route($prefix . '.posters.index') }}"
                                class="text-decoration-none dark-purple">{{ $prefix == 'materials' ? 'Materials' : 'Online Tests' }}</a>
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            {{ $editing ?? false ? 'Edit' : 'Add' }} Poster
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        @if ($editing ?? false)
            <div class="row form-container" id="addPosterForm">
                <div class="col-lg-5 form-box">
                    <form action="{{ route($prefix . '.posters.update', $poster->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @if (session('error'))
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle error-icon"></i>
                                <label>{{ $error }}</label>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="level" class="form-label">Difficulty</label>
                            <select name="level" id="level" class="form-control">
                                @foreach ($levels as $level)
                                    <option value="{{ $level }}"
                                        {{ old('level', $poster->level ?? '') == $level ? 'selected' : '' }}>
                                        {{ ucwords($level) }}</option>
                                @endforeach
                            </select>
                            @error('level')
                                <span class="d-block mt-1 text-danger" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year"
                                value="{{ old('year', $poster->year ?? date('Y')) }}" min="2022" max="2072">
                            @error('year')
                                <span class="d-block mt-1 text-danger" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="month" class="form-label">Month</label>
                            <select name="month" id="month" class="form-control">
                                @foreach ($months as $month)
                                    <option value="{{ $month }}"
                                        {{ old('month', $poster->month ?? '') == $month ? 'selected' : '' }}>
                                        {{ ucwords($month) }}</option>
                                @endforeach
                            </select>
                            @error('month')
                                <span class="d-block mt-1 text-danger" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="reset" class="btn btn-md">Cancel</button>
                            <button type="submit" class="btn btn-dark-purple btn-md">Update</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-7 poster-result">
                    <div class="poster-img text-capitalize">
                        <img src="{{ asset('images/' . ($prefix == 'materials' ? 'Material_Poster_Sample.png' : 'Online_Test_Poster_Sample.png')) }}"
                            alt="poster" height="285">
                        <span class="l fw-normal" id="l">{{ $poster->level }}</span>
                        <span class="y fw-bold" id="y">{{ $poster->year }}</span>
                        <span class="m fw-bold" id="m">{{ $poster->month }}</span>
                    </div>

                    <div class="poster-desc d-flex flex-column gap-3">
                        <div class="poster-title text-start">
                            <h3 class="title text-uppercase">ENGLISH
                                {{ $prefix == 'materials' ? 'MATERIALS' : 'ONLINE TESTS' }}</h3>
                            <span class="title-desc fw-medium text-capitalize">
                                <span class="difficulty l">{{ $poster->level }}</span>
                                <span class="year y">{{ $poster->year }}</span>
                                <span class="month m">{{ $poster->month }}</span>
                            </span>
                        </div>

                        <div class="poster-info">
                            <div class="publication d-flex align-items-center gap-1">
                                <i class='bx bx-calendar'
                                    style="font-size: 20px; color: var(--purple); text-align: center;"></i>
                                <span>Publised on: {{ date('F j, Y', strtotime($poster->publish_date)) }}</span>
                            </div>
                            <div class="no-taken d-flex align-items-center gap-1">
                                <i class='bx bxs-zap'
                                    style="font-size: 20px; color: var(--purple); text-align: center; transform: rotateY(45deg)"></i>
                                <span>Materials Taken: {{ $poster->taken }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row form-container" id="addPosterForm">
                <div class="col-lg-5 form-box">
                    <form action="{{ route($prefix . '.posters.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="level" class="form-label">Difficulty</label>
                            <select name="level" id="level" class="form-control">
                                @foreach ($levels as $level)
                                    <option value="{{ $level }}">{{ ucwords($level) }}</option>
                                @endforeach
                            </select>
                            @error('level')
                                <span class="d-block mt-1 text-danger" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year"
                                value="{{ date('Y') }}" min="2022" max="2072">
                            @error('year')
                                <span class="d-block mt-1 text-danger" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="month" class="form-label">Month</label>
                            <select name="month" id="month" class="form-control">
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ ucwords($month) }}</option>
                                @endforeach
                            </select>
                            @error('month')
                                <span class="d-block mt-1 text-danger" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="reset" class="btn btn-md">Cancel</button>
                            <button type="submit" class="btn btn-dark-purple btn-md">Add</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-7 poster-result">
                    <div class="poster-img">
                        <img src="{{ asset('images/' . ($prefix == 'materials' ? 'Material_Poster_Sample.png' : 'Online_Test_Poster_Sample.png')) }}"
                            alt="poster" height="285">
                        <span class="l fw-normal" id="l">Level</span>
                        <span class="y fw-bold" id="y">2024</span>
                        <span class="m fw-bold" id="m">Month</span>
                    </div>

                    <div class="poster-desc d-flex flex-column gap-3">
                        <div class="poster-title text-start">
                            <h3 class="title text-uppercase">ENGLISH
                                {{ $prefix == 'materials' ? 'MATERIALS' : 'ONLINE TESTS' }}</h3>
                            <span class="title-desc fw-medium text-capitalize">
                                <span class="difficulty l">Level</span>
                                <span class="year y">2024</span>
                                <span class="month m">Month</span>
                            </span>
                        </div>

                        <div class="poster-info">
                            <div class="publication d-flex align-items-center gap-1">
                                <i class='bx bx-calendar'
                                    style="font-size: 20px; color: var(--purple); text-align: center;"></i>
                                <span>Publised on: {{ now()->format('F j, Y') }}</span>
                            </div>
                            <div class="no-taken d-flex align-items-center gap-1">
                                <i class='bx bxs-zap'
                                    style="font-size: 20px; color: var(--purple); text-align: center; transform: rotateY(45deg)"></i>
                                <span>Materials Taken: 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/posters/create.js') }}"></script>
@endpush
