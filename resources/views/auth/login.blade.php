<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="baseurl" content="{{ route('home') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>LnkInBio - Login</title>

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
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card login-card mt-5">
                    <div class="card-body">
                        <h2 class="text-center">Sign in to your LnkInBio Account</h2>

                        <div class="login-form mt-5">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-floating not-valid">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email">
                                    <span class="invalid-feedback">
                                        @error('email')
                                            <strong><small>{{ $message }}</small></strong>
                                        @enderror
                                    </span>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating not-valid">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" autocomplete="password">
                                    <span class="invalid-feedback">
                                        @error('password')
                                            <strong><small>{{ $message }}</small></strong>
                                        @enderror
                                    </span>
                                    <label for="password">Password</label>
                                </div>

                                <button type="submit" class="btn-login" disabled>Sign In</button>

                                <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>

                                <p>Don't have an account? <a href="{{ route('register') }}" class="font-weight-600">Create One</a></p>
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
    <script src="{{ asset('assets/js/login-validate.js') }}"></script>
</body>
</html>
