@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        @include('shared.success-message')

        <div class="row">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30">
                            <a href="{{ route($prefix . '.posters.index') }}" class="text-decoration-none dark-purple">
                                {{ $prefix == 'materials' ? 'Materials' : 'Online Tests' }}
                            </a>
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
                    <a href="{{ route($prefix . '.posters.tests.create', $poster->id) }}" class="btn btn-primary rounded">
                        Add New {{ $prefix == 'materials' ? 'Material' : 'Online Test' }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-transparent p-3">
                        <h4 class="card-title m-0 text-center dark-purple">{{ $poster->title }}</h4>
                    </div>
                    <table class="table table-hover table-striped m-0">
                        <tbody>
                            @if ($tests->count() == 0)
                                <tr>
                                    <td class="px-3 text-center align-middle" style="color: var(--dark-purple);">
                                        No {{ $prefix == 'materials' ? 'material' : 'online test' }} available for this
                                        poster
                                    </td>
                                </tr>
                            @else
                                @foreach ($tests as $test)
                                    <tr>
                                        <td class="px-3 text-start align-middle fw-medium text-capitalize"
                                            style="color: var(--dark-purple);">
                                            English {{ $test->type . ' ' . $test->order }}
                                        </td>
                                        <td class="px-3 text-end">
                                            <form
                                                action="{{ route($prefix . '.posters.tests.destroy', ['poster' => $poster->id, 'test' => $test->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm"
                                                    href="{{ route($prefix . '.posters.tests.show', [$poster->id, $test->id]) }}">View</a>
                                                <button class="btn btn-danger btn-sm" type="submit">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src=""></script>
@endpush
