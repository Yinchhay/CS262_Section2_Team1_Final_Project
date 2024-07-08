<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Proficientia | Log In</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/login.css" rel="stylesheet">
    <link href="assets/css/welcome_nav.css" rel="stylesheet">
    <link href="assets/css/welcome_footer.css" rel="stylesheet">
</head>

<body>

    <!-- HEADER -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="/" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="/">Home</a></li>
                    <li><a class="nav-link scrollto" href="/">About</a></li>
                    <li><a class="nav-link scrollto" href="/">Services</a></li>
                    <li><a class="nav-link scrollto" href="/">Contact</a></li>
                    <li><a class="login" href="{{route('login')}}">Login</a></li>
                    <li><a class="signup" href="{{route('signup')}}">Sign Up</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Sign Up Section ======= -->
    <section class="signup">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 signup-form">



                    <div class="col-sm-6 form-content">
                        <form action="{{ route('login') }}" method="post" role="form">
                            @csrf

                            <div class="row">
                                <h2>Welcome Back</h2>
                                <p>Enter Your Credential To Login</p>

                                <div class="form-group mt-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        id="email">
                                    @error('email')
                                        <span class="d-block text-danger mt-1"
                                            style="font-size: 14px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        id="password">
                                    @error('password')
                                        <span class="d-block text-danger mt-1"
                                            style="font-size: 14px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center"><button type="submit">Login</button></div>
                            </div>
                            <p>Don't have an account?<a href="{{route('signup')}}"> Sign Up</a></p>

                        </form>

                    </div>
                    <div class="col-sm-6 form-content">
                        <img src="{{asset('assets/img/signup.png')}}" class="img-fluid" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Contact Section -->

    <!-- ======= Footer ======= -->
    @include('layout.welcome_footer')

    <!-- ======= End Footer ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
