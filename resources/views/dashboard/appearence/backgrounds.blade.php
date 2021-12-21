@extends('dashboard.appearence')

@section('appearence-content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="background-thumb {{ $profile->layout_type == 'background' && $profile->background == 'flat' ? 'active' : '' }}" data-name="flat">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/flat-color.jpg') }}" class="img-fluid" alt="Flat Color">
                </div>
                <div class="name">
                    <p>Flat Color</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="background-thumb {{ $profile->layout_type == 'background' && $profile->background == 'gradient' ? 'active' : '' }}" data-name="gradient">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset('assets/appearances/gradient-color.jpg') }}" class="img-fluid" alt="Gradient">
                </div>
                <div class="name">
                    <p>Gradient</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="background-thumb {{ $profile->layout_type == 'background' && $profile->background == 'image' ? 'active' : '' }}" data-name="image">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
                <div class="image">
                    <img src="{{ asset($profile->background_image) }}" class="img-fluid" alt="Image">
                </div>
                <div class="name">
                    <p>Image</p>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-12">
            <div class="background-options">
                <div class="background-color">
                    <div class="background-heading">Background Color</div>
                    <div class="colorpicker">
                        <label class="colordisplay" for="colordisplay" style="background-color: {{ $profile->background_color_one }};">
                            <input type="color" id="colordisplay" style="visibility: hidden; z-index: -1">
                        </label>
                        <input type="text" class="colorinput" value="{{ $profile->background_color_one }}" name="background_color_one" autocomplete="off">
                        <input type="hidden" value="{{ $profile->background_color_two }}" name="background_color_two" autocomplete="off">
                    </div>
                </div>
                <div class="background-gradient" style="{{ $profile->layout_type == 'background' && $profile->background == 'gradient' ? '' : 'display: none;' }}">
                    <div class="background-heading">Direction</div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="direction" id="gradient-up" value="0" {{ $profile->direction == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="gradient-up">
                            <span class="colorup"></span>
                            Gradient Up
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="direction" id="gradient-down" value="180" {{ $profile->direction == '180' ? 'checked' : '' }}>
                        <label class="form-check-label" for="gradient-down">
                            <span class="colordown"></span>
                            Gradient Down
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
