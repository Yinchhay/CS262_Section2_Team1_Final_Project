@extends('layout.master')

@section('title', 'Materials')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/materials.css') }}">
    <style>
    </style>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container-fluid poppins">
        <div class="title">{{ $poster->title }}</div>
        <div class="image">
            {{-- <img src="{{ asset('images/ENGLISH.jpg') }}" alt="" width="300"> --}}
            <img src="{{ asset('storage/' . $poster->image) }}" alt="{{ $poster->title }}" width="300">
            {{-- <embed src="{{ asset('storage/' . $poster->image) }}" type="application/pdf" frameBorder="0" scrolling="auto"
                width="100%"></embed> --}}
            {{-- {{ asset('storage/' . $poster->image) }} --}}
            {{-- <a href="{{ asset('storage/' . $poster->image) }}" target="_blank">{{ $poster->image }}</a> --}}
        </div>
        <div class="level">{{ $poster->level }}</div>
        <div class="year">{{ $poster->year }}</div>
        <div class="month">{{ $poster->month }}</div>
        <div class="publish_date">{{ $poster->publish_date }}</div>
        <div class="taken">{{ $poster->taken }}</div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/add-materials.js') }}"></script>
@endpush
