var loading_search = $('.loading-search');

var check_post = function () {

    loading_search.css('display', 'block');

    var e = $('#post-id').val();

    var t = "", o = e.match(/[^](fbid=[0-9]{9})\d+/);
    if (null !== o) t = (o[0].replace("?fbid=", "")).replace("_fbid=", ""); else {
        var n = e.match(/[^\/|.!=][0-9]{7,}(?!.*[0-9]{7,})\d+/);
        null !== n && (t = n[0]);
    }

    $.ajax({
        type: 'POST',
        url: 'https://findmyfbid.com',
        data: {
            url: e
        },
        error: function () {
        },
        success: function (response) {

            $.ajax({
                type: 'POST',
                url: server + '/facebook-tool/check-uid',
                data: {
                    uid: response['id'],
                    post_id: t
                },
                error: function () {
                },
                success: function (response) {

                    if (response) {
                        $('.error-check').css('display', 'none');

                        $('.name-result').text(response['name']);
                        $('.post-id-result').text(response['id']);

                        $('.likes').text('likes' in response ? response['likes']['count'] : 0);
                        $('.shares').text('shares' in response ? response['shares']['count'] : 0);
                        $('.comments').text('comments' in response ? response['comments']['count'] : 0);

                        $('.step-1').css('display', 'none');
                        $('.step-2').css('display', 'block');

                        $('html,body').animate({
                            scrollTop: 0
                        }, 700);
                    }
                    else {
                        $('.error-check').css('display', 'block');
                    }

                    loading_search.css('display', 'none');
                }
            });
        }
    });
};