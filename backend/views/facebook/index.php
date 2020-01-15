<?php

use backend\assets\FacebookAsset;

FacebookAsset::register( $this );

/* @var $this yii\web\View */


?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb">
                <i class="fa fa-facebook"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Tài khoản facebook' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#facebook-account">
                    <span class="fa fa-plus"></span>
                    Thêm tài khoản facebook
                </button>
            </div>
        </div>
    </div>
</section>

<div id="facebook-account" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thêm tài khoản facebook</h4>
            </div>
            <div class="modal-body">
                <img id="loading" src="/uploads/core/images/loading.gif" style="display: none;">
                <div id="step-1" style="display: block;">
                    <div id="result-verify" style="display: none;">
                        <iframe width="100%" height="100%" src=""></iframe>
                        <div class="alert alert-success alert-dismissible" style="font-weight: 500;">
                            Vui lòng copy đoạn mã bên dưới và nhấn thêm tài khoản để thêm . <br>
                            <button onclick="go_step_two()" class="btn btn-info btn-rounded">Nhấn thêm mã tại đây
                            </button>
                        </div>
                    </div>
                    <div class="alert alert-warning alert-dismissible" style="font-weight: 500;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Vui lòng điền thông tin tài khoản Facebook của bạn. Nên dùng trình duyệt bạn hay đăng nhập
                        Facebook
                        để đăng nhập dịch vụ. Có thể bị checkpoint lần đầu tiên. Hãy vô facebook xác nhận đó là tôi
                    </div>
                    <label style="font-weight: 600;">Email hoặc số điện thoại Facebook</label>
                    <input id="username" name="email" type="text" class="form-control"
                           placeholder="Email hoặc số điện thoại Facebook">
                    <label style="font-weight: 600;">Mật khẩu Facebook</label>
                    <input id="password" name="password" type="password" class="form-control"
                           placeholder="Mật khẩu Facebook">
                </div>
                <div id="step-2" style="display: none;">
                    <label style="font-weight: 600;">Nhập mã</label>
                    <textarea title="" name="" id="verify-account" class="form-control" cols="30" rows="4"
                              placeholder="Mã facebook"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="verify_account()">
                    <i style="display: none;" class="load-submit fa fa-refresh fa-spin"></i>
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>