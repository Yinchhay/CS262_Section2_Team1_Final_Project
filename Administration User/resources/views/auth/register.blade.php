<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>PROFICIENTIA | Register</title>
    <link rel="icon" href="{{ asset('images/proficientia_logo.png') }}" type="image/png" sizes="16x16 32x32">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/defined_class.css') }}">

    <style>
        .body {
            font-family: 'Poppins', sans-serif;
        }

        .form {
            width: 500px;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            font-weight: 600;
        }

        .bg-bluepurple {
            background: linear-gradient(to left, #4437DD 0%, #A865FE 100%);
            color: white;
            outline: none;
            border: none;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        .bg-bluepurple:active {
            transform: translateY(2px);
        }

        .bg-bluepurple.active {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-xxl">
        <div class="row">
            <div class="d-flex justify-content-center vh-100 align-items-center">
                <form action="{{ route('register') }}" method="POST" class="form">
                    @csrf
                    <div class="logo saria-condensed d-flex flex-row align-items-center">
                        <img src="{{ asset('images/proficientia_logo.png') }}" alt="PROFICIENTIA" width="60"
                            height="60" class="d-inline-block align-text-top">
                        <span class="sa fw-semibold">
                            <span class="logo-top orange">PROFI</span>
                            <span class="logo-bottom purple">CIENTIA</span>
                        </span>
                    </div>

                    <h3 class="text-center m-0 mb-3 dark-purple">Register</h3>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="first-name" class="form-label">First Name</label>
                            <input type="text" class="form-control bg-transparent" name="first_name" id="first-name">
                            {{-- <input type="text" class="form-control bg-transparent" id="first-name"
                                value="super" disabled>
                            <input type="hidden" name="first_name" value="super"> --}}
                            @error('first_name')
                                <span class="d-block text-danger mt-1" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="last-name" class="form-label">Last Name</label>
                            <input type="text" class="form-control bg-transparent" name="last_name" id="last-name">
                            {{-- <input type="text" class="form-control bg-transparent" id="last-name"
                                value="admin" disabled>
                            <input type="hidden" name="last_name" value="admin"> --}}
                            @error('last_name')
                                <span class="d-block text-danger mt-1" style="font-size: 14px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your email">
                        @error('email')
                            <span class="d-block text-danger mt-1" style="font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password">
                        @error('password')
                            <span class="d-block text-danger mt-1" style="font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm your password">
                        @error('password_confirmation')
                            <span class="d-block text-danger mt-1" style="font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn bg-bluepurple">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>
