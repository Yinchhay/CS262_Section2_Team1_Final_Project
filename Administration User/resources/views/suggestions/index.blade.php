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
                            <a href="{{ route('suggestions.index') }}" class="text-decoration-none dark-purple">
                                Suggestions
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col-2">Subject Title</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suggestions as $suggestion)
                            <tr>
                                <td>{{ $suggestion->subject }}</td>
                                <td class="text-center"><a href="{{ route('suggestions.show', $suggestion->id) }}"
                                        class="text-decoration-none text-black">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/schedule.js') }}"></script>
@endpush
