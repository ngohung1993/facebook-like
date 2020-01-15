var check_uid = function () {
    var uid = $('#uid-facebook').val();

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

                        if (response) {
                            $('.error-check').css('display', 'none');

                            var link_or_uid = $('.link-or-uid');

                            link_or_uid.text(uid);
                            link_or_uid.attr('href', uid);

                            $('.uid-result').text(response['id']);
                            $('.name-result').text(response['name']);

                            $('.step-1').css('display', 'none');
                            $('.step-2').css('display', 'block');

                            $('html,body').animate({
                                scrollTop: 0
                            }, 700);
                        }
                        else {
                            $('.error-check').css('display', 'block');
                        }
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

                if (response) {
                    $('.form-detail').css('display', 'block');
                    $('.error-check').css('display', 'none');
                }
                else {
                    $('.form-detail').css('display', 'none');
                    $('.error-check').css('display', 'block');
                }

                loading_search.css('display', 'none');

                var link_or_uid = $('.link-or-uid');

                link_or_uid.text(uid);
                link_or_uid.attr('href', uid);

                $('#uid-facebook-2').val(uid);

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

var subscribe_total_slider = $('#subscribe-total-slider');

subscribe_total_slider.slider({
    tooltip: 'always'
});

$("#subscribe-total").val(20);

subscribe_total_slider.on("slide", function (event) {
    var price = $('.price');

    $("#subscribe-total").val(event.value);

    price.text((event.value * price.attr('data-price')).toLocaleString());
    price.attr('data-total', event.value * price.attr('data-price'));
});

var speed_slider = $('#speed-slider');

speed_slider.slider({
    tooltip: 'always'
});

$("#speed").val(5);

speed_slider.on("slide", function (event) {
    $("#speed").val(event.value);
});

var load = function () {
    $('#buffsub-uid').val($('.uid-result').text());
};

var check_out = function () {
    var account_balance = $('.account-balance').attr('data-value');
    var price = $('.price').attr('data-total');

    if (parseInt(account_balance) < parseInt(price)) {
        $('.not-enough-money').css('display', 'block');
    }
    else {
        $('.not-enough-money').css('display', 'none');

        $('#buffsub-uid').val($('.uid-result').text());
    }
};

var valid_url = function (str) {
    var regular_expression = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    return regular_expression.test(str);
};