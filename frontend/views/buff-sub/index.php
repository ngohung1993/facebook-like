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
/* @var $model \common\models\BuffLike */
/* @var $buff_subs array common\models\BuffSub */

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

    .form-label {
        font-weight: bold;
    }

    .slider-selection {
        background: #BABABA;
    }

    .slider-horizontal {
        width: 100% !important;
    }

</style>

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

<div class="col-lg-12">
    <div class="alert alert-primary alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Khuyên dùng:</strong>
        Hay đảm bảo tài khoản của bạn ở chế độ công khai <span class="fa fa-globe"></span> trước khi bắt đầu sử dụng
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
                <div class="col-md-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Mua theo dõi thực facebook</h2>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-close"></span>
                                </button>
                                <strong>Trợ giúp:</strong>
                                Nếu chưa có UID hãy dùng công tụ <span class="fa fa-search"></span> tìm kiếm.
                                <a target="_blank" href="<?= Url::to( [ 'search/index' ] ) ?>">Tại đây</a>
                            </div>
                            <label class="form-label">Giới thiệu</label>
                            <div class="form-group">
                                Là dịch vụ giúp bạn tăng người theo dõi thực trên tài khoản Facebook cá nhân với
                                số lượng lớn. Người theo dõi đều có nguồn gốc tại Việt Nam và đều là các tài
                                khoản người dùng thực đang hoạt động. Mức độ tương tác của người theo dõi cao
                                gần bằng tương tác với bạn bè. Người theo dõi có thể nhìn thấy bài đăng hàng
                                ngày của bạn, có thể like và comment tương tác với Facebook của bạn. Giúp cho
                                tài khoản cá nhân của bạn có thêm nhiều người quan tâm, tăng Fan cho hot Face,
                                người nổi tiếng và tăng hiệu quả cho các bạn bán hàng online.
                            </div>
                            <label class="form-label">Đối tượng</label>
                            <div class="form-group">
                                Dành cho
                                <span style="color: red;">
                                    Thành viên và đại lý (trên giá khác nhau)
                                </span>
                            </div>
                            <label class="form-label">Thời gian</label>
                            <div class="form-group">
                                Sau khi đặt mua, hệ thống sẽ tự động chạy người theo dõi trên tài khoản Facebook
                                đã đặt. Thời gian có thể
                                <span style="color: red;">dao động từ 5 phút đến 72h</span>
                                để hoàn thành.<br>
                                - 5 phút để hoàn thành các kèo sub 5000 người trở xuống<br>
                                - Khoảng 1 ngày để hoàn thành các kèo sub 5500 đến 10000 người<br>
                                - Khoảng 2 ngày để hoàn thành các kèo sub trên 10.500 đến 15.000 người<br>
                                - Khoảng 3 ngày để hoàn thành các kèo sub trên 15.500 đến 20.000 người<br>
                                - Chạy được mọi kèo lỗi kết bạn<br>
                                - Với các đơn hàng không thể chạy đủ sub vì gốc sub quá cao hoặc đã được đặt mua
                                trên web nhiều lần trong một thời gian ngắn, bạn được lựa chọn hoàn lại tiền
                                bằng lượng sub chưa chạy đủ.
                            </div>
                            <label class="form-label">Giới hạn</label>
                            <div class="form-group">
                                - Đặt mua
                                <span style="color: red">
                                    Tối thiểu 500 theo dõi và tối đa 20000 người theo dõi
                                </span>
                                trên cùng 1 FB cá nhân.
                            </div>
                            <label class="form-label">Điều kiện</label>
                            <div class="form-group">
                                - Phải cài đặt năm sinh trong thông tin cá nhân trên Facebook của bạn sao cho đủ
                                18 tuổi tính đến năm hiện tại (tức là năm sinh phải từ 1998 về trước)<br>
                                - Bạn cần thiết lập mục <span style="color:red;">Cài đặt tài khoản</span>
                                trong Facebook của bạn ở phần
                                <span style="color:red;">Bài viết công khai</span> như sau:<br>
                                <span style="color:red;">Ai có thể theo dõi tôi</span> chỉnh thành
                                <span style="color: red;">Mọi người</span><br>
                                - Bạn cần thiết lập mục <span style="color:red;">Cài đặt tài khoản</span>
                                trong Facebook của bạn ở phần <span style="color:red;">Quyền riêng tư</span>
                                như sau:<br>
                                <span style="color:red;">
                                    Ai có thể liên hệ với tôi (Ai có thể gửi lời mời kết bạn đến bạn)
                                </span> chỉnh thành
                                <span style="color:red;">Mọi người</span>
                            </div>
                            <label class="form-label">Mua người theo dõi</label>
                            <div class="form-group">
                                <input id="uid-facebook" class="form-control" type="text"
                                       placeholder="Nhập link facebook hoặc UID">
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-success" onclick="check_uid()">
                                    Kiểm tra
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
                <div class="col-md-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Đặt mua người theo dõi</h2>
                        </div>
						<?php $form = ActiveForm::begin(); ?>
                        <div class="modal-body">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Trợ giúp:</strong>
                                Nếu chưa có UID hãy dùng công tụ <span class="fa fa-search"></span> tìm kiếm.
                                <a target="_blank" href="<?= Url::to( [ 'search/index' ] ) ?>">Tại đây</a>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="inputSuccess1">Nhập link fanpage / Profile
                                    hoặc ID trang (nên nhập ID facebook để tránh bị lỗi, vì một số link chúng
                                    tôi có thể không nhận diện được)</label>
                                <input class="form-control" id="uid-facebook-2" type="text"
                                       placeholder="Nhập link facebook hoặc ID">
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button class="btn btn-success" type="button" onclick="check_uid_step_2()">
                                    Kiểm tra
                                </button>
                            </div>
                            <div class="loading-search" style="text-align: center; display: none;">
                                <img style="width: 50px;" src="/uploads/core/images/loading-search.gif">
                            </div>
                            <div class="error-check alert alert-danger" style="display: none;">
                                Kết quả kiểm tra cho thấy bạn đã nhập một link cá nhân không tồn tại hoặc nhập sai cấu
                                trúc link. Link facebook cá nhân đúng có cấu trúc dạng: <b>https://facebook.com/tên-profile</b><br>
                            </div>
                            <div class="row form-detail">
                                <div class="col-md-8 col-md-offset-2">
                                    <label class="form-label">
                                        Kết quả kiếm tra (UID hoặc đường dẫn):
                                        <a class="link-or-uid" target="_blank" href=""></a>
                                    </label>
                                    <div class="form-group">
                                        <div class="row" style="text-align: center;">
                                            <div class="col-md-6">
                                                <span style="color:red;">ID:</span>
                                                <b class="uid-result"></b>
                                            </div>
                                            <div class="col-md-6">
                                                <span style="color:red;">Tên:</span>
                                                <b class="name-result"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="form-label">
                                        Cần mua
                                    </label>
                                    <div class="form-group">
                                        <div class="form-group" style="padding: 0 20px;margin-top: 30px;">
                                            <input id="subscribe-total-slider" type="text" title="" data-slider-min="20"
                                                   data-slider-max="100" data-slider-step="1" data-slider-value="20">
											<?= $form->field( $model, 'subscribe_total' )->hiddenInput( [ 'id' => 'subscribe-total' ] )->label( false ) ?>
                                        </div>
                                        <div style="text-align: center;">
                                            <span>Kéo thanh cuộn sang phải hoặc trái để tùy chỉnh số sub muốn mua</span>
                                        </div>
                                    </div>
                                    <label class="form-label">
                                        Số sub giữa 2 phiên (1 phút)
                                    </label>
                                    <div class="form-group">
                                        <div class="form-group" style="padding: 0 20px;margin-top: 30px;">
                                            <input id="speed-slider" type="text" title="" data-slider-min="5"
                                                   data-slider-max="50" data-slider-step="1" data-slider-value="5">
											<?= $form->field( $model, 'speed' )->hiddenInput( [ 'id' => 'speed' ] )->label( false ) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-1">
                                            Tiền cần thanh toán
                                        </label>
                                        <p style="color: red;text-align: center;">
                                            <b>
                                        <span data-price="100" data-total="2000" class="price">
                                            2,000
                                        </span>
                                                VNĐ
                                            </b>
                                        </p>
                                    </div>
                                    <label class="form-label" for="field-1">
                                        Số dư tài khoản
                                    </label>
                                    <div class="form-group" style="text-align: center;">
                                        <b>
                                    <span class="account-balance"
                                          data-value="<?= $user['money'] ? $user['money'] : 0 ?>">
                                        <?= number_format( $user['money'], 0, ',', ',' ) ?>
                                    </span>
                                            VNĐ
                                        </b>
                                        <br>
                                        Chú ý: Tiền cần thanh toán phải nhỏ hơn hoặc bằng số dư tài khoản
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button class="btn btn-danger" type="submit"
                                                style="text-transform: uppercase;border-radius: 25px;"
                                                onclick="check_out()">
                                            <span class="fa fa-paypal"></span>
                                            Thanh toán và khởi chạy
                                        </button>
                                    </div>
                                    <div class="not-enough-money alert alert-warning alert-dismissible fade in"
                                         style="text-align: center;display: none;">
										<?= $form->field( $model, 'uid' )->hiddenInput()->label( false ) ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span class="fa fa-close"></span>
                                        </button>
                                        <strong>Cảnh bảo:</strong>
                                        Tài khoản không đủ để thanh toán. Vui lòng chọn gói cước thấp hơn hoặc nạp
                                        thêm tiền
                                        <a target="_blank" href="<?= Url::to( [ 'search/index' ] ) ?>"> tại đây</a>
                                    </div>
                                </div>
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