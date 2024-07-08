@extends('layout.user_master')

@section('title', 'Online Test Form')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/css/form_online_test.css')}}">
@endpush

@section('content')



    <div class="pagetitle">
      <h1>Online Test</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('test.index')}}">Online Test</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


        <!-- Left side columns -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="form-content">
              <h3>English Online Test 2</h3>
              <div class="instruction-content">
                <p>Instruction:</p>
                <p>1.Carefully read each question and choose the best answer from the options provided, as each question is multiple-choice.</p>
                <p>2.Ensure to select the option that most accurately addresses the question.</p>
                <p>3.Pay attention to details and context to make informed choices.</p>
                <audio controls>
                    <source src="horse.ogg" type="audio/ogg">
                    <source src="horse.mp3" type="audio/mpeg">
                  Your browser does not support the audio element.
                </audio>
                <hr>
              </div>
              <div class="time-counter d-flex justify-content-end ">
                <p>Time Remaining: <span id="time">60 Minutes</span><i class="bi bi-hourglass-split"></i></p>
              </div>
            </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <form class="question-form" action="{{route('test.result')}}">
            @csrf
            <label class="question-title text-primary text-bold fw-bold fs-5 mt-2 mb-2">Question 1</label>
            <p class="question-problem">Which of the following words is a synonym for "happy"?</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="question1" id="q1a">
              <label class="form-check-label" for="q1a">
                A. Sad
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="question1" id="q1b" >
              <label class="form-check-label" for="q1b">
                B. Joyful
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="question1" id="q1c">
              <label class="form-check-label" for="q1c">
                C. Angry
              </label>
            </div>



            <label class="question-title text-primary text-bold fw-bold fs-5 mt-4 mb-2">Question 2</label>
            <p class="question-problem">Which of the following words means "to make something smaller in size"?</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="question2" id="q2a">
              <label class="form-check-label" for="q2a">
                A. Enlarge
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="question2" id="q2b" >
              <label class="form-check-label" for="q2b">
                B. Shrink
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="question2" id="q2c">
              <label class="form-check-label" for="q2c">
                C. Expand
              </label>
            </div>



            <button type="submit" class="btn btn-primary mt-5">Submit</button>

          </form>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush


