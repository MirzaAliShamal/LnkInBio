@extends('dashboard.appearence')

@section('appearence-content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'sunset' ? 'active' : '' }}" data-name="sunset">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/sunset.jpg') }}" class="img-fluid" alt="Sunset">
                </div>
                <div class="name">
                    <p>Sunset</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'talking-to-mice' ? 'active' : '' }}" data-name="talking-to-mice">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/talking-to-mice.jpg') }}" class="img-fluid" alt="Talking to mice">
                </div>
                <div class="name">
                    <p>Talking to mice</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'purple-grapes' ? 'active' : '' }}" data-name="purple-grapes">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/purple-grapes.jpg') }}" class="img-fluid" alt="Purple Grapes">
                </div>
                <div class="name">
                    <p>Purple Grapes</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'poncho' ? 'active' : '' }}" data-name="poncho">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/poncho.jpg') }}" class="img-fluid" alt="Poncho">
                </div>
                <div class="name">
                    <p>Poncho</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'pizelex' ? 'active' : '' }}" data-name="pizelex">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/pizelex.jpg') }}" class="img-fluid" alt="Pizelex">
                </div>
                <div class="name">
                    <p>Pizelex</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'netflix' ? 'active' : '' }}" data-name="netflix">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/netflix.jpg') }}" class="img-fluid" alt="Netflix">
                </div>
                <div class="name">
                    <p>Netflix</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'nature' ? 'active' : '' }}" data-name="nature">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/nature.jpg') }}" class="img-fluid" alt="Nature">
                </div>
                <div class="name">
                    <p>Nature</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'minty-shadow' ? 'active' : '' }}" data-name="minty-shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/minty-shadow.jpg') }}" class="img-fluid" alt="Minty Shadow">
                </div>
                <div class="name">
                    <p>Minty Shadow</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'miami-dolphins' ? 'active' : '' }}" data-name="miami-dolphins">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/miami-dolphins.jpg') }}" class="img-fluid" alt="Miami Dolphins">
                </div>
                <div class="name">
                    <p>Miami Dolphins</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'instagram' ? 'active' : '' }}" data-name="instagram">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/instagram.jpg') }}" class="img-fluid" alt="Instagram">
                </div>
                <div class="name">
                    <p>Instagram</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'green-bottle' ? 'active' : '' }}" data-name="green-bottle">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/green-bottle.jpg') }}" class="img-fluid" alt="Green Bottle">
                </div>
                <div class="name">
                    <p>Green Bottle</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="theme-thumb {{ $profile->layout_type == 'theme' && $profile->theme == 'forever-lost' ? 'active' : '' }}" data-name="forever-lost">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/forever-lost.jpg') }}" class="img-fluid" alt="Forever Lost">
                </div>
                <div class="name">
                    <p>Forever Lost</p>
                </div>
            </div>
        </div>
    </div>
@endsection
