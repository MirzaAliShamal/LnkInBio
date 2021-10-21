<!DOCTYPE html>
<html lang="en" class="preview-html" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preview</title>

    {{-- Open Graph / Facebook / Twitter --}}
    <meta property="og:type" content="website">
    <meta property="twitter:type" content="website">
    <meta property="og:url" content="http://127.0.0.1:8000/preview">
    <meta property="twitter:url" content="http://127.0.0.1:8000/preview">
    <meta name="robots" content="noindex">

    {{-- External Libraries --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" media="screen">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/css/all.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/fonts/css/tabler-icons.css') }}" media="screen">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('assets/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/preview.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/appearances/appearance-default.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/appearances/appearance-one.css') }}" media="screen">

    <link rel="canonical" href="http://127.0.0.1:8000/preview">
</head>
<body class="font-manrope">

    <div class="preview-body appearance-one">
        <div class="preview-container">
            <div class="preview-main">
                <div class="preview-background preview-body-appearance-one"></div>
                <div class="intro-area">
                    <div class="avatar">
                        <img src="{{ asset($user->avatar) }}" class="img-fluid" alt="Avatar">
                    </div>
                    <div class="profile-title"><h1>{{ profile()->title }}</h1></div>
                    <div class="bio"><h2>{{ profile()->bio }}</h2></div>
                </div>
                <div class="button-links">
                    @foreach ($links as $item)
                    <div class="links {{ $item->animation }}">
                        <a href="{{ $item->link }}" target="_blank" class="link-item" data-position="{{ $item->position }}">
                            @if (!is_null($item->image))
                                <div class="link-thumb thumb-image">
                                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="Thumb">
                                </div>
                            @endif
                            <p class="link-text">{{ $item->title }}</p>
                        </a>
                    </div>
                    @endforeach

                </div>
                <div class="social-links">
                    {{-- <a href="" target="_blank" class="social-icon"><i class="ti ti-brand-facebook"></i></a>
                    <a href="" target="_blank" class="social-icon"><i class="ti ti-brand-twitter"></i></a>
                    <a href="" target="_blank" class="social-icon"><i class="ti ti-mail"></i></a> --}}
                </div>
            </div>
            <div class="preview-footer">
                <a href="" target="_blank"><img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Brand Logo"></a>
            </div>
        </div>
    </div>


    {{-- External Scripts --}}
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
</body>
</html>
