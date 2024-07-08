@extends('layout.master')

@section('title', 'Exam Scheduling')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/schedule.css') }}">
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
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            Certificates
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search . . ." aria-label="Search"
                        aria-describedby="search-icon">
                    <button class="btn btn-outline-secondary" type="button" id="search-icon">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Certificate Title</th>
                            <th scope="col">Action</th>
                        </tr>
                </thead>
                    <tbody>
                        @forelse ($certificates as $certificate)
                            <tr>
                                <td>{{ ucwords($certificate->title) }}
                                </td>
                                <td class="text-right"><a href="{{ route('users.certificates-show', [
                                    'user' => $user,
                                    'certificate' => $certificate,
                                ]) }}"
                                        class="btn ">View</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No certificates found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/schedule.js') }}"></script>
@endpush
