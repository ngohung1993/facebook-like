var loading_search = $('.loading-search');

var check_uid = function () {

    var access_token = $('#access-token');

    var uid = access_token.find(":selected").attr('data-uid');

    $('#access-token-result').val(access_token.find(":selected").val());

    loading_search.css('display', 'block');

    if (valid_url(uid)) {
        $.ajax({
            type: 'POST',
            url: 'https://findmyfbid.com',
            data: {
                url: uid
            },
            error: function () {
            },
            success: function (response) {

                $.ajax({
                    type: 'POST',
                    url: server + '/facebook-tool/check-uid',
                    data: {
                        uid: response['id']
                    },
                    error: function () {
                    },
                    success: function (response) {

                        loading_search.css('display', 'none');

                        $('.uid-result').text(response['id']);
                        $('.name-result').text(response['name']);

                        $('.step-1').css('display', 'none');
                        $('.step-2').css('display', 'block');

                        $('html,body').animate({
                            scrollTop: 0
                        }, 700);
                    }
                });
            }
        });
    }
    else {
        $.ajax({
            type: 'POST',
            url: server + '/facebook-tool/check-uid',
            data: {
                uid: uid
            },
            error: function () {
            },
            success: function (response) {

                loading_search.css('display', 'none');

                $('.uid-result').text(response['id']);
                $('.name-result').text(response['name']);

                $('.step-1').css('display', 'none');
                $('.step-2').css('display', 'block');

                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            }
        });
    }
};

var check_uid_step_2 = function () {
    var uid = $('#uid-facebook-2').val();

    loading_search.css('display', 'block');

    if (valid_url(uid)) {
        $.ajax({
            type: 'POST',
            url: 'https://findmyfbid.com',
            data: {
                url: uid
            },
            error: function () {
            },
            success: function (response) {

                $.ajax({
                    type: 'POST',
                    url: server + '/facebook-tool/check-uid',
                    data: {
                        uid: response['id']
                    },
                    error: function () {
                    },
                    success: function (response) {

                        loading_search.css('display', 'none');

                        $('.uid-result').text(response['id']);
                        $('.name-result').text(response['name']);

                        event.preventDefault();
                    }
                });
            }
        });
    }
    else {
        $.ajax({
            type: 'POST',
            url: server + '/facebook-tool/check-uid',
            data: {
                uid: uid
            },
            error: function () {
            },
            success: function (response) {

                loading_search.css('display', 'none');

                $('.uid-result').text(response['id']);
                $('.name-result').text(response['name']);

                event.preventDefault();
            }
        });
    }
};

var check_out = function () {
    var account_balance = int32($('.account-balance').attr('data-value'));
    var price = int32($('.price').attr('data-total'));

    if (parseInt(account_balance) < parseInt(price)) {
        $('.not-enough-money').css('display', 'block');
    }
    else {
        $('.not-enough-money').css('display', 'none');

        var emotions = [];

        $('.emotion-box').find('input:checked').each(function () {
            emotions.push($(this).val());
        });

        $('#emotions').val(JSON.stringify(emotions));

        $("#bot-emotion-friends").submit();

        $('#uid').val($('.uid-result').text());
    }
};

var payment = function () {
    var months = $('#months').val();

    var price = $('.price');

    price.attr('data-total', price.attr('data-price') * months);
    price.text((price.attr('data-price') * months).toLocaleString());
};

var valid_url = function (str) {
    var regular_expression = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    return regular_expression.test(str);
};

var load = function () {
    $('#uid').val($('.uid-result').text());
};