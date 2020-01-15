<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;

/* @var $this yii\web\View */

$general = FunctionHelper::get_general_information();

$this->title = $general['site_name'];

$this->registerMetaTag( [
	'name'    => 'description',
	'content' => $general['home_page_description']
] );

$this->registerMetaTag( [
	'property' => 'og:url',
	'content'  => Url::to( [ 'site/index' ], true )
] );

$this->registerMetaTag( [
	'property' => 'og:type',
	'content'  => 'homepage'
] );

$this->registerMetaTag( [
	'property' => 'og:title',
	'content'  => $general['site_name']
] );

$this->registerMetaTag( [
	'property' => 'og:description',
	'content'  => $general['home_page_description']
] );

$this->registerMetaTag( [
	'property' => 'og:image',
	'content'  => Url::to( [ $general['logo'] ], true )
] );

?>

<style>
    .mt-step-col {
        padding-top: 30px;
        padding-bottom: 30px;
        text-align: center;
    }

    .mt-step-number {
        color: #32c5d2 !important;
        border-color: #32c5d2 !important;
    }

    .mt-step-number {
        font-size: 26px;
        border-radius: 50% !important;
        display: inline-block;
        margin: auto auto 5px;
        padding: 9px;
        border: 3px solid #e5e5e5;
        position: relative;
        z-index: 5;
        height: 60px;
        width: 60px;
        text-align: center;
    }

    .mt-step-content, .mt-step-title {
        color: #32c5d2 !important;
    }

    .mt-step-title {
        font-size: 20px;
        font-weight: 400;
    }

    .mt-step-content, .mt-step-title {
        color: #32c5d2 !important;
    }

    .mt-step-number > i {
        font-size: 26px;
        position: relative;
        top: 100%;
        transform: translateY(-120%);
    }

    .done .mt-step-number {
        color: #26C281 !important;
        border-color: #26C281 !important;
    }

    .done .mt-step-content, .done .mt-step-title {
        color: #26C281 !important;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        text-align: center;
    }

    .list-group .dropdown-menu {
        width: 100%;
    }

    .btn-group {
        width: 100%;
    }

    .btn-group button, a {
        width: 100%;
    }

    .btn.btn-lg, .btn-lg, .btn-group-lg > .btn {
        padding: 10px 10px;
    }

</style>

