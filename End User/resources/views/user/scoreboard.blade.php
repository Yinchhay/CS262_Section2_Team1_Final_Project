@extends('layout.user_master')

@section('title', 'Scoreboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/scoreboard.css') }}">
@endpush

@section('content')

    <div class="pagetitle">
        <h1>Scoreboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Scoreboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Left side columns -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="certificate-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Title</th>
                                <th>Percentage</th>
                                <th>Total Questions</th>
                                <th>Correct Answers</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userScores as $index => $score)
                                <tr>
                                    <td class="table-light">{{ $index + 1 }}</td>
                                    <td class="table-light">{{ $score->testSkill->test->poster->title }}
                                    </td>
                                    <td class="table-light">
                                        {{ round(($score->correct_answers / $score->total_questions) * 100, 2) }}%</td>
                                    <td class="table-light">{{ $score->total_questions }}</td>
                                    <td class="table-light">{{ $score->correct_answers }}</td>
                                    <td class="table-light">{{ $score->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
