@extends('dashboard.appearence')

@section('appearence-content')
    <div class="row">
        <div class="col-12">
            <p class="buttons-heading">Fill</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-fill buttons-rectangle {{ $profile->layout_type == 'background' && $profile->custom_button == 'fill-rectangle' ? 'active' : '' }}" data-name="fill-rectangle">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-fill buttons-round {{ $profile->layout_type == 'background' && $profile->custom_button == 'fill-round' ? 'active' : '' }}" data-name="fill-round">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-fill buttons-circle {{ $profile->layout_type == 'background' && $profile->custom_button == 'fill-circle' ? 'active' : '' }}" data-name="fill-circle">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="buttons-heading">Outline</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-outline buttons-rectangle {{ $profile->layout_type == 'background' && $profile->custom_button == 'outline-rectangle' ? 'active' : '' }}" data-name="outline-rectangle">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-outline buttons-round {{ $profile->layout_type == 'background' && $profile->custom_button == 'outline-round' ? 'active' : '' }}" data-name="outline-round">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-outline buttons-circle {{ $profile->layout_type == 'background' && $profile->custom_button == 'outline-circle' ? 'active' : '' }}" data-name="outline-circle">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="buttons-heading">Dark Shadow</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-dark-shadow buttons-rectangle {{ $profile->layout_type == 'background' && $profile->custom_button == 'dark-shadow-rectangle' ? 'active' : '' }}" data-name="dark-shadow-rectangle" data-type="shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-dark-shadow buttons-round {{ $profile->layout_type == 'background' && $profile->custom_button == 'dark-shadow-round' ? 'active' : '' }}" data-name="dark-shadow-round" data-type="shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-dark-shadow buttons-circle {{ $profile->layout_type == 'background' && $profile->custom_button == 'dark-shadow-circle' ? 'active' : '' }}" data-name="dark-shadow-circle" data-type="shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="buttons-heading">Light Shadow</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-light-shadow buttons-rectangle {{ $profile->layout_type == 'background' && $profile->custom_button == 'light-shadow-rectangle' ? 'active' : '' }}" data-name="light-shadow-rectangle" data-type="shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-light-shadow buttons-round {{ $profile->layout_type == 'background' && $profile->custom_button == 'light-shadow-round' ? 'active' : '' }}" data-name="light-shadow-round" data-type="shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
            <div class="buttons buttons-light-shadow buttons-circle {{ $profile->layout_type == 'background' && $profile->custom_button == 'light-shadow-circle' ? 'active' : '' }}" data-name="light-shadow-circle" data-type="shadow">
                <span class="active-banner">
                    <i class="fad fa-check-circle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="buttons-options">
                <div class="buttons-color me-4">
                    <div class="buttons-heading">Button Color</div>
                    <div class="colorpicker">
                        <label class="buttoncolordisplay" for="button-background-color" style="background-color: {{ $profile->button_background_color }};">
                            <input type="color" class="buttoncolorchanger" id="button-background-color" style="visibility: hidden; z-index: -1">
                        </label>
                        <input type="text" class="buttoncolorinput" value="{{ $profile->button_background_color }}" name="button_background_color" autocomplete="off">
                    </div>
                </div>
                <div class="buttons-font-color me-4">
                    <div class="buttons-heading">Button Font Color</div>
                    <div class="colorpicker">
                        <label class="buttoncolordisplay" for="button-font-color" style="background-color: {{ $profile->button_font_color }};">
                            <input type="color" class="buttoncolorchanger" id="button-font-color" style="visibility: hidden; z-index: -1">
                        </label>
                        <input type="text" class="buttoncolorinput" value="{{ $profile->button_font_color }}" name="button_font_color" autocomplete="off">
                    </div>
                </div>
                <div class="buttons-shadow-color me-4" style="display: none;">
                    <div class="buttons-heading">Shadow Color</div>
                    <div class="colorpicker">
                        <label class="buttoncolordisplay" for="button-shadow-color" style="background-color: {{ $profile->button_shadow_color }};">
                            <input type="color" class="buttoncolorchanger" id="button-shadow-color" style="visibility: hidden; z-index: -1">
                        </label>
                        <input type="text" class="buttoncolorinput" value="{{ $profile->button_shadow_color }}" name="button_shadow_color" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
