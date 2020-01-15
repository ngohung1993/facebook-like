<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/6/2018
 * Time: 12:38 AM
 */

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\BuffLikeAsset;

BuffLikeAsset::register( $this );

/* @var $model common\models\BuffLike */
/* @var $buff_likes array common\models\BuffLike */
/* @var $facebook_accounts array common\models\FacebookAccount */

$this->title = 'Tăng like bài viết';

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
                Hay đảm bảo tài khoản của bạn ở chế độ công khai <span class="fa fa-globe"></span>
                trước khi bắt đầu sử dụng hệ thống.
                Cài đặt <a target="_blank" href="<?= Url::to( [ 'help/setting-facebook' ] ) ?>">tại đây</a>
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
                        <div class="col-md-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Tăng like bài viết</h2>
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
                                    <label class="form-label" for="field-1">Nhập LINK hoặc ID bài viết Facebook</label>
                                    <div class="alert alert-danger error-check" style="display: none">
                                        <strong>Cảnh báo:</strong>
                                        Bạn đã nhập sai <b>LINK</b> hoặc <b>ID</b> bài viết.
                                        Hãy đảm bảo rằng bài viết được đăng với chế độ <b>Mọi người</b>. vui
                                        lòng xem hướng dẫn phía bên phải màn hình và thử lại
                                    </div>
                                    <div class="form-group has-feedback required">
                                        <input id="post-id" type="text" class="form-control" aria-required="true"
                                               placeholder="Nhập LINK hoặc ID bài viết Facebook vào đây">
                                        <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button class="btn btn-primary" type="button" onclick="check_post()"
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
                        <div class="col-md-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">HƯỚNG DẪN LẤY LINK</h2>
                                </div>
                                <div class="panel-body">
                                    Bạn truy cập vào <span style="color: blue">facebook</span> và tìm đến trang cá nhân
                                    hoặc Fanpage có bài đăng, bình luận cần tăng like (Bài đăng có thể là status trạng
                                    thái,
                                    hình ảnh, video, album... và bình luận nằm trên đó). Bạn lấy link bài đăng cần tăng
                                    like
                                    bằng cách bấm vào phần thời gian post bài hiển thị dưới tên tài khoản người đã post
                                    như
                                    hình dưới:<br>
                                    <img class="img-responsive" src="http://hacklike.vn/img/hack-like-stt-fanpage.png"
                                         alt="hack like stt, tang like status, hack nhiều like status"
                                         title="hack like stt, tang like status, hack nhiều like status">
                                    <br>
                                    Sau đó, chờ trình duyệt chuyển trang thì bạn copy toàn bộ địa chỉ (url) trên thanh
                                    địa
                                    chỉ
                                    của trình duyệt, đó chính là địa chỉ bài đăng (comment) facebook bạn cần lấy. Sau đó
                                    bạn
                                    dán
                                    nội dung vừa copy vào ô <i>Nhập link hoặc ID bài đăng FB vào đây</i> (phía bên trên)
                                    rồi
                                    chọn nút <b>Tiếp tục</b>.
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
                        <div class="col-md-offset-2 col-md-8 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Tăng like bài viết</h2>
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
                                                        <span style="color:red;">ID BÀI VIẾT:</span>
                                                        <b class="post-id-result"></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Thông kê hiện tại</label>
                                            <div class="form-group">
                                                <span class="emotion-item">
                                                    <span class="fa fa-thumbs-o-up"></span>
                                                    <span class="likes">0</span>
                                                </span>
                                                <span class="emotion-item">
                                                    <span class="fa fa-share-square"></span>
                                                    <span class="shares">0</span>
                                                </span>
                                                <span class="emotion-item">
                                                    <span class="fa fa-comments"></span>
                                                    <span class="comments">0</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Số like cần mua</label>
                                            <div class="form-group"
                                                 style="padding: 0 20px;margin-top: 30px;">
                                                <input id="like-total-slider" type="text" title="" data-slider-min="20"
                                                       data-slider-max="500" data-slider-step="1"
                                                       data-slider-value="20">
												<?= $form->field( $model, 'like_total' )->hiddenInput( [ 'id' => 'like-total' ] )->label( false ) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin: 20px 0;">
                                            <label class="form-label">
                                                Số like giữa 2 phiên (1 phút)
                                            </label>
                                            <div class="form-group speed-input"
                                                 style="padding: 0 20px;margin-top: 30px;">
                                                <input id="speed-slider" type="text" title="" data-slider-min="5"
                                                       data-slider-max="50" data-slider-step="1" data-slider-value="5">
												<?= $form->field( $model, 'speed' )->hiddenInput( [ 'id' => 'speed' ] )->label( false ) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-1">
                                            Cảm xúc
                                        </label>
                                        <div class="emotion-box" style="text-align: center;">
                                            <input name="emotion[]" type="checkbox" class="filled-in" id="like"
                                                   value="LIKE">
                                            <label for="like">
                                                <img src="/uploads/core/images/like.gif" style="width: 60px;"
                                                     data-toggle="tooltip"
                                                     data-original-title="Thích">
                                            </label>
                                            <input name="emotion[]" type="checkbox" class="filled-in" id="love"
                                                   value="LOVE">
                                            <label for="love">
                                                <img src="/uploads/core/images/love.gif"
                                                     data-toggle="tooltip" title="" data-original-title="Yêu thích">
                                            </label>
                                            <input name="emotion[]" type="checkbox" class="filled-in" id="haha"
                                                   value="HAHA">
                                            <label for="haha">
                                                <img src="/uploads/core/images/haha.gif"
                                                     data-toggle="tooltip" title="" data-original-title="Cười Lớn">
                                            </label>
                                            <input name="emotion[]" type="checkbox" class="filled-in" id="wow"
                                                   value="WOW">
                                            <label for="wow">
                                                <img src="/uploads/core/images/wow.gif"
                                                     data-toggle="tooltip" title="" data-original-title="Ngạc Nhiên">
                                            </label>
                                            <input name="emotion[]" type="checkbox" class="filled-in" id="sad"
                                                   value="SAD">
                                            <label for="sad">
                                                <img src="/uploads/core/images/sad.gif"
                                                     data-toggle="tooltip" title="" data-original-title="Buồn">
                                            </label>
                                            <input name="emotion[]" type="checkbox" class="filled-in" id="angry"
                                                   value="ANGRY">
                                            <label for="angry">
                                                <img src="/uploads/core/images/angry.gif"
                                                     data-toggle="tooltip" title="" data-original-title="Phẫn Nộ">
                                            </label>
                                        </div>
                                    </div>
									<?= $form->field( $model, 'emotion' )->hiddenInput( [ 'id' => 'emotions' ] )->label( false ) ?>
                                </div>
                                <div class="modal-footer">
									<?= $form->field( $model, 'post_id' )->hiddenInput()->label( false ) ?>
                                    <button class="btn btn-danger" type="submit" onclick="load()"
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
                    <h2 class="title pull-left">Lịch sử tăng like bài viết</h2>
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
                                        <th>Post ID</th>
                                        <th>Số share cần tăng</th>
                                        <th>Số share thành công</th>
                                        <th>Hình thức</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach ( $buff_likes as $key => $value ): ?>
                                        <tr>
                                            <td style="text-align: center"><?= $key + 1 ?></td>
                                            <td>
                                                <a target="_blank"
                                                   href="https://www.facebook.com/<?= explode( '_', $value['post_id'] )['0'] ?>">
                                                    <img style="height: 40px;border-radius: 21px;width: 40px;"
                                                         src="https://graph.facebook.com/<?= explode( '_', $value['post_id'] )['0'] ?>/picture?type=large">
                                                </a>
                                            </td>
                                            <td>
                                                <a target="_blank"
                                                   href="https://www.facebook.com/<?= $value['post_id'] ?>">
													<?= $value['post_id'] ?>
                                                </a>
                                            </td>
                                            <td><?= $value['like_total'] . ' like' ?></td>
                                            <td><?= ( $value['liked'] ? $value['liked'] : 0 ) . ' like' ?></td>
                                            <td>
												<?php if ( ! $value['free'] ): ?>
                                                    <span style="color: blue;">
                                                <span class="fa fa-paypal"></span>
                                                Trả phí
                                            </span>
												<?php endif; ?>
												<?php if ( $value['free'] ): ?>
                                                    <span style="color: coral;">
                                                <span class="fa fa-gift"></span>
                                                    Miễn phí
                                                </span>
												<?php endif; ?>
                                            </td>
                                            <td>
												<?php if ( $value['liked'] >= $value['like_total'] ): ?>
                                                    <span style="color: blue;">
                                                    <span class="fa fa-check"></span>
                                                    Hoàn thành
                                                </span>
												<?php endif; ?>
												<?php if ( $value['liked'] < $value['like_total'] ): ?>
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