<?php

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\BotEmotionAsset;

BotEmotionAsset::register( $this );

/* @var $this yii\web\View */
/* @var $user \common\models\User */
/* @var $model \common\models\BotEmotion */
/* @var $buff_emotions \common\models\BotEmotion */
/* @var $facebook_accounts array common\models\FacebookAccount */

$this->title = 'Bot thả cảm xúc bạn bè';

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

    table td {
        line-height: 2.5 !important;
        text-align: center !important;
    }

    table td {
        text-align: center;
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
            <span class="fa fa-close"></span>
        </button>
        <strong>Khuyên dùng:</strong>
        Hay đảm bảo tài khoản của bạn ở chế độ công khai <span class="fa fa-globe"></span> trước khi bắt đầu sử dụng hệ
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
                            <h2 class="panel-title">BOT thả cảm xúc bạn bè</h2>
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
                                Dịch vụ giúp tăng mạnh gấp 5 đến 10 lần tương tác của bạn và bạn bè (người bạn
                                đang theo dõi) của bạn với nhau trong thời gian nhanh nhất và tiết kiệm thời
                                gian, chi phí cho bạn.
                                <br>
                                <span style="color: red;">Nội dung dịch vụ:</span>
                                Mỗi khi bạn bè hay người bạn đang theo dõi đăng bài lên
                                Facebook, Tài khoản Facebook của bạn sẽ tự động biết và Like hoặc bày tỏ cảm xúc
                                vào bài đăng đó. Người được bạn Like cảm xúc sẽ nhận được thông báo lên tường
                                của họ. Mỗi ngày, bạn sẽ gần như Like cảm xúc cho tất cả bạn bè, người đang theo
                                dõi của mình hoàn toàn tự động và kịp thời khi họ đăng bài. Bạn sẽ dần được mọi
                                người chú ý và trả Like lại, từ đó tương tác sẽ tăng lên chóng mặt.
                            </div>
                            <label class="form-label">Đối tượng</label>
                            <div class="form-group">
                                <span style="color: red;">
                                    Bất kỳ ai cũng có thể sử dụng dịch vụ để tăng tương tác thực và like tự nhiên. Các bạn bán hàng online sẽ tăng lượng khách,
                                    tăng đơn hàng đáng kể khi dùng dịch vụ.
                                </span>
                            </div>
                            <label class="form-label">Tốc độ</label>
                            <div class="form-group">
                                Sau khi bạn bè bạn đăng bài, chỉ trong vòng
                                <span style="color: red;">
                                    vài chục giây đến ba bốn phút.
                                </span>
                                Tài khoản Facebook của bạn sẽ bày tỏ cảm xúc (Do bạn cài đặt trước) lên bài đăng của họ
                                tự động
                            </div>
                            <label class="form-label">Chọn tài khoản cài đặt tính năng này</label>
                            <div class="form-group">
                                <span>
                                    Chọn tài khoản Facebook bạn muốn cài đặt BOT cảm xúc. Nếu chưa có hãy thêm tài
                                    khoản mới <a href="<?= Url::to( [ 'facebook/index' ] ) ?>">tại đây</a> để tiếp tục.
                                </span>
                                <div class="form-group">
                                    <select title="" id="access-token" class="form-control">
										<?php foreach ( $facebook_accounts as $key => $value ): ?>
                                            <option data-uid="<?= $value['uid'] ?>"
                                                    value="<?= $value['access_token'] ?>">
												<?= $value['name'] ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="button" class="btn btn-success" onclick="check_uid()">
                                    Tiếp tục
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
                            <h2 class="panel-title">BOT thả cảm xúc bạn bè</h2>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Chọn tài khoản cài đặt tính năng này</label>
                            <div class="form-group">
                                <span>
                                    Chọn tài khoản Facebook bạn muốn cài đặt BOT cảm xúc. Nếu chưa có hãy thêm tài
                                    khoản mới <a href="<?= Url::to( [ 'facebook/index' ] ) ?>">tại đây</a> để tiếp tục.
                                </span>
                                <div class="form-group">
                                    <select title="" id="access-token" class="form-control">
										<?php foreach ( $facebook_accounts as $key => $value ): ?>
                                            <option value="<?= $value['access_token'] ?>">
												<?= $value['name'] ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button class="btn btn-success" type="button" onclick="check_uid_step_2()">
                                    Kiểm tra
                                </button>
                            </div>
                            <div class="loading-search" style="text-align: center; display: none;">
                                <img style="width: 50px;" src="/uploads/core/images/loading-search.gif">
                            </div>
							<?php $form = ActiveForm::begin( [ 'id' => 'bot-emotion-friends' ] ); ?>
                            <div class="row">
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
										<?= $form->field( $model, 'uid' )->hiddenInput( [ 'id' => 'uid' ] )->label( false ) ?>
										<?= $form->field( $model, 'access_token' )->hiddenInput( [ 'id' => 'access-token-result' ] )->label( false ) ?>
                                    </div>
                                    <label class="form-label">
                                        Thời gian mua
                                    </label>
                                    <div class="form-group">
										<?= $form->field( $model, 'months' )->dropDownList(
											[
												'1'  => '1 tháng',
												'3'  => '3 tháng',
												'6'  => '6 tháng',
												'12' => '12 tháng'
											], [
												'id'       => 'months',
												'onchange' => 'payment()'
											]
										)->label( false ) ?>
                                    </div>
                                    <label class="active">Loại cảm xúc</label>
                                    <div class="form-group">
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
										<?= $form->field( $model, 'emotions' )->hiddenInput( [ 'id' => 'emotions' ] )->label( false ) ?>
                                    </div>
                                    <label class="form-label">
                                        Chi phí
                                    </label>
                                    <div class="form-group">
                                        <div style="text-align: center;">
                                            <b>
                                                <span style="color:red;">
                                                    <span data-price="40000" data-total="40000" class="price">
                                                        40,0000
                                                    </span>
                                                    VNĐ
                                                </span>
                                            </b>
                                        </div>
                                    </div>
                                    <label class="form-label">
                                        Số dư
                                    </label>
                                    <div class="form-group">
                                        <div style="text-align: center;">
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
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button class="btn btn-danger" type="button"
                                                style="text-transform: uppercase;border-radius: 25px;"
                                                onclick="check_out()">
                                            <span class="fa fa-paypal"></span>
                                            Thanh toán và khởi chạy
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="not-enough-money alert alert-warning alert-dismissible fade in" role="alert"
                                 style="text-align: center;display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-close"></span>
                                </button>
                                <strong>Cảnh bảo:</strong>
                                Tài khoản không đủ để thanh toán. Vui lòng chọn gói cước thấp hơn hoặc nạp
                                thêm tiền
                                <a target="_blank" href="<?= Url::to( [ 'search/index' ] ) ?>"> tại đây</a>
                            </div>
							<?php ActiveForm::end(); ?>
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
            <h2 class="title pull-left">Lịch sử bot thả cảm xúc bạn bè</h2>
        </header>
        <div class="content-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><span class="fa fa-sort-numeric-asc"></span></th>
                                <th>Avatar</th>
                                <th>UID</th>
                                <th>Số tháng sử dụng</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ( $buff_emotions as $key => $value ): ?>
                                <tr>
                                    <td style="text-align: center"><?= $key + 1 ?></td>
                                    <td>
                                        <img style="height: 40px;border-radius: 21px;width: 40px;"
                                             src="https://graph.facebook.com/<?= $value['uid'] ?>/picture?type=large">
                                    </td>
                                    <td>
                                        <a target="_blank" href="https://www.facebook.com/<?= $value['uid'] ?>">
											<?= $value['uid'] ?>
                                        </a>
                                    </td>
                                    <td><?= $value['months'] . ' tháng' ?></td>
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