let baseurl = document.head.querySelector('meta[name="baseurl"]').content;

function nameValidate(elm) {
    const regex = /^[A-Za-z ]+$/;
    let val = elm.val();

    if (regex.test(val)) {
        elm.parent('div').removeClass('not-valid');
        elm.removeClass('is-invalid');
    } else {
        elm.parent('div').addClass('not-valid');
        elm.addClass('is-invalid');
        if (val == "" || val == undefined) {
            elm.parent('div').find('.invalid-feedback').html('<strong><small>Please fill out your Full Name</small></strong>');
        } else {
            elm.parent('div').find('.invalid-feedback').html('<strong><small>Invalid Name! Must be a string</small></strong>');
        }
    }
}

function usernameValidate(elm) {
    let val = elm.val();

    if (val == "" || val == undefined) {
        elm.parent('div').addClass('not-valid');
        elm.addClass('is-invalid');
        elm.parent('div').find('.invalid-feedback').html('<strong><small>Please fill out your Username</small></strong>');
    } else {
        $.ajax({
            type: "GET",
            url: baseurl+"/ajax/username-exists",
            data: {
                name: val,
            },
            success: function (response) {
                if (response.exists) {
                    elm.parent('div').addClass('not-valid');
                    elm.addClass('is-invalid');
                    elm.parent('div').find('.invalid-feedback').html('<strong><small>Username already exists!</small></strong>');
                } else {
                    elm.parent('div').removeClass('not-valid');
                    elm.removeClass('is-invalid');
                }
            }
        });
    }
}

function emailValidate(elm) {
    const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let val = elm.val();

    if (regex.test(val)) {
        elm.parent('div').removeClass('not-valid');
        elm.removeClass('is-invalid');

        $.ajax({
            type: "GET",
            url: baseurl+"/ajax/username-exists",
            data: {
                name: val,
            },
            success: function (response) {
                if (response.exists) {
                    elm.parent('div').addClass('not-valid');
                    elm.addClass('is-invalid');
                    elm.parent('div').find('.invalid-feedback').html('<strong><small>Email already exists!</small></strong>');
                } else {
                    elm.parent('div').removeClass('not-valid');
                    elm.removeClass('is-invalid');
                }
            }
        });
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

function termsValidate(elm) {
    if (elm.is(":checked")) {
        elm.parent('div').removeClass('not-valid');
    } else {
        elm.parent('div').addClass('not-valid');
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
    if (elm.attr('name') == 'name') {
        nameValidate(elm);
    }
    if (elm.attr('name') == 'username') {
        usernameValidate(elm);
    }
    if (elm.attr('name') == 'email') {
        emailValidate(elm);
    }
    if (elm.attr('name') == 'password') {
        passwordValidate(elm);
    }

    submitHandle();
});

$(document).on("blur", "[name='name']", function(e) {
    e.preventDefault();
    let elm = $(this);

    if (elm.val().length > 0) {
        $.ajax({
            type: "GET",
            url: baseurl+"/ajax/validate-username",
            data: {
                name: elm.val(),
            },
            success: function (response) {
                $(".un").slideDown(200);
                if (response.statusCode == 200) {
                    $(".un").find('input').val(response.username);
                    $(".un").removeClass('not-valid');
                }
            }
        });
    }
});

$(document).on("change", "input[name='agree_terms']", function(e) {
    e.preventDefault();
    let elm = $(this);
    termsValidate(elm);

    submitHandle();
});
