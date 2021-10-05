<div class="link-single d-flex" data-position="{{ $link->position }}" data-id="{{ $link->id }}">
    <div class="link-handle">
        <i class="fal fa-bars"></i>
    </div>
    <div class="link-main">
        <div class="link-top d-flex">
            <div class="link-detail w-100">
                <div class="title editable">
                    <input type="text" class="title-input d-none" data-target="title-text" value="" autocomplete="off">
                    <p><span class="title-text">Title</span> <span><i class="fad fa-pencil-alt"></i></span></p>
                </div>
                <div class="url editable">
                    <input type="text" class="url-input d-none" data-target="url-text" value="" autocomplete="off">
                    <p><span class="url-text">Url</span> <span><i class="fad fa-pencil-alt"></i></span></p>
                </div>
            </div>
            <div class="link-switcher">
                <div class="form-check form-switch">
                    <input class="form-check-input ms-0" type="checkbox" id="link-switcher-{{ $link->position }}" checked>
                    <label class="form-check-label" for="link-switcher-{{ $link->position }}"></label>
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
