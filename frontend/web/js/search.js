var go_to = $('#back-to-top');

if (go_to.length) {
    var scrollTrigger = 100,
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                go_to.css('display', 'block');
            } else {
                go_to.css('display', 'none');
            }
        };

    backToTop();

    $(window).on('scroll', function () {
        backToTop();
    });

    go_to.on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

var loading_search = $('.loading-search');

var array_result = ['uid-post', 'uid-group', 'uid-friend'];

var view_box_result = function (id) {
    for (var i = 0; i < array_result.length; i++) {
        if (array_result[i] === id) {
            $('#' + array_result[i]).css('display', 'block');
        }
        else {
            $('#' + array_result[i]).css('display', 'none');
        }
    }
};

var hidden_box_result = function () {
    for (var i = 0; i < array_result.length; i++) {
        $('#' + array_result[i]).css('display', 'none');
    }
};

function copyToClipboard(event) {

    var content = $(event.target).attr('data-uid');

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(content).select();
    document.execCommand("copy");
    $temp.remove();
}

var get_uid_friends = function () {

    hidden_box_result();
    loading_search.css('display', 'block');

    var table = $('#table-uid-friend tbody');

    table.html('');

    var overlay = $('.overlay');

    overlay.css('display', 'block');

    var access_token = $('#access-token').val();

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.10/me/friends?fields=id,name,email,location,birthday,gender&limit=300&access_token=' + access_token,
        error: function () {
            loading_search.css('display', 'none');
        },
        success: function (response) {

            var data = response['data'];

            for (var i = 0; i < data.length; i++) {
                var temp = $('#table-uid-friend-temp tbody');

                temp.find('.serial').text(i + 1);

                temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['id'] + '/picture?type=large');

                temp.find('.uid').text(data[i]['id']);

                temp.find('.external-link').attr('href', 'https://www.facebook.com/' + data[i]['id']);

                temp.find('.external-link').text(data[i]['name']);

                temp.find('.email').text(('email' in data[i]) ? data[i]['email'] : 'Không xác định');

                temp.find('.gender').text(('gender' in data[i]) ? data[i]['gender'] : '');

                temp.find('.birthday').text(('birthday' in data[i]) ? data[i]['birthday'] : '');

                temp.find('.location').text(('location' in data[i]) ? data[i]['location']['name'] : '');

                table.append(temp.html());
            }

            loading_search.css('display', 'none');

            view_box_result('uid-friend');
        }
    });
};

var get_uid_group = function () {

    hidden_box_result();
    loading_search.css('display', 'block');

    var table = $('#table-uid-group tbody');

    table.html('');

    var overlay = $('.overlay');

    overlay.css('display', 'block');

    var access_token = $('#access-token').val();

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.0/me/groups?fields=member_count,icon,name&limit=100&access_token=' + access_token,
        error: function () {
        },
        success: function (response) {

            var data = response['data'];

            for (var i = 0; i < data.length; i++) {
                var temp = $('#table-uid-temp tbody');

                temp.find('.serial').text(i + 1);

                temp.find('.icon').attr('src', data[i]['icon']);

                temp.find('.uid').text(data[i]['id']);

                temp.find('.member-count').text(data[i]['member_count']);

                temp.find('.external-link').attr('href', 'https://www.facebook.com/' + data[i]['id']);

                temp.find('.external-link').text(data[i]['name']);

                table.append(temp.html());
            }

            loading_search.css('display', 'none');

            view_box_result('uid-group');
        }
    });
};


