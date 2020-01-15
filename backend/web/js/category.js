/**
 * Created by vietv on 3/10/2018.
 */

$(function () {

    $('#tree-5aa383cc537d1').nestable([]);

    $('.tree_branch_delete').click(function () {
        var id = $(this).data('id');

        $.ajax({
            method: 'post',
            url: '/demo/categories/' + id,
            data: {
                _method: 'delete'
            },
            success: function () {
                $.pjax.reload('#pjax-container');
            }
        });
    });

    $('.tree-5aa383cc537d1-save').click(function () {
        var loader = $('#loader');
        loader.css('display', 'block');

        var serialize = $('#tree-5aa383cc537d1').nestable('serialize');
        console.log(JSON.stringify(serialize));
        $.ajax({
            url: base + 'ajax/serial',
            type: 'post',
            data: {
                serialize: JSON.stringify(serialize)
            },
            success: function (response) {
                if (response) {
                    $.notify('Cập nhật thành công', 'success');
                }
                else {
                    $.notify('Đã xảy ra lỗi', 'error');
                }
                loader.css('display', 'none');
            }
        });

    });

    $('.tree-5aa383cc537d1-tree-tools').on('click', function (e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });

});