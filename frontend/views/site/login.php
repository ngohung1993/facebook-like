<?php

use common\helpers\ConnectHelper;

$this->title = 'Yêu cầu đăng nhập';

?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="text-center">
                <h2>Hệ thống chia sẻ like, comment, share facebook hiệu quả</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-10 col-sm-offset-1">
                        <div class="row">
                            <img class="type-reaction col-xs-2 img img-responsive"
                                 src="/uploads/core/images/like.gif">
                            <img class="type-reaction col-xs-2 img img-responsive"
                                 src="/uploads/core/images/haha.gif">
                            <img class="type-reaction col-xs-2 img img-responsive"
                                 src="/uploads/core/images/angry.gif">
                            <img class="type-reaction col-xs-2 img img-responsive"
                                 src="/uploads/core/images/sad.gif">
                            <img class="type-reaction col-xs-2 img img-responsive"
                                 src="/uploads/core/images/love.gif">
                            <img class="type-reaction col-xs-2 img img-responsive"
                                 src="/uploads/core/images/wow.gif">
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="text-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-default alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-close"></span>
                            </button>
                            <strong>Bắt buộc:</strong> Vui lòng đăng nhập để tiếp tục!
                        </div>
                        <a href="<?= ConnectHelper::generate_url_login() ?>">
                            <button class="btn btn-danger" type="button" style="border-radius: 25px;">
                                <i class="fa fa-sign-in"></i>
                                Đăng nhập hoặc tạo tài khoản mới
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
