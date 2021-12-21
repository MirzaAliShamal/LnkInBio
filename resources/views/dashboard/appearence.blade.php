@extends('layouts.app')

@section('title', 'Appearance')

@section('content')
<div class="page-heading">
    <h3>Apperance</h3>
</div>

<div class="page-content">
    <div class="page-inner">
        <div class="profile">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="profile-image">
                        <img src="{{ asset(auth()->user()->avatar) }}" class="img-fluid" alt="Profile Image">
                    </div>

                    <div class="profile-button">
                        <input type="file" name="avatar" id="upload-avatar" class="image-uploader" hidden>
                        <button type="button" class="upload-profile">Upload</button>
                        <button type="button" class="remove-profile">Remove</button>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div class="profile-detail">
                        <label for="profile_name">Profile Name</label>
                        <input type="text" id="profile_name" class="profile-name" name="profile_name" value="{{ profile()->title }}" placeholder="{{ '@'.profile()->title }}" autocomplete="off">
                        <div class="mt-3"></div>
                        <label for="profile_bio">Bio</label>
                        <textarea name="profile_bio" id="profile_bio" class="profile-bio" placeholder="Fill out your bio">{{ profile()->bio }}</textarea>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="hide_logo">
                            Hide the LnkInBio logo
                        </label>
                        <input class="form-check-input" type="checkbox" id="hide_logo" name="hide_logo" {{ $profile->hide_logo ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
        </div>

        <div class="appearence-nav">
            <ul>
                <li><a href="{{ route('dashboard.appearence.list', 'themes') }}" class="{{ $page == 'themes' ? 'active' : 'inactive' }}">Themes</a></li>
                <li><a href="{{ route('dashboard.appearence.list', 'backgrounds') }}" class="{{ $page == 'backgrounds' ? 'active' : 'inactive' }}">Background</a></li>
                <li><a href="{{ route('dashboard.appearence.list', 'buttons') }}" class="{{ $page == 'buttons' ? 'active' : 'inactive' }}">Buttons</a></li>
            </ul>
        </div>

        <div class="appearance">
            @yield('appearence-content')
        </div>
    </div>
</div>

<div class="image-upload-modal">
    <div class="modal" id="profileImageUploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="profileImageUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileImageUploadModalLabel">Upload Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="upload-demo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary upload-image-btn ms-auto" data-purpose="profile">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
