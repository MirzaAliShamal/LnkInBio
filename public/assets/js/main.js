const csrf = document.head.querySelector('meta[name="csrf_token"]').content;
const baseurl = document.head.querySelector('meta[name="baseurl"]').content;
const iconurl = baseurl + "/assets/icons/tabler-icons";
const linkurl = baseurl + "/dashboard/links";
const ajaxurl = baseurl + "/ajax";

// Tabler Icon Upload
if ($(".choose-tabler-icons").length > 0) {
    const tsbi = document.querySelector("div.tabler-search-bar input");
	const tic = document.querySelector("div.tabler-box div.tabler-icons");
    let ti = [];

    document.querySelectorAll("div.tabler-icon").forEach(icon => ti.push({
		el : icon,
		name : icon.querySelector('strong').innerHTML,
	}));

    tsbi.addEventListener('input', searchTi);

    function searchTi(evt){
		let searchValue = evt.target.value;
		let iconsToShow = searchValue.length ? ti.filter(icon => icon.name.includes(searchValue)) : ti;
		tic.innerHTML = "";
		iconsToShow.forEach(icon => tic.appendChild(icon.el));
	}
}


var pium, piumEl, tum, tumEl;
var uploadCrop, tempFileName, rawImg, imageId;
var refLinkId;

if ($("#profileImageUploadModal").length > 0) {
    pium = new bootstrap.Modal(document.getElementById('profileImageUploadModal'), { keyboard: false });
    piumEl = document.getElementById('profileImageUploadModal');
}

if ($("#thumbnailUploadModal").length > 0) {
    tum = new bootstrap.Modal(document.getElementById('thumbnailUploadModal'), { keyboard: false });
    tumEl = document.getElementById('thumbnailUploadModal');
}

uploadCrop = $('#upload-demo').croppie({
    viewport: {
        width: 250,
        height: 250,
    },
    boundry: {
        width: 250,
        height: 250,
    },
    enforceBoundary: false,
    enableExif: true,
    enableResize: true,
    enableOrientation: true,
});

