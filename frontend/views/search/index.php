<?php

use frontend\assets\SearchAsset;

/* @var $this yii\web\View */
/* @var $user \common\models\User */
/* @var $facebook_accounts common\models\FacebookAccount */

SearchAsset::register( $this );

$this->title = 'Tìm kiếm UID facebook';

?>

<style>
    .social-feed-box {
        border: 1px solid #e7eaec;
        background: #fff;
        margin-bottom: 15px;
        padding: 15px;
    }

    .social-feed-separated .social-avatar img {
        width: 90px;
        height: 90px;
        border: 1px solid #e7eaec;
    }

    .social-body {
        padding: 15px 0;
    }

    .btn-rounded {
        border-radius: 50px;
    }

    .tab-pane button {
        border-radius: 25px;
    }

    .reactions i {
        margin: 0 10px;
    }

    .content img {
        max-width: 100%;
    }

    #back-to-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 9999;
        width: 32px;
        height: 32px;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
        border: 0;
        border-radius: 2px;
        text-decoration: none;
        transition: opacity 0.2s ease-out;
        display: none;
        color: white;
        background: #222f68;
    }

    #back-to-top:hover {
        background: #DDA650;
    }

    .btn:active:focus, .btn:focus {
        outline: 0 auto -webkit-focus-ring-color;
    }

