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

function getComplementryGradientColor() {
    let colorOne = $("[name='background_color_one']").val();
    let colorTwo = tinycolor(colorOne).analogous()[1].toHexString();

    $("[name='background_color_two']").val(colorTwo);
}

function saveBackgroundLayout() {
    $.ajax({
        type: "POST",
        url: ajaxurl+"/appearance-layout",
        data: {
            _token : csrf,
            type: "background",
            background: $(".background-thumb.active").data('name'),
            background_color_one: $("[name='background_color_one']").val(),
            background_color_two: $("[name='background_color_two']").val(),
            direction: $("[name='direction']:checked").val(),
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
}

function saveButtonsLayout() {
    $.ajax({
        type: "POST",
        url: ajaxurl+"/buttons-layout",
        data: {
            _token : csrf,
            custom_button: $(".buttons.active").data('name'),
            button_background_color: $("[name='button_background_color']").val(),
            button_font_color: $("[name='button_font_color']").val(),
            button_shadow_color: $("[name='button_shadow_color']").val(),
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
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
        }).then(function (resp) {
            $.ajax({
                type: "POST",
                url: ajaxurl+"/upload-link-image",
                data: {
                    _token : csrf,
                    id: refLinkId,
                    image : resp,
                    type : "image",
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

$(document).on("change", "#hide_logo", function(e) {
    let hide_logo;
    if ($(this).is(":checked")) {
        hide_logo = 1;
    } else {
        hide_logo = 0;
    }

    $.ajax({
        type: "POST",
        url: ajaxurl+"/hide-logo",
        data: {
            _token : csrf,
            hide_logo: hide_logo,
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
});

// Appearance
$(document).on("click", ".theme-thumb", function(e) {
    let elm = $(this);

    $(".theme-thumb").removeClass('active');
    elm.addClass('active');

    $.ajax({
        type: "POST",
        url: ajaxurl+"/appearance-layout",
        data: {
            _token : csrf,
            name: elm.data('name'),
            type: "theme",
        },
        success: function (response) {
            if (response.statusCode == 200) {
                reloadIframe();
            }
        }
    });
});
$(document).on("click", ".background-thumb", function(e) {
    let elm = $(this);

    $(".background-thumb").removeClass('active');
    if (elm.data('name') == 'flat') {
        $(".background-gradient").hide();
        elm.addClass('active');
    }
    if (elm.data('name') == 'gradient') {
        $(".background-gradient").show();
        getComplementryGradientColor();
        elm.addClass('active');
    }
    if (elm.data('name') == 'image') {
        $(".background-gradient").hide();
        elm.addClass('active');
    }

    saveBackgroundLayout();
});
$(document).on("change", "#colordisplay", function(e) {
    let elm = $(this);
    let color = elm.val();

    $(".colorinput").val(color);
    $(".colordisplay").css('background-color', color);
    getComplementryGradientColor();
    saveBackgroundLayout();
});
$(document).on("change", "[name='direction']", function(e) {
    saveBackgroundLayout();
});
$(document).on("keyup", ".colorinput", function(e) {
    let elm = $(this);
    let color = elm.val();

    if (color.indexOf('#') == -1) {
        elm.val("#"+color);
    }

    if (color.length == 7) {
        elm.removeClass('error-field');

        $("#colordisplay").val(color).change();
        getComplementryGradientColor();
        saveBackgroundLayout();
    } else {
        elm.addClass('error-field');
    }
});
$(document).on("click", ".buttons", function(e) {
    let elm = $(this);

    $(".buttons").removeClass('active');
    if (elm.data('type') == 'shadow') {
        $(".buttons-shadow-color").show();
        elm.addClass('active');
    } else {
        $(".buttons-shadow-color").hide();
        elm.addClass('active');
    }

    saveButtonsLayout();
});
$(document).on("change", ".buttoncolorchanger", function(e) {
    let elm = $(this);
    let parent = elm.closest('.colorpicker');
    let color = elm.val();

    parent.find(".buttoncolorinput").val(color);
    parent.find(".buttoncolordisplay").css('background-color', color);
    saveButtonsLayout();
});
$(document).on("keyup", ".buttoncolorinput", function(e) {
    let elm = $(this);
    let parent = elm.closest('.colorpicker');
    let color = elm.val();

    if (color.indexOf('#') == -1) {
        elm.val("#"+color);
    }

    if (color.length == 7) {
        elm.removeClass('error-field');

        parent.find(".buttoncolorchanger").val(color).change();
        saveButtonsLayout();
    } else {
        elm.addClass('error-field');
    }
});