function readFile(i, m) {
    if (i.files && i.files[0]) {
      var reader = new FileReader();
        reader.onload = function (e) {
            $("#upload-demo").addClass('ready');
            rawImg = e.target.result;

            m.show();

            uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function(){
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(i.files[0]);
    }
    else {
        alert("Sorry - you're browser doesn't support the FileReader API");
    }
}

function arrangeAble() {
    $(".link-inner").arrangeable({
        dragSelector: '.link-handle',
        dragEndEvent: 'dragend',
    });
}

function sortableAble() {

    if ($("#link-container").length > 0) {
        var el = document.getElementById('link-container');
        var sortable = Sortable.create(el, {
            handle: '.link-handle',
            onEnd: function(evt) {
                refreshPosition();
            }
        });
    }
}

function updateLinksCount() {
    let cl = $(".link-inner").length;
    $(".btn-new-link").attr('data-count', cl);
}

function reloadIframe() {
    $('#link_preview_iframe').attr('src', function(i, val) { return val; });
}

function refreshPosition() {
    $($(".link-inner").get().reverse()).each(function(index, element) {
        // $(element).attr('data-position', index + 1);
        $(element).data('position', index + 1);
    });

    saveUpdatedPosition();
}

function saveUpdatedPosition() {
    // let arr = [];
    let cls = $(".link-inner").length;
    $(document).find(".link-inner").each(function(index, el) {

        $.ajax({
            type: "POST",
            url: linkurl + "/save",
            data: {
                _token: csrf,
                id: $(el).data('id'),
                position: $(el).data('position'),
            },
            success: function(response) {
                cls--;
                console.log(response);
                if (cls == 0) {
                    reloadIframe();
                }
            }
        });
    });
    // console.log(arr);
}

$(document).ready(function() {

    // Feather Icons
    feather.replace();

    // Link Draggable
    sortableAble();

});

// Add New link
$(document).on("click", ".btn-new-link", function(e) {
    e.preventDefault();
    let elm = $(this);
    let text = elm.html();
    let url = elm.data('url');
    let count = $(".link-inner").length;
    elm.html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    elm.prop('disabled', true);
    $.ajax({
        type: "GET",
        url: url,
        data: {
            serial: Number(count) + 1,
        },
        success: function(response) {
            elm.html(text);
            elm.prop('disabled', false);
            if (response.statusCode == 200) {
                $(response.html).hide().prependTo(".link-container").slideDown(100);
                // arrangeAble();
                sortableAble();
                feather.replace();
                updateLinksCount();
            }
        }
    });
});

// Fields Editable
$(document).on("click", ".editable", function(e) {
    e.preventDefault();
    let elm = $(this);
    elm.find("input").removeClass('d-none');
    elm.find("p").addClass('d-none');
    elm.find("input").focus();
});

$(document).on("keyup", ".editable input", function(e) {
    e.preventDefault();
    let elm = $(this);
    let parent = elm.parent();
    let selector = elm.data('target');
    parent.find("." + selector).html(elm.val());
});

$(document).on("blur", ".editable .title-input", function(e) {
    e.preventDefault();
    let elm = $(this);
    let id = elm.closest('.link-inner').data('id');
    elm.addClass('d-none');
    elm.next('p').removeClass('d-none');
    $.ajax({
        type: "POST",
        url: linkurl + "/save",
        data: {
            _token: csrf,
            id: id,
            title: elm.val(),
        },
        success: function(response) {
            console.log(response);
            reloadIframe();
        }
    });
});

$(document).on("blur", ".editable .url-input", function(e) {
    e.preventDefault();
    let elm = $(this);
    let val = elm.val();
    let id = elm.closest('.link-inner').data('id');
    let parent = elm.parent();
    let selector = elm.data('target');
    if (val.indexOf("http://") != 0 && val.indexOf("https://") != 0) {
        val = "http://" + val;
    }
    parent.find("." + selector).html(val);
    elm.val(val);
    elm.addClass('d-none');
    elm.next('p').removeClass('d-none');
    $.ajax({
        type: "POST",
        url: linkurl + "/save",
        data: {
            _token: csrf,
            id: id,
            link: val,
        },
        success: function(response) {
            console.log(response);
            reloadIframe();
        }
    });
});

// Link Actions
$(document).on("click", ".action-handle", function(e) {
    e.preventDefault();
    let elm = $(this);
    let action = elm.data('action');
    let parent = elm.closest('.link');
    parent.find('.link-footer span').removeClass('action-close');
    elm.addClass('action-close');

    $('.action-inner').hide();
    $('.link-'+action).show();
    parent.find('.action').slideDown();
});

$(document).on("click", ".action-close", function(e) {
    e.preventDefault();
    let elm = $(this);
    let parent = elm.closest('.link');
    parent.find('.link-footer span').removeClass('action-close');

    parent.find('.action-inner').fadeOut();
    parent.find('.action').slideUp();
});

$(document).on("click", ".link-delete-btn", function(e) {
    e.preventDefault();
    let elm = $(this);
    let id = elm.data('id');
    elm.closest('.link').remove();
    $.ajax({
        type: "GET",
        url: ajaxurl+"/delete-link/"+id,
        success: function (response) {
            console.log(response);
            reloadIframe();
        }
    });
});

$(document).on("click", ".link-thumbnail-btn", function(e) {
    e.preventDefault();
    let elm = $(this);
    refLinkId = elm.closest(".action").data("id");
    $(".thumbnail-wrappers").hide();
    $(".choice-wrapper").show();
    tum.show();

});

$(document).on("click", ".link-thumbnail-remove", function(e) {
    e.preventDefault();
    let elm = $(this);
    refLinkId = elm.closest(".action").data("id");

    $("div.action[data-id='"+refLinkId+"']").find('.thumb').attr('src', '');
    $("div.action[data-id='"+refLinkId+"']").find('.thumbnail-notset').show();
    $("div.action[data-id='"+refLinkId+"']").find('.thumbnail-set').hide();
    $('span[data-action="thumbnail"]').removeClass('active');

    $.ajax({
        type: "POST",
        url: ajaxurl+"/remove-link-image",
        data: {
            _token : csrf,
            id: refLinkId,
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
});

$(document).on("click", ".link-priority-btn", function(e) {
    let elm = $(this);
    let id = elm.closest('.action').data("id");
    let animation = elm.data("animate");

    $('.animator').removeClass("flash");
    $('.animator').removeClass("tada");
    $('.animator').removeClass("jello");
    $('.animator').removeClass("heartBeat");
    elm.closest('.animator').removeClass(animation+"-holder");
    elm.closest('.animator').addClass(animation);

    if (animation == "none") {
        $('span[data-action="priority"]').removeClass('active');
    } else {
        $('span[data-action="priority"]').addClass('active');
    }

    $.ajax({
        type: "POST",
        url: ajaxurl+"/link-priority",
        data: {
            _token : csrf,
            id: id,
            animation: animation,
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
});

$(document).on("change", ".thumbnail-uploader", function(e) {
    imageId = $(this).data('id');
    tempFileName = $(this).val();
    $('#cancelCropBtn').data('id', imageId);
    $(".thumbnail-wrappers").hide();
    readFile(this, $(".upload-own-thumbnail"));
});

$(document).on("click", ".upload-own", function(e) {
    $("#upload-thumbnail").trigger('click');
});

$(document).on("click", ".choose-tabler", function(e) {
    $(".thumbnail-wrappers").hide();
    $(".choose-tabler-icons").show();
});

$(document).on("click", ".tabler-icon", function(e) {
    let elm = $(this);
    $(".tabler-icon").removeClass("active");
    elm.addClass("active");
    let icon = elm.find("strong").text();

    $.ajax({
        type: "POST",
        url: ajaxurl+"/upload-link-image",
        data: {
            _token : csrf,
            id: refLinkId,
            icon : icon,
            type : "icon",
        },
        success: function (response) {
            if (response.statusCode == 200) {
                $("div.action[data-id='"+refLinkId+"']").find('.thumb').attr('src', iconurl+"/"+icon+".svg");
                $("div.action[data-id='"+refLinkId+"']").find('.thumbnail-notset').hide();
                $("div.action[data-id='"+refLinkId+"']").find('.thumbnail-set').show();
                $('span[data-action="thumbnail"]').addClass('active');
                tum.hide();
                reloadIframe();
            }
        }
    });
});

$(document).on("change", ".image-uploader", function(e) {
    imageId = $(this).data('id');
    tempFileName = $(this).val();
    $('#cancelCropBtn').data('id', imageId);
    readFile(this, pium);
});

$(document).on("click", ".upload-profile", function(e) {
    $("#upload-avatar").trigger('click');
});

$(document).on("click", ".upload-image-btn", function(e) {
    var btn = $(this);

    if (btn.data("purpose") == "profile") {
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...');

        uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            // size: {width: 250, height: 250}
        }).then(function (resp) {
            $.ajax({
                type: "POST",
                url: ajaxurl+"/upload-avatar",
                data: {
                    _token : csrf,
                    avatar : resp,
                },
                success: function (response) {
                    if (response.statusCode == 200) {
                        $('.profile-image img').attr('src', resp);
                        pium.hide();
                        reloadIframe();
                        btn.html('Upload');
                        btn.prop('disabled', false);
                    }
                }
            });
        });
    }

    if (btn.data("purpose") == "thumbnail") {
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...');

        // Need to add alert here
        if (refLinkId == "" || refLinkId == undefined) {
            return false;
        }

        uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            // size: {width: 250, height: 250}
        }).then(function (resp) {
            $.ajax({
                type: "POST",
                url: ajaxurl+"/upload-link-image",
                data: {
                    _token : csrf,
                    id: refLinkId,
                    image : resp,
                    type : "thumb",
                },
                success: function (response) {
                    if (response.statusCode == 200) {
                        $("div.action[data-id='"+refLinkId+"']").find('.thumb').attr('src', resp);
                        $("div.action[data-id='"+refLinkId+"']").find('.thumbnail-notset').hide();
                        $("div.action[data-id='"+refLinkId+"']").find('.thumbnail-set').show();
                        $('span[data-action="thumbnail"]').addClass('active');
                        tum.hide();
                        reloadIframe();
                        btn.html('Upload');
                        btn.prop('disabled', false);
                    }
                }
            });
        });
    }
});

$(document).on("click", ".remove-profile", function(e) {
    var btn = $(this);

    $.ajax({
        type: "GET",
        url: ajaxurl+"/remove-avatar",
        success: function (response) {
            if (response.statusCode == 200) {
                $('.profile-image img').attr('src', response.image);
                reloadIframe();
            }
        }
    });
});

// Update Bio
$(document).on("blur", ".profile-name", function(e) {
    e.preventDefault();
    let elm = $(this);

    $.ajax({
        type: "POST",
        url: ajaxurl+"/update-profile",
        data: {
            _token : csrf,
            title : elm.val(),
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
});

$(document).on("blur", ".profile-bio", function(e) {
    e.preventDefault();
    let elm = $(this);

    $.ajax({
        type: "POST",
        url: ajaxurl+"/update-profile",
        data: {
            _token : csrf,
            bio : elm.val(),
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
});