</style>

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Công cụ tìm kiếm</h2>
            <div class="actions panel_actions pull-right">
                <a class="box_setting fa fa-cog" data-toggle="modal" href="javascript:void(0)"></a>
            </div>
        </header>
        <div class="content-body" style="padding: 5px 30px 15px 30px;">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#facebook-account" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-facebook"></i>
                                Chọn tài khoản facebook
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="facebook-account">
                            <div class="row">
                                <div class="col-md-12">
                                    <select title="" id="access-token" class="form-control">
										<?php foreach ( $facebook_accounts as $key => $value ): ?>
                                            <option value="<?= $value['access_token'] ?>">
												<?= $value['name'] ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin: 15px 0;"></div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#home-8" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-qrcode"></i> Tìm UID theo tài khoản facebook
                            </a>
                        </li>
                        <li class="">
                            <a href="#profile-8" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-user"></i> Tìm kiếm bài viết theo UID
                            </a>
                        </li>
                        <li class="">
                            <a href="#messages-8" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-code"></i> Tìm UID theo đường dẫn
                            </a>
                        </li>
                        <li class="">
                            <a href="#settings-8" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home-8">
                            <div class="row" style="text-align:  center;">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary" onclick="get_uid_group()">
                                        <span class="fa fa-sitemap"></span>
                                        Lấy UID nhóm
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success" onclick="get_uid_friends()">
                                        <span class="fa fa-user"></span>
                                        Lấy UID bạn bè
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" onclick="get_uid_post()">
                                        <span class="fa fa-newspaper-o"></span>
                                        Lấy UID bài viết
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger">
                                        Lấy UID nhóm
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="uid-search" type="text" title="" class="form-control"
                                           placeholder="Nhập UID cần tìm kiếm">
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" onclick="search_post_by_uid()">
                                        <span class="fa fa-search"></span>
                                        Lấy danh sách bài viết
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="messages-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <input id="uid-search" type="text" title="" class="form-control"
                                           placeholder="Nhập đường dẫn facebook">
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" onclick="search_uid_by_link()">
                                        <span class="fa fa-search"></span>
                                        Tìm kiếm UID
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="settings-8">

                            <p>We also believe you should be able to use all Bootstrap plugins purely through the
                                JavaScript API. All public APIs are single, chainable methods, and return the collection
                                acted upon.</p>
                            <p>Don't use data attributes from multiple plugins on the same element. For example, a
                                button cannot both have a tooltip and toggle a modal. To accomplish this, use a wrapping
                                element.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="box">
        <header class="panel_header">
            <h2 class="title pull-left">
                <span style="font-size: 19px;" class="fa fa-database"></span>
                Kết quả tìm kiếm
            </h2>
            <div class="actions panel_actions pull-right">
                <a class="box_setting fa fa-cog" data-toggle="modal" href="javascript:void(0)"></a>
            </div>
			
        </header>
        <div class="content-body">
            <div class="loading-search" style="text-align: center;display: none;">
                <img style="width: 50px;" src="/uploads/core/images/loading-search.gif" alt="">
            </div>
            <div id="uid-friend" style="display: none;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="table-uid-friend-temp" style="display: none;">
                                <tbody>
                                <tr>
                                    <td class="serial"></td>
                                    <td style="text-align: center;">
                                        <img style="height: 40px;border-radius: 21px;width: 40px;" class="avatar" src=""
                                             alt="">
                                    </td>
                                    <td>
                                        <a href="" target="_blank" class="external-link">
                                            <span class="fa fa-external-link"></span>
                                        </a>
                                    </td>
                                    <td class="uid"></td>
                                    <td class="email"></td>
                                    <td class="gender"></td>
                                    <td class="birthday"></td>
                                    <td class="location"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table id="table-uid-friend" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px;">
                                        <span class="fa fa-sort-numeric-asc"></span>
                                    </th>
                                    <th style="width: 50px;">Avatar</th>
                                    <th>Họ và tên</th>
                                    <th>UID</th>
                                    <th>Email</th>
                                    <th>Giới tính</th>
                                    <th>Tuổi</th>
                                    <th>Quê quán</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="uid-group" style="display: none;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="table-uid-temp" style="display: none;">
                                <tbody>
                                <tr>
                                    <td class="serial"></td>
                                    <td><img class="icon" src="" alt=""></td>
                                    <td>
                                        <a href="" target="_blank" class="external-link">
                                            <span class="fa fa-external-link"></span>
                                            Xem nhóm
                                        </a>
                                    </td>
                                    <td class="uid"></td>
                                    <td class="member-count"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table id="table-uid-group" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        <span class="fa fa-sort-numeric-asc"></span>
                                    </th>
                                    <th>Avatar</th>
                                    <th>Tên nhóm</th>
                                    <th>UID</th>
                                    <th>Thành viên</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="uid-post" style="display: none;">
                <div id="social-feed-temp" style="display: none">
                    <div class="social-feed-separated">
                        <div class="social-feed-box" style="margin-left:0">
                            <div class="info">
                                <div class="social-avatar" style="float: left; padding-right:0">
                                    <a target="_blanks" href="">
                                        <img class="avatar" alt="image" style="margin-right: 10px;" src="">
                                    </a>
                                </div>
                                <div class="right-info">
                                    <a target="_blanks" href="">
                                        <strong class="name"></strong>
                                    </a>
                                    <span class="label label-info everyone"
                                          style="border-radius: 25px;float: right;display: none">
                                        <i class="fa fa-globe"></i>
                                        Công khai
                                    </span>
                                    <span class="label label-danger self"
                                          style="border-radius: 25px;float: right;display: none">
                                        <i class="fa fa-lock"></i>
                                        Chỉ mình thôi
                                    </span>
                                    <span class="label label-warning all-friends"
                                          style="border-radius: 25px;float: right;display: none">
                                        <i class="fa fa-user"></i>
                                        Tất cả bạn bè
                                    </span>
                                    <div>
                                        <small class="text-muted">
                                            Ngày tạo: <span class="created-time"></span>
                                        </small>
                                    </div>
                                    <div>
                                        <small class="text-muted">
                                            Ngày sửa: <span class="updated-time"></span>
                                        </small>
                                        <div class="reactions">
                                            <i class="fa fa-thumbs-up"></i><span class="like"></span>
                                            <i class="fa fa-comments"></i><span class="comment"></span>
                                            <i class="fa fa-share"></i><span class="share"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="social-body">
                                <div class="content"></div>
                                <p></p>
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-3"></div>
                                    <div class="col-xs-6 col-md-3" style="margin-top: 5px">
                                        <a target="_blanks" href="" class="link-post">
                                            <button class="btn btn-success btn-rounded btn-sm">
                                                <i class="fa fa-external-link"></i>
                                                Xem chi tiết bài này
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-xs-6 col-md-3" style="margin-top: 5px">
                                        <button class="btn btn-primary btn-rounded btn-sm copy-uid"
                                                onclick="copyToClipboard(event)">
                                            <i class="fa fa-copy"></i>
                                            Lấy UID bài biết này
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="social-feed-list"></div>
            </div>
        </div>
    </section>
</div>

<a href="#" id="back-to-top" title="Back to top">
    <i class="fa fa-arrow-up"></i>
</a>