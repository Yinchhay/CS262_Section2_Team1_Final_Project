@extends('layout.master-landing')
@section('content')

    <div class="container-xxl poppins">
        <div class="row m-5 p-5 auth-box d-flex align-items-center">
            <div class="col" id="login">
                <h3 class="m-0 text-center font-weight-semibold" style="font-size: 32px;">Welcome Back</h3>
                <p class="text-center">Enter your credentials to login</p>

                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="password" placeholder="afihq9#@" required>
                            <i class="bi bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit fs-18 font-weight-semibold"
                        style="width: 100%; margin-top: 30px;">Login</button>
                    <p class="m-0 mt-2 text-center fs-16">Don’t have an account? <a href="#signup"
                            class="purple font-weight-semibold text-decoration-none">Sign up</a></p>
                </form>
            </div>

            <div class="col">
                <img src="images/online_testing_image.png" alt="" width="100%">
            </div>

            <div class="col" id="signup">
                <h3 class="m-0 text-center font-weight-semibold" style="font-size: 32px;">Sign Up</h3>
                <p class="text-center">Create your account</p>

                <form>
                    <div class="mb-3 d-flex flex-row gap-2">
                        <div class="col-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" placeholder="Jimmy" required>
                        </div>
                        <div class="col-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" placeholder="James" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Phone Number</label>
                        <select name="country-code" id="">
                            <option value="+855" data-flag="us"><span class="flag flag-us"></span></option>
                            <option value="+1"><i class="fas fa-flag-us"></i></i></option>
                            <option value="+54"><span class="flag flag-us"></span></option>
                            <option value="+34"><span class="flag flag-us"></span></option>
                            <option value="+61"><span class="flag flag-us"></span></option>
                            <option value="+233"><span class="flag flag-us"></span></option>
                        </select>
                        <input type="tel" class="form-control" id="tel" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="password" placeholder="afihq9#@" required>
                            <i class="bi bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="password" required>
                            <i class="bi bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit fs-18 font-weight-semibold"
                        style="width: 100%; margin-top: 30px;">Sign Up</button>
                    <p class="m-0 mt-2 text-center fs-16">Already have an account? <a href="#login"
                            class="purple font-weight-semibold text-decoration-none">Log in</a></p>
                </form>
            </div>
        </div>
    </div>

@stop
