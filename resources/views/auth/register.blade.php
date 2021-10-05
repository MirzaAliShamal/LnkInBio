<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="baseurl" content="{{ route('home') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>LnkInBio - Register</title>

    {{-- External Libraries --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/css/tabler-icons.css') }}">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
</head>
<body>
    <a href="" target="_blank" id="help">
        <i class="far fa-question-circle"></i> Help
    </a>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="logo-style-1 mt-3 ms-4">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card login-card">
                    <div class="card-body">
                        <h2 class="text-center">Create and account for free</h2>

                        <div class="login-form mt-5">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-floating not-valid">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" autocomplete="name">
                                    <span class="invalid-feedback">
                                        @error('name')
                                            <strong><small>{{ $message }}</small></strong>
                                        @enderror
                                    </span>
                                    <label for="name">Full Name</label>
                                </div>
                                <div class="form-floating not-valid un" style="display: none;">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" autocomplete="username">
                                    <span class="invalid-feedback">
                                        @error('username')
                                        <strong><small>{{ $message }}</small></strong>
                                        @enderror
                                    </span>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating not-valid">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  placeholder="name@example.com" autocomplete="email">
                                    <span class="invalid-feedback">
                                        @error('email')
                                        <strong><small>{{ $message }}</small></strong>
                                        @enderror
                                    </span>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating not-valid">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" autocomplete="off">
                                    <span class="invalid-feedback">
                                        @error('password')
                                        <strong><small>{{ $message }}</small></strong>
                                        @enderror
                                    </span>
                                    <label for="password">Password</label>
                                </div>

                                <div class="form-check not-valid">
                                    <input class="form-check-input" type="checkbox" value="1" name="agree_terms" id="agree_terms">
                                    <label class="form-check-label" for="agree_terms">
                                        By creating an account you are agreeing to our
                                        <a href="" class="text-decoration-underline" target="_blank">Terms and Conditions</a>
                                        and
                                        <a href="" class="text-decoration-underline" target="_blank">Privacy Policy</a>
                                    </label>
                                </div>

                                <button type="submit" class="btn-login mt-3" disabled>Sign Up</button>

                                <a href="{{ route('login') }}" class="forgot-password">Already have an account?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{-- External Scripts --}}
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/drag-arrange.min.js') }}"></script>

    {{-- Fonts --}}
    <script src="{{ asset('assets/fonts/js/pro.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    {{-- Script --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/register-validate.js') }}"></script>
</body>
</html>
