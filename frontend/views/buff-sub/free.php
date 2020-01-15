<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/6/2018
 * Time: 12:38 AM
 */

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\BuffSubAsset;

BuffSubAsset::register( $this );

/* @var $model common\models\BuffSub */
/* @var $buff_subs array common\models\BuffSub */
/* @var $facebook_accounts array common\models\FacebookAccount */

$this->title = 'Tăng sub - friends';

?>

<style>

    .emotion-box label {
        margin-right: 20px;
    }

    .emotion-box img {
        width: 60px;
    }

    .emotion-box label {
        margin-right: 9px;
    }

    table td {
        text-align: center;
    }

    table td {
        line-height: 2.5 !important;
        text-align: center;
    }

    .alert {
        padding: 10px 35px 10px 15px;
    }

    table th {
        text-align: center;
    }

    .panel-heading {
        padding: 10px 15px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
        text-align: center;
    }

    .panel-title {
        text-transform: uppercase;
    }

    section .content-body {
        padding: 10px;
    }

    .modal-body {
        padding: 10px;
    }

    .modal-footer {
        text-align: center;
    }

    .slider-selection {
        background: #BABABA;
    }

    .slider-horizontal {
        width: 100% !important;
    }

    .btn {
        outline: none !important;
    }

    .emotion-item {
        font-size: 20px;
        margin: 0 10px;
    }

    .emotion-item .fa {
        font-size: 20px;
        color: #337ab7;
    }

</style>

