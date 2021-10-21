<div class="link">
    <div class="link-inner d-flex" data-position="{{ $link->position }}" data-id="{{ $link->id }}">
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
                <span class="flex-1 action-handle" data-action="thumbnail"><i data-feather="image"></i></span>
                <span class="flex-2 action-handle" data-action="priority"><i data-feather="star"></i></span>
                <span class="flex-3 action-handle" data-action="schedule"><i data-feather="calendar"></i></span>
                <span class="flex-4 action-handle" data-action="gate"><i data-feather="lock"></i></span>
                <span class="flex-5 action-handle" data-action="analytics"><i data-feather="bar-chart-2"></i></span>
                <span class="flex-6 action-handle ms-auto" data-action="delete"><i data-feather="trash"></i></span>
            </div>
        </div>
    </div>
    <div class="action">
        <div class="action-header d-flex">
            <span class="action-close ms-auto cursor-pointer"><i data-feather="x"></i></span>
        </div>
        <div class="action-inner link-thumbnail">
            <div class="thumbnail-notset">
                <p class="text-center">Add Icon or Thumbnail to your link.</p>
                <button type="button" class="btn-action link-thumbnail-btn">Add thumbnail</button>
            </div>
            <div class="thumbnail-set" style="display:none;">
                <div class="thumb-image">
                    <img src="" class="thumb" alt="Thumb">
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
                <div class="animator flash-holder">
                    <button type="button" class="link-priority-btn" data-animate="flash">Flash</button>
                </div>
                <div class="animator tada-holder">
                    <button type="button" class="link-priority-btn" data-animate="tada">Tada</button>
                </div>
                <div class="animator jello-holder">
                    <button type="button" class="link-priority-btn" data-animate="jello">Jello</button>
                </div>
                <div class="animator heartBeat-holder">
                    <button type="button" class="link-priority-btn" data-animate="heartBeat">Beat</button>
                </div>
            </div>
        </div>
        <div class="action-inner link-schedule">
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
        </div>
        <div class="action-inner link-delete">
            <p class="text-center">Are you sure you want to permanently delete this link?</p>
            <button type="button" data-id="{{ $link->id }}" class="btn-action link-delete-btn">Delete</button>
        </div>
    </div>
</div>