<div class="col-lg-12">
    <section class="box nobox ">
        <div class="content-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class="pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary"></i>
                        <div class="stats">
                            <h4><strong>450K</strong></h4>
                            <span>Blog Page Views</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class="pull-left fa fa-user icon-md icon-rounded icon-accent"></i>
                        <div class="stats">
                            <h4><strong>6243</strong></h4>
                            <span>New Visitors</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class="pull-left fa fa-database icon-md icon-rounded icon-purple"></i>
                        <div class="stats">
                            <h4><strong>99.9%</strong></h4>
                            <span>Server Up</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class="pull-left fa fa-users icon-md icon-rounded icon-warning"></i>
                        <div class="stats">
                            <h4><strong>1433</strong></h4>
                            <span>New Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
                <div class="row" id="form_login">
                    <button class="btn btn-danger" type="button" style="border-radius: 25px;">
                        <i class="fa fa-play-circle"></i>
                        Xem hướng dẫn sử dụng
                    </button>
                    <div></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary" style="min-height: 567px;background-color: #d9edf7;">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <span class="fa fa-rocket"></span>
                                KÉO LIKE - BÌNH LUẬN FB (miễn phí)
                            </h2>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item list-group-item-info">
                                <div class="alert alert-success alert-dismissible fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span class="fa fa-close"></span>
                                    </button>
                                    <strong>Nên đọc:</strong> Các chức năng dưới đây
                                    <button class="btn btn-default btn-sm"
                                            style="border-radius: 25px;font-weight: bold;">
                                        miễn phí
                                    </button>
                                    cho mọi thành viên kết nối facebook vào hệ thống.
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="btn-group">

                                            <a href="<?= Url::to( [ 'buff-like/free' ] ) ?>"
                                               class="btn btn-danger">
                                                <b>
                                                    <span class="fa fa-thumbs-o-up"></span>
                                                    Cần Tăng Like / cảm xúc
                                                </b>
                                            </a>
                                        </div>
                                        <br><br>
                                        <div class="btn-group">
                                            <a href="<?= Url::to( [ 'buff-comment/free' ] ) ?>"
                                               class="btn btn-warning ">
                                                <b>
                                                    <span class="glyphicon glyphicon-comment"></span>
                                                    Cần Tăng bình luận
                                                </b>
                                            </a>
                                        </div>
                                        <br><br>
                                        <a href="<?= Url::to( [ 'buff-sub/free' ] ) ?>"
                                           class="btn btn-success ">
                                            <b>
                                                <span class="fa fa-wifi"></span>
                                                Tăng sub - friends
                                            </b>
                                        </a>
                                        <br><br>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <b><span
                                                            class="glyphicon glyphicon-heart-empty"></span>
                                                    Công cụ hay
                                                </b>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="">
                                                        Lọc friend không tương tác
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="">
                                                        Ai quan tâm bạn nhiều
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="">
                                                        Bật khiên bảo vệ avatar
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="">
                                                        HD mở khóa FB
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <br>
                                    (Các tiện ích hay cho facebook như: Tìm kiếm UID bài viết, nhóm, bàn bè. Lọc bạn bè
                                    rác, xem ai quan tâm nhiều đến bạn, bảo vệ tài khoản, mở khóa ...)
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <span class="fa fa-star"></span>
                                VIP BUFF, VIP THÁNG (trả phí)
                            </h2>
                        </div>
                        <div class="list-group-item list-group-item-warning">
                            <div class="row">
                                <p class="bg-info"><b>VIP THÁNG</b> là các dịch vụ trả phí theo tháng</p>
                                <div class="col-md-8">
                                    <p align="left">
                                        <b><u>VIP like</u></b>: Khi đăng ảnh, status ... lên FB, like người thật sẽ
                                        tự động tăng từ từ giống như like tự nhiên lên bài đăng của bạn.<br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-danger btn-lg" href="<?= Url::to(['bot-emotion/me']) ?>">
                                        <span class="glyphicon glyphicon-ok-sign"></span>
                                        <b>VIP LIKE</b>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <p align="left">
                                        <b><u>BOT cảm xúc</u></b>: Tự động Like, bày tỏ cảm xúc lên bài viết của bạn bè
                                        khi họ đăng bài.<br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-lg" href="<?= Url::to(['bot-emotion/friends']) ?>">
                                        <span class="glyphicon glyphicon-heart"></span>
                                        <b>BOT C.XÚC</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-success">
                            <div class="row">
                                <p class="bg-info"><b>VIP BUFF</b> là các dịch vụ trả phí dùng theo nhu cầu</p>
                                <div class="col-md-8">
                                    <p align="left">
                                        <b><u>Mua sub</u></b>: Tăng tương tác và uy tín cho Facebook - giúp bạn mua
                                        từ 500 đến 20.000 người theo dõi thực người Việt<br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-sm" href="<?= Url::to(['buff-sub/index']) ?>">
                                        <span class="fa fa-wifi"></span>
                                        <b>Mua sub</b>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <p align="left">
                                        <b><u>Buff Like</u></b>: Kéo hàng trăm đến hàng chục nghìn Like thực lên một
                                        bài đăng bất kỳ<br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-danger btn-sm" href="<?= Url::to(['buff-like/index']) ?>">
                                        <span class="glyphicon glyphicon-thumbs-up"></span>
                                        <b>Buff Like</b>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <p align="left">
                                        <b><u>Buff Bình luận</u></b>: Kéo hàng trăm đến hàng chục nghìn bình luận
                                        thực lên một bài đăng bất kỳ<br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-warning btn-sm" href="<?= Url::to(['buff-comment/index']) ?>">
                                        <span class="glyphicon glyphicon-comment"></span>
                                        <b>Buff B.luận</b>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <p align="left">
                                        <b><u>Tăng Rating</u></b>: Tăng đánh giá 5 sao và nhận xét có nội dung trên
                                        trang Page<br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-sm" href="">
                                        <span class="glyphicon glyphicon-star"></span>
                                        <b>Tăng Rating</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row step-line">
            <div class="col-md-4 mt-step-col first active">
                <div class="mt-step-number bg-white">
                    <i class="fa fa-facebook"></i>
                </div>
                <div class="mt-step-title uppercase font-grey-cascade">Thêm tài khoản facebook</div>
                <div class="mt-step-content font-grey-cascade">
                    Thêm các tài khoản facebook bạn muốn tăng like, share, comment.
                </div>
            </div>
            <div class="col-md-4 mt-step-col active">
                <div class="mt-step-number bg-white">
                    <i class="fa fa-search"></i>
                </div>
                <div class="mt-step-title uppercase font-grey-cascade">Tìm kiếm UID bài viết</div>
                <div class="mt-step-content font-grey-cascade">
                    Tìm kiếm UID nhóm, bạn bè, bài viết bằng cung cụ tìm kiếm của chúng tôi.
                </div>
            </div>
            <div class="col-md-4 mt-step-col last done">
                <div class="mt-step-number bg-white">
                    <i class="fa fa-rocket"></i>
                </div>
                <div class="mt-step-title uppercase font-grey-cascade">Tăng like, share, comment</div>
                <div class="mt-step-content font-grey-cascade">
                    Thực hiện tăng like, share, comment trên hệ thống
                </div>
            </div>
        </div>
    </div>
</div>