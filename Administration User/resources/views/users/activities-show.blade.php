@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
    @php
        $currentTestSkillScore = [];
    @endphp

    <div class="container-fluid poppins">
        <div class="row mb-2">
            <div class="col-12 text-start dark-purple">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-items-baseline">
                        <li class="breadcrumb-item fs-30">
                            <a href="{{ route('users.index') }}" class="text-decoration-none dark-purple">
                                User Management
                            </a>
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            Jimmy James
                        </li>
                        <li class="breadcrumb-item active fs-20" aria-current="page">
                            <a href="{{ route('users.activities', $user->id) }}" class="text-decoration-none dark-purple">
                                Activities
                            </a>
                        </li>
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
                            <h3 class="title text-uppercase">ENGLISH {{ $prefix }}</h3>
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
                    </div>
                </div>
            </div>
        </div>

        @php
            $totalPercentage = 0;
        @endphp

        @foreach ($tests as $test)
            <div class="row mb-3">
                <div class="col-12 mt-3">
                    <div class="card d-inline-block w-auto p-4">
                        <div class="card-header bg-white p-0 d-flex flex-row justify-content-between" style="border: none;">
                            <h4 class="card-title dark-purple">English
                                {{ ($prefix == 'materials' ? 'Material' : 'Online Test') . ' ' . $test->order }}</h4>
                        </div>
                        <div class="card-body d-flex flex-row gap-4 p-0 pt-2">
                            @foreach ($test->testSkills as $testSkill)
                                <div class="card px-4 py-3 text-center gap-2" style="width: 13rem;">
                                    @if ($testSkill->skill->name == 'vocabulary')
                                        <i class='bx bx-book-open' style="font-size: 3rem;"></i>
                                    @elseif ($testSkill->skill->name == 'grammar')
                                        <i class='bx bx-book-content' style="font-size: 3rem;"></i>
                                    @else
                                        <i class='bx bx-headphone' style="font-size: 3rem;"></i>
                                    @endif

                                    <div class="card-body p-0">
                                        <h5 class="card-title text-capitalize">{{ $testSkill->skill->name }}</h5>
                                        <p class="card-text m-2" style="font-size: 20px;">
                                            @php
                                                $currentTestSkillScore = \App\Models\UserScore::getUserScore($user->id, $testSkill->id)
                                            @endphp
                                            @if ($currentTestSkillScore)
                                                {{-- have
                                                    total_score
                                                    total_questions
                                                    correct_answers
                                                --}}
                                                @php
                                                    $percentage = ($currentTestSkillScore->correct_answers / $currentTestSkillScore->total_questions) * 100;
                                                    echo $percentage . '%';
                                                    $totalPercentage += $percentage;
                                                @endphp
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer mt-3 p-3 px-4 d-flex flex-row align-items-center justify-content-between dark-purple rounded"
                            style="background-color: rgba(155,91,220,.5);">
                            <h5 class="m-0">Full Material</h5>
                            <div class="rectangle-bar rounded"
                                style="width: 450px; background-color: #fff; border: 1px solid var(--dark-purple);">
                                <div class="rectangle-progress text-center" style="padding: 6px;">
                                    <span class="text-capitalize fw-medium">
                                        @php
                                            if ($currentTestSkillScore) {
                                                $totalPercentage = $totalPercentage / count($test->testSkills);
                                                echo round($totalPercentage);
                                            } else {
                                                echo '0';
                                            }
                                        @endphp
                                        %</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script src=""></script>
@endpush
