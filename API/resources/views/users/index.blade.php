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
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-2">
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

        <div class="row mt-3 mb-4 d-flex flex-row">
            <div class="col-auto fs-16 dark-purple">
                Sort by:
            </div>
            <div class="col-auto d-flex flex-column gap-2">
                <div class="btn-group gap-3">
                    <a href="{{ route('users.index', array_merge(request()->all(), ['sort' => 'first_name'])) }}"
                        class="btn btn-sm btn-outline-dark-purple rounded {{ request('sort') == 'first_name' ? 'active' : '' }}">
                        First Name
                    </a>
                    <a href="{{ route('users.index', array_merge(request()->all(), ['sort' => 'last_name'])) }}"
                        class="btn btn-sm btn-outline-dark-purple rounded {{ request('sort') == 'last_name' ? 'active' : '' }}">
                        Last Name
                    </a>
                    <a href="{{ route('users.index', array_merge(request()->all(), ['sort' => 'created_at'])) }}"
                        class="btn btn-sm btn-outline-dark-purple rounded {{ request('sort') == 'created_at' ? 'active' : '' }}">
                        Registered Date
                    </a>
                    <a href="{{ route('users.index', array_merge(request()->all(), ['sort' => 'updated_at'])) }}"
                        class="btn btn-sm btn-outline-dark-purple rounded {{ request('sort') == 'updated_at' ? 'active' : '' }}">
                        Updated Date
                    </a>
                </div>
                <div class="btn-group gap-3 w-auto">
                    <form action="{{ route('users.index') }}" class="d-flex flex-row gap-4">
                        <div class="form-check fs-14 dark-purple">
                            <input class="form-check-input" type="radio" name="order" id="ascending" value="asc"
                                {{ request('order', 'asc') == 'asc' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="form-check-label" for="ascending">Ascending</label>
                        </div>
                        <div class="form-check fs-14 dark-purple">
                            <input class="form-check-input" type="radio" name="order" id="descending" value="desc"
                                {{ request('order') == 'desc' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="form-check-label" for="descending">Descending</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <table class="table table-hover table-striped">
                    <caption class="p-0 m-0">User Accounts</caption>
                    <thead>
                        <tr>
                            <th colspan="6" class="text-start bg-transparent text-dark fw-normal">
                                <span>Number of users: {{ $users->count() }}</span>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Activities</th>
                            <th scope="col">Certificates</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ str_pad($user->id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td class="text-capitalize">{{ $user->first_name }}</td>
                                <td class="text-capitalize">{{ $user->last_name }}</td>
                                <td><a href="{{ route('users.profile', $user->id) }}"
                                        class="btn btn-sm btn-dark-purple">View</a></td>
                                <td><a href="{{ route('users.activities', $user->id) }}"
                                        class="btn btn-sm btn-dark-purple">View</a>
                                </td>
                                <td>
                                    <a href="{{ route('users.certificates', $user->id) }}"
                                        class="btn btn-sm btn-dark-purple">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src=""></script>
@endpush
