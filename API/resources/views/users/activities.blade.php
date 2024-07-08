@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30">
                            <a href="{{ route('users.index') }}" class="text-decoration-none dark-purple">
                                User Management
                            </a>
                        </li>
                        <li class="breadcrumb-item active fs-20 text-capitalize" aria-current="page">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            Activities
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-2 mb-3">
            <div class="col-4">
                <form action="" method="GET">
                    <div class="input-group">
                        <input value="{{ request('search', '') }}" name="search" type="text" class="form-control"
                            placeholder="Search . . ." aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if ($categorizedPosters['materials']->count() == 0 && $categorizedPosters['online tests']->count() == 0)
            <div class="alert alert-info">No materials and online tests taken.</div>
        @endif

        @if ($categorizedPosters['materials']->count() > 0)
            <div class="row mt-3">
                <div class="col-12 test-type">
                    <span class="fw-medium">Materials <span class="fw-normal fs-20"></span></span>
                </div>
                <div class="col-12">
                    <div class="poster-group">
                        @foreach ($categorizedPosters['materials'] as $material)
                            <div class="poster">
                                <a href="{{ route('users.activities-show', [$user->id, 'materials', $material->id]) }}" class="text-decoration-none text-black">
                                    <img src="{{ $material->getImageUrl() }}" class="poster-image"
                                        alt="{{ $material->title }}" height="229">
                                    <div class="poster-title">
                                        <small>{{ $material->title }}</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($categorizedPosters['online tests']->count() > 0)
            <div class="row mt-3">
                <div class="col-12 test-type">
                    <span class="fw-medium">Online Tests <span class="fw-normal fs-20">(Overall Score: %)</span></span>
                </div>
                <div class="col-12">
                    <div class="poster-group">
                        @foreach ($categorizedPosters['online tests'] as $onlineTest)
                            <div class="poster">
                                <a href="{{ route('users.activities-show', [$user->id, 'online tests', $onlineTest->id]) }}" class="text-decoration-none text-black">
                                    <img src="{{ $onlineTest->getImageUrl() }}" class="poster-image"
                                        alt="{{ $onlineTest->title }}" height="229">
                                    <div class="poster-title">
                                        <small>{{ $onlineTest->title }}</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src=""></script>
@endpush
