var load = function () {
    $('#buffshare-post_id').val($('.post-id-result').text());
};

var share_total_slider = $('#share-total-slider');

share_total_slider.slider({
    tooltip: 'always'
});

$("#share-total").val(20);

share_total_slider.on("slide", function (event) {
    var price = $('.price');

    $("#share-total").val(event.value);

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

        $('#buffshare-post_id').val($('.post-id-result').text());
    }
};