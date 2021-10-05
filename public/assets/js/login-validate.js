function emailValidate(elm) {
    const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let val = elm.val();

    if (regex.test(val)) {
        elm.parent('div').removeClass('not-valid');
        elm.removeClass('is-invalid');
    } else {
        elm.parent('div').addClass('not-valid');
        elm.addClass('is-invalid');
        if (val == "" || val == undefined) {
            elm.parent('div').find('.invalid-feedback').html('<strong><small>Please fill out your Email</small></strong>');
        } else {
            elm.parent('div').find('.invalid-feedback').html('<strong><small>Invalid Email! Must be a valid email address</small></strong>');
        }
    }
}

function passwordValidate(elm) {
    let val = elm.val();

    if (val == "" || val == undefined) {
        elm.parent('div').addClass('not-valid');
        elm.addClass('is-invalid');
        elm.parent('div').find('.invalid-feedback').html('<strong><small>Please fill out your Password</small></strong>');
    } else {
        elm.parent('div').removeClass('not-valid');
        elm.removeClass('is-invalid');
    }
}

function submitHandle() {
    if ($(".not-valid").length > 0) {
        $(".btn-login").prop('disabled', true);
    } else {
        $(".btn-login").prop('disabled', false);
    }
}

$(document).on("blur", "input", function(e) {
    e.preventDefault();
    let elm = $(this);
    if (elm.attr('name') == 'email') {
        emailValidate(elm);
    }
    if (elm.attr('name') == 'password') {
        passwordValidate(elm);
    }

    submitHandle();
});
