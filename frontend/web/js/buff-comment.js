var add_input = function () {
    $('.input-list').append($('.input-temp').html());
};

var remove_input = function (event) {
    $(event.target).closest('.form-group').remove();
};

var load = function () {

    $('#buffcomment-post_id').val($('.post-id-result').text());

    var content = [];

    $('.input-list').find('input').each(function () {
        if ($(this).val()) {
            content.push($(this).val());
        }
    });

    $('#content').val(JSON.stringify(content));
};

var comment_total_slider = $('#comment-total-slider');

comment_total_slider.slider({
    tooltip: 'always'
});

$("#like-total").val(20);

comment_total_slider.on("slide", function (event) {
    var price = $('.price');

    $("#like-total").val(event.value);

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

var check_out = function () {
    var account_balance = $('.account-balance').attr('data-value');
    var price = $('.price').attr('data-total');

    if (parseInt(account_balance) < parseInt(price)) {
        $('.not-enough-money').css('display', 'block');
    }
    else {
        $('.not-enough-money').css('display', 'none');

        $('#buffcomment-post_id').val($('.post-id-result').text());

        var content = [];

        $('.input-list').find('input').each(function () {
            if ($(this).val()) {
                content.push($(this).val());
            }
        });

        $('#content').val(JSON.stringify(content));
    }
};