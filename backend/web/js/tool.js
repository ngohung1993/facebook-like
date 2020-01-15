var after_submit = function () {
    var form = $('#buff-like-form');

    var emotions = [];

    $('.emotion-box input:checked').each(function () {
        emotions.push($(this).val());
    });

    $('#emotions').val(JSON.stringify(emotions));

    form.submit();

};

$('#buff-like-form').on('beforeSubmit', function () {

    $('.load-submit').css('display', 'inline-block');

    swal({html: true, title: 'Thất bại', text: 'Tài khoản của bạn chưa kích hoạt.', type: 'success'});
});

var get_list_friend = function () {
    var table = $('#table-list-friend tbody');

    table.html('');

    var overlay = $('.overlay');

    overlay.css('display', 'block');

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com/v1.0/me/friends?&fields=id,name,email,location,birthday,gender&method=get&limit=300',
        data: {
            access_token: 'EAAAAUaZA8jlABAErOKBum3ihfWrfu0ne378CEavIPZBMZCTYFEOqRPF2NZBTUIGLs1Sc8ZAmLTBi4Q7sRZAWZB3p4Iws3O2lqIgJgiVWQJbxRcezkoyV47DC1HO1ztYhuvfX7hpQ4CZCzarUjR8BjDUYKhvIhXbrZCjoixsLyM8ZCflLCjqh8ZAt501'
        },
        error: function () {
        },
        success: function (response) {

            var data = response['data'];

            for (var i = 0; i < data.length; i++) {
                var temp = $('#table-temp tbody');

                temp.find('tr').addClass((i % 2 === 0 ? 'old' : 'even'));

                temp.find('.action-table').attr('data-id', data[i]['id']);

                temp.find('.uid').text(data[i]['id']);

                temp.find('a').attr('href', 'https://www.facebook.com/' + data[i]['id']);

                temp.find('a').text(data[i]['name']);

                temp.find('.email').text((data[i]['email'] ? data[i]['email'] : 'Không xác định'));

                if (('location' in data[i])) {
                    temp.find('.location').text(data[i]['location']['name']);
                }

                temp.find('.birthday').text(data[i]['birthday']);

                table.append(temp.html());
            }

            overlay.css('display', 'none');
        }
    });
};

var get_friend_request = function () {
    var table = $('#table-list-friend tbody');

    table.html('');

    var overlay = $('.overlay');

    overlay.css('display', 'block');

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com/v1.0/me/friendrequests?method=get&limit=1000',
        data: {
            access_token: 'EAAAAUaZA8jlABAErOKBum3ihfWrfu0ne378CEavIPZBMZCTYFEOqRPF2NZBTUIGLs1Sc8ZAmLTBi4Q7sRZAWZB3p4Iws3O2lqIgJgiVWQJbxRcezkoyV47DC1HO1ztYhuvfX7hpQ4CZCzarUjR8BjDUYKhvIhXbrZCjoixsLyM8ZCflLCjqh8ZAt501'
        },
        error: function () {
        },
        success: function (response) {

            var data = response['data'];

            for (var i = 0; i < data.length; i++) {
                var temp = $('#table-temp tbody');

                temp.find('tr').addClass((i % 2 === 0 ? 'old' : 'even'));

                temp.find('.uid').text(data[i]['from']['id']);

                temp.find('a').attr('href', 'https://www.facebook.com/' + data[i]['from']['id']);

                temp.find('a').text(data[i]['from']['name']);

                temp.find('.email').text(data[i]['from']['email']);

                temp.find('.btn-accept button').attr('data-uid', data[i]['from']['id']);

                if (('location' in data[i])) {
                    temp.find('.location').text(data[i]['from']['location']['name']);
                }

                temp.find('.birthday').text(data[i]['from']['birthday']);

                table.append(temp.html());
            }

            overlay.css('display', 'none');
        }
    });
};

var accept_friend = function (event) {

    var uid = $(event.target).attr('data-uid');

    var overlay = $('.overlay');

    overlay.css('display', 'block');

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com/v1.0/me/friends/' + uid,
        data: {
            access_token: 'EAAAAUaZA8jlABAErOKBum3ihfWrfu0ne378CEavIPZBMZCTYFEOqRPF2NZBTUIGLs1Sc8ZAmLTBi4Q7sRZAWZB3p4Iws3O2lqIgJgiVWQJbxRcezkoyV47DC1HO1ztYhuvfX7hpQ4CZCzarUjR8BjDUYKhvIhXbrZCjoixsLyM8ZCflLCjqh8ZAt501'
        },
        error: function () {
        },
        success: function () {
            overlay.css('display', 'none');
        }
    });
};