@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/materials.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        @include('shared.success-message')

        <div class="row">
            <div class="col-lg-12 text-start dark-purple">
                <span class="fs-30">
                    {{ $prefix == 'materials' ? 'Materials' : 'Online Tests' }}
                </span>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-4">
                <form action="{{ route($prefix . '.posters.index') }}" method="GET">
                    <div class="input-group">
                        <input value="{{ request('search', '') }}" name="search" type="text" class="form-control"
                            placeholder="Search . . ." aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-6">
                <div class="btn-group" role="group" aria-label="Search Filters">
                    <button type="button" class="btn btn-primary" data-filter="Recently Added">Recently Added</button>
                    <button type="button" class="btn btn-primary" data-filter="Most Taken">Most Taken</button>
                    <div class="btn-group" role="group">
                        <button id="yearFilter" type="button" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Year
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="yearFilter">
                            <li><a class="dropdown-item" href="#" data-filter="2024">2024</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="2023">2023</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="2022">2022</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-2 text-end">
                <a href="{{ route($prefix . '.posters.create') }}">
                    <button type="button" class="btn bg-bluepurple" data-bs-toggle="modal"
                        data-bs-target="#addMaterialModal">Add Poster</button>
                </a>
            </div>
        </div>

        <div class="row mt-2">
            <span class="fs-20 dark-purple">Result: <span class="result"></span></span>
        </div>

        @if ($posters->count() == 0)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-info">No {{ $prefix == 'materials' ? 'materials' : 'tests' }} found.</div>
                </div>
            </div>
        @else
            @foreach ($levels as $level)
                @php
                    $levelPosters = $posters->filter(function ($poster) use ($level) {
                        return $poster->level === $level;
                    });
                @endphp

                @if ($levelPosters->count() > 0)
                    <div class="row mt-3">
                        <div class="col-12 level">
                            <span>{{ ucwords($level) }}</span>
                        </div>

                        <div class="col-12">
                            <div class="poster-group">
                                @foreach ($levelPosters as $poster)
                                    <div class="poster">
                                        <a href="{{ route($prefix . '.posters.show', $poster->id) }}"
                                            class="text-decoration-none text-black">
                                            <img src="{{ $poster->getImageUrl() }}" class="poster-image"
                                                alt="{{ $poster->title }}" height="229">
                                            <div class="poster-title">
                                                <small>{{ $poster->title }}</small>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/materials.js') }}"></script>
@endpush
