@extends('layouts.app')

@section('title', 'Links')

@section('content')
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
                <div class="link">
                    <div class="link-inner d-flex" data-position="{{ $item->position }}" data-id="{{ $item->id }}">
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
                                <span class="flex-1 action-handle {{ is_null($item->image) ? '' : 'active' }}" data-action="thumbnail"><i data-feather="image"></i></span>
                                <span class="flex-2 action-handle {{ $item->animation != "none" && !is_null($item->animation) ? 'active' : '' }}" data-action="priority"><i data-feather="star"></i></span>
                                {{-- <span class="flex-3 action-handle" data-action="schedule"><i data-feather="calendar"></i></span>
                                <span class="flex-4 action-handle" data-action="gate"><i data-feather="lock"></i></span>
                                <span class="flex-5 action-handle" data-action="analytics"><i data-feather="bar-chart-2"></i></span> --}}
                                <span class="flex-6 action-handle ms-auto" data-action="delete"><i data-feather="trash"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="action" data-id="{{ $item->id }}">
                        <div class="action-header d-flex">
                            <span class="action-close ms-auto cursor-pointer"><i data-feather="x"></i></span>
                        </div>
                        <div class="action-inner link-thumbnail">
                            <div class="thumbnail-notset" style="{{ is_null($item->image) ? 'display:block;' : 'display:none;' }}">
                                <p class="text-center">Add Icon or Thumbnail to your link.</p>
                                <button type="button" class="btn-action link-thumbnail-btn">Add thumbnail</button>
                            </div>
                            <div class="thumbnail-set" style="{{ is_null($item->image) ? 'display:none;' : 'display:flex;' }}">
                                <div class="thumb-image">
                                    <img src="{{ asset($item->image) }}" class="thumb" alt="Thumb">
                                </div>
                                <div class="thumb-action m-auto text-end">
                                    <button class="btn btn-primary link-thumbnail-btn w-45">Change</button>
                                    <button class="btn btn-secondary link-thumbnail-remove w-45">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="action-inner link-priority">
                            <div class="priority-inner">
                                <div class="animator">
                                    <button type="button" class="link-priority-btn" data-animate="none">None</button>
                                </div>
                                <div class="animator {{ $item->animation == "flash" ? 'flash' : 'flash-holder' }}">
                                    <button type="button" class="link-priority-btn" data-animate="flash">Flash</button>
                                </div>
                                <div class="animator {{ $item->animation == "tada" ? 'flash' : 'tada-holder' }}">
                                    <button type="button" class="link-priority-btn" data-animate="tada">Tada</button>
                                </div>
                                <div class="animator {{ $item->animation == "jello" ? 'jello' : 'jello-holder' }}">
                                    <button type="button" class="link-priority-btn" data-animate="jello">Jello</button>
                                </div>
                                <div class="animator {{ $item->animation == "heartBeat" ? 'heartBeat' : 'heartBeat-holder' }}">
                                    <button type="button" class="link-priority-btn" data-animate="heartBeat">Beat</button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="action-inner link-schedule">
                            <p class="text-center">With LnkInBio PRO you can schedule when your links go live.</p>
                            <button type="button" class="btn-action">Find Out More</button>
                        </div>
                        <div class="action-inner link-gate">
                            <p class="text-center">With LnkInBio PRO you can lock your link.</p>
                            <button type="button" class="btn-action">Find Out More</button>
                        </div>
                        <div class="action-inner link-analytics">
                            <p class="text-center">This link has been clicked 0 times. <br> Detailed analytics available in LnkInBio PRO</p>
                            <button type="button" class="btn-action">Find Out More</button>
                        </div> --}}
                        <div class="action-inner link-delete">
                            <p class="text-center">Are you sure you want to permanently delete this link?</p>
                            <button type="button" data-id="{{ $item->id }}" class="btn-action link-delete-btn">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="image-upload-modal">
    <div class="modal" id="thumbnailUploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="thumbnailUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="thumbnailUploadModalLabel">Add Thumbnail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="choice-wrapper thumbnail-wrappers">
                    <div class="modal-body">
                        <input type="file" name="thumbnail" id="upload-thumbnail" class="thumbnail-uploader" hidden>
                        <div class="choice upload-own">
                            <i data-feather="upload"></i>
                            <p>Upload thumbnail</p>
                        </div>
                        <div class="choice choose-tabler">
                            <i data-feather="anchor"></i>
                            <p>Choose Tabler Icons</p>
                        </div>
                    </div>
                </div>
                <div class="upload-own-thumbnail thumbnail-wrappers" style="display: none;">
                    <div class="modal-body">
                        <div id="upload-demo"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary upload-image-btn ms-auto" data-purpose="thumbnail">Upload</button>
                    </div>
                </div>
                <div class="choose-tabler-icons thumbnail-wrappers" style="display: none;">
                    <div class="modal-body">
                        @include('components.tabler-icons')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
