@extends('layout.user_master')

@section('title', 'User Profile')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@endpush

@section('content')


    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


        <!-- Left side columns -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-card mt-5">
                        <form action="{{route('user.update', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="=profile-header d-flex ">
                                <img class="" src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('profile/defaultProfile.jpg') }}" id="profileImage"  >
                                <div class="image-button">
                                    <input type="file" class="form-control-file" id="profilePicture" name="image" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    <button type="button" class="btn btn-secondary ml-1" onclick="document.getElementById('profilePicture').click();">Change Picture</button>
                                </div>
                            </div>
                            <table class="table table-striped table-borderless mt-5">
                                <tbody >
                                    <tr>
                                        <th scope="row">User ID:</th>
                                        <td>{{ str_pad(Auth::user()->id, 8, '0', STR_PAD_LEFT) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Full Name:</th>
                                        <td><input type="text" class="form-control" name="first_name" value="{{ ucwords(Auth::user()->first_name) }}" ></td>
                                        <td><input type="text" class="form-control" name="last_name" value="{{ ucwords(Auth::user()->last_name) }}" ></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Registered Date:</th>
                                        <td>{{ Auth::user()->created_at->format('Y-m-d') }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td>{{ Auth::user()->email }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-left mt-3 button">
                                <button type="submit" class="btn btn-primary" value="update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


@endsection

@push('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>

        function previewImage(event) {
            var image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endpush
