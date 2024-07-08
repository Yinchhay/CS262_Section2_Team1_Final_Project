<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Proficientia</title>
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
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="assets/css/welcome_nav.css" rel="stylesheet">
    <link href="assets/css/welcome_footer.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header Nav ======= -->
    @include('layout.welcome_nav')
    <!-- ======= End Header Nav ======= -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    @include('shared.success-message')

                    <h1>Unlock Your Potential</h1>

                    <h2> With Proficientia! Perfect for students, professionals, and educators alike, our platform
                        offers top-tier online English testing and certification. </h2>
                    <div class="d-flex">
                        <a href="{{ route('signup') }}" class="btn-get-started">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets/img/main.jpg" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about ">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/img/about.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>About Proficientia - Your gateway to English language excellence</h3>
                        <p class="fst-italic">
                            with features like test preparation materials, and exam scheduling.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> At Proficientia, we're dedicated to empowering
                                individuals to achieve their English language goals.</li>
                            <li><i class="bi bi-check-circle"></i> Founded with a passion for technology, education and
                                innovation, our platform provides a eamless experience for users worldwide.</li>
                            <li><i class="bi bi-check-circle"></i> Whether you're aiming for academic success, career
                                advancement, or personal growth, we're here to support you throught every step of way.
                            </li>
                            <li><i class="bi bi-check-circle"></i> join us and embark on a journey of language mastery
                                and professional development</li>
                        </ul>
                        <p>
                            "The more that you read, the more things you'll know. The more that you learn, the more
                            places you'll go." - Dr. Seuss
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">

                <div class="section-title">
                    <span>Services</span>
                    <h2>Services</h2>
                    <p>We offer a range of essential services to support your English language journey, ensuring the
                        most satisfaction and convenience way of learning</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class='bx bx-book-content'></i></div>
                            <h4>Material Provided</h4>
                            <p>Allow users to access a wide range of study materials, such as listening, reading, and
                                grammar.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box">
                            <div class="icon"><i class='bx bx-calendar'></i></div>
                            <h4>Exam Scheduling</h4>
                            <p>Enables users to conveniently book their preferred test dates and times through the
                                website.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4>Online Test</h4>
                            <p>Service provided by the website allows users to take proficiency exams.</p>
                        </div>
                    </div>


                </div>

                <div class="row">

                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class='bx bx-certification'></i></div>
                            <h4>Certificate</h4>
                            <p>Issuing official proficiency certficates to users who successfully pass the exams
                                administered through the website.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class='bx bx-envelope'></i></div>
                            <h4>Contact Us</h4>
                            <p>Provide users with a mean to communicate directly with the support team and the
                                administrator.</p>
                        </div>
                    </div>


                </div>


            </div>
        </section><!-- End Services Section -->




    </main><!-- End #main -->

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