<div>
    <div class="col-xs-12">
        <div class="page-title">
            <div class="pull-left hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= Url::to( 'site/index' ) ?>">
                            <i class="fa fa-home"></i>
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        Tài khoản
                    </li>
                    <li class="active">
                        <strong style="font-weight: 600;">Tăng like bài viết</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>

	<?php if ( ! count( $facebook_accounts ) ): ?>
        <div class="col-md-12">
            <div class="alert alert-error alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-close"></span>
                </button>
                <strong>Bắt buộc:</strong> Để tăng like, bình luận lên Facebook của bạn. Trước hết, bạn cần kết nối tài
                khoản Facebook với hệ thống của chúng tôi. <a href="<?= Url::to( [ 'facebook/index' ] ) ?>">Tại đây</a>
            </div>
        </div>
	<?php endif; ?>
	<?php if ( count( $facebook_accounts ) ): ?>
        <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Khuyên dùng:</strong>
                Hay đảm bảo tài khoản của bạn ở chế độ công khai <span class="fa fa-globe"></span> trước khi bắt đầu sử
                dụng
                hệ
                thống. Cài đặt <a target="_blank" href="<?= Url::to( [ 'help/setting-facebook' ] ) ?>">tại đây</a>
            </div>
			<?php if ( Yii::$app->session->hasFlash( 'success' ) ): ?>
                <div class="alert alert-success alert-dismissible fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Thông báo:</strong> Cập nhật dữ liệu thành công
                </div>
			<?php endif; ?>
        </div>

        <div class="col-lg-12 step-1">
            <section class="box">
                <div class="content-body" style="padding-top: 15px;">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Tăng sub - friends </h2>
                                </div>
                                <div class="modal-body" style="min-height: 424px;">
                                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Trợ giúp:</strong>
                                        Chưa có ID hãy dùng công cụ <span class="fa fa-search"></span> tìm kiếm.
                                        <a target="_blank" href="<?= Url::to( [ 'search/index' ] ) ?>">Tại đây</a>
                                    </div>
                                    <label class="form-label" for="field-1">
                                        Nhập LINK hoặc ID bài tài khoản facebook
                                    </label>
                                    <div class="alert alert-danger error-check" style="display: none">
                                        <strong>Cảnh báo:</strong>
                                        Bạn đã nhập sai <b>LINK</b> hoặc <b>ID</b> tài khoản.<b>Mọi người</b>. vui
                                        lòng xem hướng dẫn phía bên phải màn hình và thử lại
                                    </div>
                                    <div class="form-group has-feedback required">
                                        <input id="uid-facebook" type="text" class="form-control" aria-required="true"
                                               placeholder="Nhập LINK hoặc ID bài tài khoản facebook">
                                        <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button class="btn btn-primary" type="button" onclick="check_uid()"
                                                style="border-radius: 25px;">
                                            Tiếp tục
                                            <span class="fa fa-arrow-right"></span>
                                        </button>
                                    </div>
                                    <div class="loading-search" style="text-align: center; display: none;">
                                        <img style="width: 50px;" src="/uploads/core/images/loading-search.gif">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-lg-12 step-2" style="display: none;">
            <section class="box">
                <div class="content-body" style="padding-top: 15px;">
                    <div class="row">
                        <div class="col-md-8 col-xs-12 col-md-offset-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Mua theo dõi thực facebook</h2>
                                </div>
								<?php $form = ActiveForm::begin( [ 'id' => 'buff-like-form' ] ); ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Bài đăng của</label>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <span style="color:red;">HỌ TÊN:</span>
                                                        <b class="name-result"></b>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span style="color:red;">ID TÀI KHOẢN:</span>
                                                        <b class="uid-result"></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">
                                                Cần sub mua
                                            </label>
                                            <div class="form-group">
                                                <div class="form-group" style="padding: 0 20px;margin-top: 30px;">
                                                    <input id="subscribe-total-slider" type="text" title=""
                                                           data-slider-min="20"
                                                           data-slider-max="100" data-slider-step="1"
                                                           data-slider-value="20">
													<?= $form->field( $model, 'subscribe_total' )->hiddenInput( [ 'id' => 'subscribe-total' ] )->label( false ) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">
                                                Số sub giữa 2 phiên (1 phút)
                                            </label>
                                            <div class="form-group">
                                                <div class="form-group" style="padding: 0 20px;margin-top: 30px;">
                                                    <input id="speed-slider" type="text" title="" data-slider-min="5"
                                                           data-slider-max="50" data-slider-step="1"
                                                           data-slider-value="5">
													<?= $form->field( $model, 'speed' )->hiddenInput( [ 'id' => 'speed' ] )->label( false ) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
									<?= $form->field( $model, 'uid' )->hiddenInput()->label( false ) ?>
                                    <button class="btn btn-primary" type="submit" onclick="load()"
                                            style="border-radius: 25px;">
                                        <span class="fa fa-arrow-up"></span>
                                        Tăng ngay
                                    </button>
                                </div>
								<?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-lg-12">
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left">Lịch sử tăng sub bài viết</h2>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><span class="fa fa-sort-numeric-asc"></span></th>
                                        <th>Tài khoản</th>
                                        <th>Cần tăng</th>
                                        <th>Thành công</th>
                                        <th>Hình thức</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach ( $buff_subs as $key => $value ): ?>
                                        <tr>
                                            <td style="text-align: center"><?= $key + 1 ?></td>
                                            <td>
                                                <a target="_blank"
                                                   href="https://www.facebook.com/<?= $value['uid'] ?>">
                                                    <img style="height: 40px;border-radius: 21px;width: 40px;"
                                                         src="https://graph.facebook.com/<?= $value['uid'] ?>/picture?type=large">
                                                </a>
                                            </td>
                                            <td><?= $value['subscribe_total'] . ' sub' ?></td>
                                            <td><?= ( $value['subscribed'] ? $value['subscribed'] : 0 ) . ' sub' ?></td>
                                            <td>
												<?php if ( $value['free'] ): ?>
                                                    <span style="color: blue;">
                                                <span class="fa fa-shield"></span>
                                                Trả phí
                                            </span>
												<?php endif; ?>
												<?php if ( ! $value['free'] ): ?>
                                                    <span style="color: coral;">
                                                <span class="fa fa-gift"></span>
                                                    Miễn phí
                                                </span>
												<?php endif; ?>
                                            </td>
                                            <td>
												<?php if ( $value['subscribed'] >= $value['subscribe_total'] ): ?>
                                                    <span style="color: blue;">
                                                    <span class="fa fa-check"></span>
                                                    Hoàn thành
                                                </span>
												<?php endif; ?>
												<?php if ( $value['subscribed'] < $value['subscribe_total'] ): ?>
                                                    <span style="color: coral;">
                                                    <span class="fa fa-spinner fa-spin"></span>
                                                    Đang chạy
                                                </span>
												<?php endif; ?>
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
	<?php endif; ?>
</div>