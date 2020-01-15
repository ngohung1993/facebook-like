<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/11/2018
 * Time: 2:56 PM
 */

use yii\helpers\Url;
use frontend\assets\FacebookAccountAsset;

/* @var $user common\models\User */
/* @var $facebook_accounts common\models\FacebookAccount */

FacebookAccountAsset::register( $this );

$this->title = 'Tài khoản facebook';

?>

<style>
    table td {
        line-height: 2.5 !important;
        text-align: center !important;
    }

    table th {
        text-align: center;
        text-transform: uppercase;
    }
</style>

<div class="col-xs-12">
    <div class="page-title">
        <div class="pull-left hidden-xs">
            <ol class="breadcrumb">
                <li>
                    <a href="<?= Url::to( [ 'site/index' ] ) ?>">
                        <i class="fa fa-home"></i>
                        Trang chủ
                    </a>
                </li>
                <li class="active">
                    <strong style="font-weight: 600;">Tài khoản facebook</strong>
                </li>
            </ol>
        </div>

    </div>
</div>

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Tài khoản facebook</h2>
            <div class="actions panel_actions pull-right">
                <button class="btn btn-success" data-toggle="modal" href="#crud-facebook">
                    <span class="fa fa-plus"></span>
                    Thêm tài khoản facebook
                </button>
            </div>
        </header>
        <div class="content-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <span class="fa fa-sort-numeric-asc"></span>
                                </th>
                                <th>Avatar</th>
                                <th>Tài khoản</th>
                                <th>UID</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ( $facebook_accounts as $key => $value ): ?>
                                <tr class="<?= $value['uid'] ?>">
                                    <td><?= $key + 1 ?></td>
                                    <td style="text-align: center;">
                                        <img src="<?= $value['avatar'] ?>"
                                             style="width: 40px;height: 40px;" class="img-circle">
                                    </td>
                                    <td>
										<?= $value['name'] ?>
                                    </td>
                                    <td>
										<?= $value['uid'] ?>
                                    </td>
                                    <td>
                                        <span class="check hidden" style="color: #f1b900;">
                                            <span class="fa fa-cog fa-spin"></span>
                                            Đang kiểm tra
                                        </span>
										<?php if ( $value['status'] ): ?>
                                            <span class="active" style="color: blue;">
                                                <span class="fa fa-check"></span>
                                                Đang hoạt động
                                            </span>
                                            <span class="not-active hidden" style="color: red;">
                                                <span class="fa fa-check"></span>
                                                Đã hết hạn
                                            </span>
										<?php endif; ?>
										<?php if ( ! $value['status'] ): ?>
                                            <span class="active hidden" style="color: blue;">
                                                <span class="fa fa-check"></span>
                                                Đang hoạt động
                                            </span>
                                            <span class="not-active" style="color: red;">
                                                <span class="fa fa-check"></span>
                                                Đã hết hạn
                                            </span>
										<?php endif; ?>
                                    </td>
                                    <td>
                                        <button onclick="check_token(<?= $value['uid'] ?>)" class="btn btn-info">
                                            Kiểm tra
                                        </button>
                                        <button data-toggle="modal" href="#crud-facebook" class="btn btn-success">
                                            Cập nhật
                                        </button>
                                        <button onclick="delete_token(<?= $value['uid'] ?>)" class="btn btn-danger">
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
							<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">
                Cài đặt tài khoản
            </h2>
        </header>
        <div class="content-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne1">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <i class="fa fa-step-forward"></i>
                                        Bước 1 : Bật like/ theo dõi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne1" aria-expanded="false" style="height: 0;">
                                <div class="panel-body">
                                    <p class="text-danger">
                                        Lưu ý: Năm sinh của bạn trên facebook phải trên 18 tuổi, nếu không hãy
                                        <a class="btn btn-danger btn-sm"
                                           href="https://www.facebook.com/me/about?section=contact-info&pnref=about"
                                           target="_blank"> thay đổi năm sinh </a>
                                        thành trên 18 tuổi. Nếu không sẽ không bật theo dõi được.
                                    </p>
                                    Tiếp theo bạn click vào
                                    <a href="https://www.facebook.com/settings?tab=followers" target="_blank"
                                       class="btn btn-success btn-sm">đây</a>
                                    để thay đổi thiết lập người theo giõi. Trong phần: <br> "<b>Ai có thể theo dõi
                                        tôi</b>" bạn
                                    chọn
                                    và sửa thành
                                    <kbd>
                                        <i class="fa fa-globe"></i>
                                        Tất cả mọi người
                                        <i class="fa fa-caret-down"></i>
                                    </kbd> hoặc
                                    <kbd>
                                        <i class="fa fa-globe"></i>
                                        Everyone
                                        <i class="fa fa-caret-down"></i>
                                    </kbd>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo1">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-step-forward"></i>
                                        Bước 2 : Bật công khai
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTwo1" aria-expanded="false">
                                <div class="panel-body">
                                    Tiếp theo bạn click vào
                                    <a href="https://www.facebook.com/settings?tab=privacy&section=composer&view"
                                       target="_blank" class="btn btn-success btn-sm"> đây </a>
                                    để thiết lập công khai bài viết. Trong phần: "<b>Ai có thể xem các bài viết của bạn
                                        trong tương lai?</b>" bạn chọn
                                    <kbd><i class="fa fa-globe"></i> Mọi người</kbd>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree1">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-step-forward"></i>
                                        Bước 3 : Bật comment
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingThree1" aria-expanded="false">
                                <div class="panel-body">
                                    Click vào <a class="btn btn-success btn-sm" target="_blank"
                                                 href="https://www.facebook.com/settings?tab=followers&amp;section=comment&amp;view">đây</a>,
                                    trong mục "<b>Ai có thể bình luận về những bài viết công khai của bạn?</b>" bạn chọn
                                    và sửa
                                    thành:
                                    <kbd> Mọi người </kbd> hoặc <kbd> Everyone </kbd>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour1">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="fa fa-step-forward"></i>
                                        Bước 4 : Bật like ảnh đại diện
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingFour1" aria-expanded="false">
                                <div class="panel-body">
                                    Cuối cùng bạn vào
                                    <a class="btn btn-success btn-sm"
                                       href="https://www.facebook.com/settings?tab=followers&section=public_profile_media&view"
                                       target="_blank">đây</a>: "<b>Ai có thể thích hoặc bình luận về
                                        ảnh đại diện công khai và các thông tin khác trên trang cá nhân của tôi?
                                    </b>" bạn chọn và sửa thành: <kbd> Mọi người </kbd> hoặc <kbd> Everyone </kbd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade col-xs-12 in" id="crud-facebook" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog animated fadeInDown">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
                    <div class="alert alert-primary alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Chú ý:</strong>
                        Vui lòng điền thông tin tài khoản Facebook của bạn. Nên dùng trình duyệt bạn
                        hay đăng nhập Facebook để đăng nhập dịch vụ. <br>Có thể bị checkpoint lần đầu tiên. Hãy vô
                        facebook xác nhận đó là tôi
                    </div>
                    <label class="form-label" for="field-1">
                        Email hoặc số điện thoại Facebook
                    </label>
                    <div class="form-group has-feedback">
                        <input title="" type="text" id="username" class="form-control"
                               placeholder="Email hoặc số điện thoại Facebook">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <label class="form-label" for="field-1">Mật khẩu Facebook</label>
                    <div class="form-group has-feedback">
                        <input title="" type="password" id="password" class="form-control"
                               placeholder="Mật khẩu Facebook">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div id="step-2" style="display: none;">
                    <div class="result-error" style="display: none;">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Cookie lỗi</strong>
                        </div>
                    </div>
                    <div class="result-success" style="display: none;">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            Thêm tài khoản thành công. Hệ thống sẽ tải lại trang.
                        </div>
                    </div>
                    <label style="font-weight: 600;">Nhập mã</label>
                    <textarea title="" name="" id="result" class="form-control" cols="30" rows="4"
                              placeholder="Mã facebook"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input title="" type="hidden" id="username-send" value="<?= $user['username'] ?>">
                <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                <button class="btn btn-success" type="button" onclick="verify_account()">
                    <span class="fa fa-check"></span>
                    Thêm tài khoản
                </button>
            </div>
        </div>
    </div>
</div>