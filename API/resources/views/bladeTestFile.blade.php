@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/materials/create.css') }}">
    <style>
        .progress-circle {
            /* transform: rotate(-90deg); */
        }

        .progress-background {
            fill: none;
            stroke: #007bff50;
            stroke-width: 5;
        }

        .progress-bar {
            fill: none;
            stroke: #007bff;
            stroke-width: 5;
            stroke-linecap: round;
            stroke-dasharray: 188.495;
            /* Circumference of the circle (2 * PI * radius) */
            stroke-dashoffset: 188.495;
            /* Initial value to hide the stroke */
            transition: stroke-dashoffset 1s;
        }

        .progress-text {
            font-size: 18px;
            fill: #000;
            text-anchor: middle;
            dominant-baseline: middle;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid poppins">
        @include('shared.success-message')

        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30"><a href="{{ route($prefix . '.posters.index') }}"
                                class="text-decoration-none dark-purple">{{ $prefix == 'materials' ? 'Materials' : 'Online Tests' }}</a>
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">Posters</li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            {{ $poster->title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 d-flex flex-row justify-content-between">
                <div class="poster d-flex flex-row align-items-center gap-4">
                    <div class="poster-img">
                        <img class="rounded" src="{{ $poster->getImageUrl() }}" alt="poster" height="285">
                    </div>

                    <div class="poster-desc d-flex flex-column gap-3">
                        <div class="poster-title text-start w-100">
                            <h3 class="title text-uppercase">ENGLISH
                                {{ $prefix == 'materials' ? 'MATERIALS' : 'ONLINE TESTS' }}</h3>
                            <span class="title-desc fw-medium text-capitalize">
                                <span>{{ $poster->level . ' ' . $poster->year . ' ' . $poster->month }}</span>
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

                        <div class="btn-group gap-3 w-50">
                            <a class="btn btn-primary rounded d-inline"
                                href="{{ route($prefix . '.posters.edit', $poster->id) }}">Edit</a>
                            <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal">
                                Delete
                            </button>

                            <form action="{{ route($prefix . '.posters.destroy', $poster->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this item?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger"
                                                    id="confirmDeleteButton">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route($prefix . '.posters.tests.create', $poster->id) }}"
                        class="btn btn-primary rounded">Add New {{ $prefix == 'materials' ? 'Material' : 'Online Test' }}</a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 mt-3">
                <div class="card d-inline-block w-auto p-4">
                    <div class="card-header bg-white p-0 d-flex flex-row justify-content-between" style="border: none;">
                        <h4 class="card-title">English Material 1</h4>
                        <div>
                            <a class="btn btn-sm" href="">View</a>
                            <button class="btn btn-danger btn-sm">X</button>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-row gap-4 p-0 pt-2">
                        <div class="card px-4 py-3 text-center gap-3" style="width: 15rem;">
                            <i class='bx bx-book-open fs-1'></i>
                            <div class="card-body p-0">
                                <h5 class="card-title">Vocabulary</h5>
                                <p class="card-text">
                                    <svg class="progress-circle" width="100" height="100" viewBox="0 0 80 80">
                                        <circle class="progress-background" cx="40" cy="40" r="30"></circle>
                                        <circle class="progress-bar" cx="40" cy="40" r="30"></circle>
                                        <text x="40" y="40" class="progress-text" id="progress-text">50</text>
                                    </svg>
                                </p>
                                <a href="" class="card-link btn btn-primary btn-md align-middle rounded">
                                    <i class='bx bxs-zap align-middle' style="transform: rotateY(45deg)"></i>
                                    Take Material
                                </a>
                            </div>
                        </div>
                        <div class="card px-4 py-3 text-center gap-3" style="width: 15rem;">
                            <i class='bx bx-book-content fs-1 mt-3'></i>
                            <div class="card-body p-0">
                                <h5 class="card-title">Grammar</h5>
                                <p class="card-text">
                                    <svg class="progress-circle" width="100" height="100" viewBox="0 0 80 80">
                                        <circle class="progress-background" cx="40" cy="40" r="30">
                                        </circle>
                                        <circle class="progress-bar" cx="40" cy="40" r="30"></circle>
                                        <text x="40" y="40" class="progress-text" id="progress-text">50</text>
                                    </svg>
                                </p>
                                <a href="" class="card-link btn btn-primary btn-md align-middle rounded">
                                    <i class='bx bxs-zap align-middle' style="transform: rotateY(45deg)"></i>
                                    Take Material
                                </a>
                            </div>
                        </div>
                        <div class="card px-4 py-3 text-center gap-3" style="width: 15rem;">
                            <i class='bx bx-headphone fs-1 mt-3'></i>
                            <div class="card-body p-0">
                                <h5 class="card-title">Listening</h5>
                                <p class="card-text">
                                    <svg class="progress-circle" width="100" height="100" viewBox="0 0 80 80">
                                        <circle class="progress-background" cx="40" cy="40" r="30">
                                        </circle>
                                        <circle class="progress-bar" cx="40" cy="40" r="30"></circle>
                                        <text x="40" y="40" class="progress-text" id="progress-text">50</text>
                                    </svg>
                                </p>
                                <a href="" class="card-link btn btn-primary btn-md align-middle rounded">
                                    <i class='bx bxs-zap align-middle' style="transform: rotateY(45deg)"></i>
                                    Take Material
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer mt-3 p-3 d-flex flex-row align-items-center justify-content-between dark-purple rounded"
                        style="background-color: rgba(155,91,220,.5);">
                        <h5 class="m-0">Full Material</h5>
                        <div class="rectangle-bar rounded"
                            style="width: 350px; background-color: #fff; border: 1px solid var(--dark-purple);">
                            <div class="rectangle-progress text-center" style="padding: 6px;">
                                0%
                            </div>
                        </div>
                        <a href="" class="btn btn-primary btn-md align-middle rounded">
                            <i class='bx bxs-zap' style="transform: rotateY(45deg)"></i>
                            Start
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/add-materials.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.querySelector('.progress-bar');
            const progressText = document.getElementById('progress-text');
            const percentage = progressText.innerHTML;
            console.log(percentage);

            // Calculate the stroke-dashoffset
            const radius = progressBar.r.baseVal.value;
            const circumference = 2 * Math.PI * radius;
            const offset = circumference - (percentage / 100 * circumference);

            // Set the stroke-dashoffset
            progressBar.style.strokeDashoffset = offset;

            // Set the progress text
            progressText.textContent = `${percentage}%`;
        });
    </script>
@endpush
