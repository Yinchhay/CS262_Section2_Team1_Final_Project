@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/materials.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="row">
            <div class="col-lg-12 text-start dark-purple">
                <span class="fs-30">Materials</span>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search . . ." aria-label="Search"
                        aria-describedby="search-icon">
                    <button class="btn btn-outline-secondary" type="button" id="search-icon">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
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
                <a href="{{ route('materials.create') }}"><button type="button" class="btn bg-bluepurple"
                        data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                        Add Material
                    </button>
                </a>
            </div>
        </div>
        <div class="row mt-2">
            <span class="fs-20 dark-purple">Result: <span class="result"></span></span>
        </div>
        <div class="row mt-3">
            <div class="col-12 level">
                <span>Beginner</span>
            </div>
            <div class="col-12">
                <div class="poster-group">
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image" alt=""
                                height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image" alt=""
                                height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image" alt=""
                                height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image" alt=""
                                height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image" alt=""
                                height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials beginner 2024 January</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 level">
                <span>Intermediate</span>
            </div>
            <div class="col-12">
                <div class="poster-group">
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                    <div class="poster">
                        <a href="" class="text-decoration-none text-black">
                            <img src="{{ asset('images/english_material_image.png') }}" class="poster-image"
                                alt="" height="229">
                            <div class="poster-title">
                                <small>English materials intermediate 2024 January</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/materials.js') }}"></script>
@endpush
