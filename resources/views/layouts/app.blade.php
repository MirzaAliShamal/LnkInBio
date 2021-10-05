<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="baseurl" content="{{ route('home') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>LnkInBio - Login</title>

    @include('components.head-links')
</head>
<body>
    <a href="" target="_blank" id="help">
        <i class="far fa-question-circle"></i> Help
    </a>

    <aside class="left-aside">
        <div class="aside-logo">
            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo">
        </div>

        <div class="aside-menu">
            <ul>
                <li><a href="{{ route('dashboard.link.list') }}">Links</a></li>
                <li><a href="">Appearences</a></li>
                <li><a href="">Settings</a></li>
                <li><a href="">Pro</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Notifications</a></li>
            </ul>
        </div>

        <div class="aside-avatar">
            <div class="image-outer">
                <img src="{{ asset(auth()->user()->avatar) }}" class="img-fluid" alt="Logo">
            </div>
            <p>{{ auth()->user()->name }}</p>
        </div>
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
                        <div class="page-heading">
                            <h3>Links</h3>
                        </div>

                        <div class="page-content">
                            <div class="page-inner">
                                <div class="row">
                                    <div class="col-10">
                                        <button type="button" data-url="{{ route('dashboard.link.new') }}" data-count="0" class="btn-main btn-new-link">Create new Link</button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn-main"><i class="fas fa-bolt"></i></button>
                                    </div>
                                </div>

                                <div class="link-container" id="link-container">
                                    @foreach ($links as $item)
                                        <div class="link-single d-flex" data-position="{{ $item->position }}" data-id="{{ $item->id }}">
                                            <div class="link-handle">
                                                <i class="fal fa-bars"></i>
                                            </div>
                                            <div class="link-main">
                                                <div class="link-top d-flex">
                                                    <div class="link-detail w-100">
                                                        <div class="title editable">
                                                            <input type="text" class="title-input d-none" data-target="title-text" value="{{ $item->title }}" autocomplete="off">
                                                            <p><span class="title-text">{{ $item->title ?? 'Title' }}</span> <span><i class="fad fa-pencil-alt"></i></span></p>
                                                        </div>
                                                        <div class="url editable">
                                                            <input type="text" class="url-input d-none" data-target="url-text" value="{{ $item->link }}" autocomplete="off">
                                                            <p><span class="url-text">{{ $item->link ?? 'Url' }}</span> <span><i class="fad fa-pencil-alt"></i></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="link-switcher">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input ms-0" type="checkbox" id="link-switcher-{{ $item->position }}" {{ $item->status ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="link-switcher-{{ $item->position }}"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="link-footer d-flex">
                                                    <span class="flex-1"><i data-feather="image"></i></span>
                                                    <span class="flex-2"><i data-feather="star"></i></span>
                                                    <span class="flex-3"><i data-feather="calendar"></i></span>
                                                    <span class="flex-4"><i data-feather="lock"></i></span>
                                                    <span class="flex-5"><i data-feather="bar-chart-2"></i></span>
                                                    <span class="flex-6 ms-auto"><i data-feather="trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
