@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/materials.css') }}">
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid poppins">
        <form action="{{ route('posters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="level">Difficulty</label>
                <select name="level" id="level" class="form-control">
                    @foreach ($levels as $level)
                        <option value="{{ $level }}">{{ ucwords($level) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" id="year" name="year" value="{{ old('year', date('Y')) }}" min="2024">
            </div>
            <div class="form-group">
                <label for="month">Month</label>
                <select name="month" id="month" class="form-control">
                    @foreach ($months as $month)
                        <option value="{{ $month }}">{{ ucwords($month) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/jpeg, image/png" value="{{ old('image') }}">
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date', date('Y-m-d')) }}">
            </div>
            <div class="form-group">
                <label for="taken">Taken</label>
                <input type="number" class="form-control" id="taken" name="taken" min="0" value="{{ old('taken', 0) }}">
            </div>
            <div class="form-group">
                <button type="reset" class="btn">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/add-materials.js') }}"></script>
@endpush
