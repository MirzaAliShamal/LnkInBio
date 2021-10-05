const csrf = document.head.querySelector('meta[name="csrf_token"]').content;
const baseurl = document.head.querySelector('meta[name="baseurl"]').content;
const linkurl = baseurl+"/dashboard/links";


function arrangeAble() {
    $(".link-single").arrangeable({
        dragSelector: '.link-handle',
        dragEndEvent: 'dragend',
    });
}

function sortableAble() {
    var el = document.getElementById('link-container');
    var sortable = Sortable.create(el, {
        handle: '.link-handle',
        onEnd: function(evt) {
            refreshPosition();
        }
    });
}




function updateLinksCount() {
    let cl = $(".link-single").length;
    $(".btn-new-link").attr('data-count', cl);
}

function reloadIframe() {
    $( '#link_preview_iframe' ).attr( 'src', function ( i, val ) { return val; });
}

function refreshPosition() {
    $($(".link-single").get().reverse()).each(function (index, element) {
        $(element).attr('data-position', index+1);
    });

    saveUpdatedPosition();
}

function saveUpdatedPosition() {
    let arr = [];
    let cls = $(".link-single").length;
    $(document).find(".link-single").each(function (index, el) {

        let data = {};
        data.id = $(el).data('id');
        data.position = $(el).data('position');
        arr.push(data);
        // console.log($(el).data('position') + " " + $(el).data('id'));

        // $.ajax({
        //     type: "POST",
        //     url: linkurl+"/save",
        //     data: {
        //         _token: csrf,
        //         id: $(el).data('id'),
        //         position: $(el).data('position'),
        //     },
        //     success: function (response) {
        //         cls--;
        //         console.log(response);
        //         if (cls == 0) {
        //             reloadIframe();
        //         }
        //         // reloadIframe();
        //     }
        // });
    });
    console.log(arr);
}

$(document).ready(function () {

    // Feather Icons
    feather.replace()

    // Link Draggable
    // arrangeAble();
    sortableAble();

});

// Add New link
$(document).on("click", ".btn-new-link", function(e) {
    e.preventDefault();
    let elm = $(this);
    let text = elm.html();
    let url = elm.data('url');
    let count = $(".link-single").length;
    elm.html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    elm.prop('disabled', true);
    $.ajax({
        type: "GET",
        url: url,
        data: {
            serial : Number(count) + 1,
        },
        success: function (response) {
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
    parent.find("."+selector).html(elm.val());
});

$(document).on("blur", ".editable .title-input", function(e) {
    e.preventDefault();
    let elm = $(this);
    let id = elm.closest('.link-single').data('id');
    elm.addClass('d-none');
    elm.next('p').removeClass('d-none');
    $.ajax({
        type: "POST",
        url: linkurl+"/save",
        data: {
            _token: csrf,
            id: id,
            title: elm.val(),
        },
        success: function (response) {
            console.log(response);
            reloadIframe();
        }
    });
});

$(document).on("blur", ".editable .url-input", function(e) {
    e.preventDefault();
    let elm = $(this);
    let val = elm.val();
    let id = elm.closest('.link-single').data('id');
    let parent = elm.parent();
    let selector = elm.data('target');
    if (val.indexOf("http://") != 0 && val.indexOf("https://") != 0) {
        val = "http://"+val;
    }
    parent.find("."+selector).html(val);
    elm.val(val);
    elm.addClass('d-none');
    elm.next('p').removeClass('d-none');
    $.ajax({
        type: "POST",
        url: linkurl+"/save",
        data: {
            _token: csrf,
            id: id,
            link: val,
        },
        success: function (response) {
            console.log(response);
            reloadIframe();
        }
    });
});


