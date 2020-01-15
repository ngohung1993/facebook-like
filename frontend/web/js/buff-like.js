
var load = function () {

    $('#bufflike-post_id').val($('.post-id-result').text());

    var emotions = [];

    $('.emotion-box').find('input:checked').each(function () {
        emotions.push($(this).val());
    });

    $('#emotions').val(JSON.stringify(emotions));

};

var like_total_slider = $('#like-total-slider');

like_total_slider.slider({
    tooltip: 'always'
});

$("#like-total").val(20);

like_total_slider.on("slide", function (event) {
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

        $('#bufflike-post_id').val($('.post-id-result').text());

        var emotions = [];

        $('.emotion-box').find('input:checked').each(function () {
            emotions.push($(this).val());
        });

        $('#emotions').val(JSON.stringify(emotions));

    }
};