var search_post_by_uid = function () {
    hidden_box_result();
    loading_search.css('display', 'block');

    var social_feed_list = $('#social-feed-list');

    social_feed_list.html('');

    var access_token = $('#access-token').val();

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.0/' + $('#uid-search').val() + '/posts?fields=privacy,shares,likes,comments,story,from,created_time,updated_time,link,full_picture,message&locale=vi_VN&limit=100&access_token=' + access_token,
        error: function () {
        },
        success: function (response) {

            var data = response['data'];

            for (var i = 0; i < data.length; i++) {
                var temp = $('#social-feed-temp');

                temp.find('.copy-uid').attr('data-uid', data[i]['id']);

                temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['from']['id'] + '/picture?type=large');

                temp.find('.name').text(data[i]['story']);

                temp.find('.created-time').text(data[i]['created_time']);

                if (('updated_time' in data[i]) && data[i]['updated_time'] !== data[i]['created_time']) {
                    temp.find('.updated-time').text(data[i]['updated_time']);
                }
                else {
                    temp.find('.updated-time').text('Bài viết chưa được chỉnh sửa');
                }

                if ('privacy' in data[i]) {
                    if (data[i]['privacy']['value'] === 'EVERYONE') {
                        temp.find('.everyone').css('display', 'block');
                        temp.find('.self').css('display', 'none');
                        temp.find('.all-friends').css('display', 'none');
                    }
                    else if ((data[i]['privacy']['value'] === 'ALL_FRIENDS') || (data[i]['privacy']['value'] === 'CUSTOM')) {
                        temp.find('.all-friends').css('display', 'block');
                        temp.find('.self').css('display', 'none');
                        temp.find('.everyone').css('display', 'none');
                    }
                    else {
                        temp.find('.self').css('display', 'block');
                        temp.find('.everyone').css('display', 'none');
                        temp.find('.all-friends').css('display', 'none');
                    }
                }
                else {
                    temp.find('.self').css('display', 'none');
                    temp.find('.everyone').css('display', 'none');
                    temp.find('.all-friends').css('display', 'none');
                }

                temp.find('.link-post').attr('href', 'https://www.facebook.com/' + data[i]['id']);

                temp.find('.like').text(('likes' in data[i]) ? data[i]['likes']['count'] : 0);
                temp.find('.comment').text(('comments' in data[i]) ? data[i]['comments']['count'] : 0);
                temp.find('.share').text(('shares' in data[i]) ? data[i]['shares']['count'] : 0);

                temp.find('.content').html('');

                if ('description' in data[i]) {
                    temp.find('.content').append('<p>' + data[i]['description'] + '</p>');
                }

                if (('message' in data[i])) {
                    if (valid_url(data[i]['message'])) {
                        temp.find('.content').append('<p><a href="' + data[i]['message'] + '">' + data[i]['message'] + '</a></p>');
                    }
                    else {
                        temp.find('.content').append('<p>' + data[i]['message'] + '</p>');
                    }
                }

                if (('full_picture' in data[i])) {
                    temp.find('.content').append('<img src="' + data[i]['full_picture'] + '"/>');
                }

                social_feed_list.append(temp.html());
            }

            loading_search.css('display', 'none');
            view_box_result('uid-post');
        }
    });
};

var get_uid_post = function () {

    hidden_box_result();
    loading_search.css('display', 'block');

    var social_feed_list = $('#social-feed-list');

    social_feed_list.html('');

    var access_token = $('#access-token').val();

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.0/me/posts?fields=privacy,shares,likes,comments,story,from,created_time,updated_time,link,full_picture,message&locale=vi_VN&limit=100&access_token=' + access_token,
        error: function () {
        },
        success: function (response) {

            var data = response['data'];

            for (var i = 0; i < data.length; i++) {
                var temp = $('#social-feed-temp');

                temp.find('.copy-uid').attr('data-uid', data[i]['id']);

                temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['from']['id'] + '/picture?type=large');

                temp.find('.name').text(data[i]['story']);

                temp.find('.created-time').text(data[i]['created_time']);

                if (('updated_time' in data[i]) && data[i]['updated_time'] !== data[i]['created_time']) {
                    temp.find('.updated-time').text(data[i]['updated_time']);
                }
                else {
                    temp.find('.updated-time').text('Bài viết chưa được chỉnh sửa');
                }

                if ('privacy' in data[i]) {
                    if (data[i]['privacy']['value'] === 'EVERYONE') {
                        temp.find('.everyone').css('display', 'block');
                        temp.find('.self').css('display', 'none');
                        temp.find('.all-friends').css('display', 'none');
                    }
                    else if ((data[i]['privacy']['value'] === 'ALL_FRIENDS') || (data[i]['privacy']['value'] === 'CUSTOM')) {
                        temp.find('.all-friends').css('display', 'block');
                        temp.find('.self').css('display', 'none');
                        temp.find('.everyone').css('display', 'none');
                    }
                    else {
                        temp.find('.self').css('display', 'block');
                        temp.find('.everyone').css('display', 'none');
                        temp.find('.all-friends').css('display', 'none');
                    }
                }
                else {
                    temp.find('.self').css('display', 'none');
                    temp.find('.everyone').css('display', 'none');
                    temp.find('.all-friends').css('display', 'none');
                }

                temp.find('.link-post').attr('href', 'https://www.facebook.com/' + data[i]['id']);

                temp.find('.like').text(('likes' in data[i]) ? data[i]['likes']['count'] : 0);
                temp.find('.comment').text(('comments' in data[i]) ? data[i]['comments']['count'] : 0);
                temp.find('.share').text(('shares' in data[i]) ? data[i]['shares']['count'] : 0);


                temp.find('.content').html('');

                if ('description' in data[i]) {
                    temp.find('.content').append('<p>' + data[i]['description'] + '</p>');
                }

                if (('message' in data[i])) {
                    if (valid_url(data[i]['message'])) {
                        temp.find('.content').append('<p><a href="' + data[i]['message'] + '">' + data[i]['message'] + '</a></p>');
                    }
                    else {
                        temp.find('.content').append('<p>' + data[i]['message'] + '</p>');
                    }
                }

                if (('full_picture' in data[i])) {
                    temp.find('.content').append('<img src="' + data[i]['full_picture'] + '"/>');
                }

                social_feed_list.append(temp.html());
            }

            loading_search.css('display', 'none');
            view_box_result('uid-post');
        }
    });
};

var valid_url = function (str) {
    var regular_expression = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    return regular_expression.test(str);
};