<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="baseurl" content="{{ route('home') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>LnkInBio - @yield('title')</title>

    @include('components.head-links')
</head>
<body>
    <a href="" target="_blank" id="help">
        <i class="far fa-question-circle"></i> Help
    </a>

    <aside class="left-aside">
        @include('components.left-aside')
    </aside>

    <main>
        <div class="header">
            <div class="flex-1">
                <p class="d-inline-block">Analytics:</p>
                <small><i class="fal fa-eye"></i> Views: 2</small>
                <small><i class="far fa-mouse-pointer"></i> Clicks: 2</small>
            </div>
            <div class="flex-2 ms-auto">
                <p class="d-inline-block">My Link: <a href="{{ route('home', auth()->user()->username) }}" target="_blank" class="my-link">{{ route('home', auth()->user()->username) }}</a></p>
            </div>
        </div>
        <div class="main-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <aside class="right-aside">
        <div class="aside-share">
            <button type="button" class="btn-share ms-auto">Share</button>
        </div>

        <div class="link-preview">
            <div class="link-preview-iframe-container">
                <iframe seamless src="{{ route('home', auth()->user()->username) }}" id="link_preview_iframe" class="link-preview-iframe"></iframe>
            </div>
        </div>
    </aside>



    @include('components.script-links')
</body>
</html>
