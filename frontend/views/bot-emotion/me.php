<?php

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\assets\BotEmotionAsset;

BotEmotionAsset::register( $this );

/* @var $this yii\web\View */
/* @var $buff_emotions \common\models\BotEmotion */
/* @var $facebook_accounts array common\models\FacebookAccount */

$this->title = 'Bot Emotions';

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
                            <h2 class="panel-title">Like tương tác fanpage/profile</h2>
                        </div>
						<?php $form = ActiveForm::begin( [ 'id' => 'buff-like-form' ] ); ?>
                        <div class="modal-body">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Trợ giúp:</strong>
                                Nếu chưa có UID hãy dùng công tụ <span class="fa fa-search"></span> tìm kiếm.
                                <a target="_blank" href="<?= Url::to( [ 'search/index' ] ) ?>">Tại đây</a>
                            </div>
                            <label class="form-label">Giới thiệu</label>
                            <div class="form-group">
                                Đây là dịch vụ giúp bạn tăng like tự nhiên mỗi khi post bài đăng lên Facebook cá
                                nhân hoặc Fanpage, với dịch vụ này của hacklike.vn, bạn sẽ không cần phải truy
                                cập vào trang web để hack like mà vẫn nhận được like từ mọi người, miễn là bạn
                                cứ đăng bài lên FB, và mọi người sẽ like cho FB của bạn một cách tự nhiên, giống
                                như like mà bạn nhận được một cách tự nguyện từ bạn bè, fan hâm mộ.
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
                                Dành cho <b><span style="color: red;"><b>Mọi thành viên</b></span></b>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="active">
                                    <th style="width: 100px;">
                                        Thông tin
                                    </th>
                                    <th>
                                        <span style="color: red;">Nội dung</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="info">
                                    <td>
                                        <b>Giới thiệu</b>
                                    </td>
                                    <td>
                                        Đây là dịch vụ giúp bạn tăng like tự nhiên mỗi khi post bài đăng lên Facebook cá
                                        nhân hoặc Fanpage, với dịch vụ này của hacklike.vn, bạn sẽ không cần phải truy
                                        cập vào trang web để hack like mà vẫn nhận được like từ mọi người, miễn là bạn
                                        cứ đăng bài lên FB, và mọi người sẽ like cho FB của bạn một cách tự nhiên, giống
                                        như like mà bạn nhận được một cách tự nguyện từ bạn bè, fan hâm mộ.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Đối tượng</b>
                                    </td>
                                    <td>
                                        Dành cho <b><span style="color: red;"><b>Mọi thành viên</b></span></b>
                                    </td>
                                </tr>
                                <tr class="warning">
                                    <td>
                                        <b>Thời gian nhận like</b>
                                    </td>
                                    <td>
                                        Sau khi đăng bài lên Facebook đã cài gói, like sẽ tăng dần và chầm chậm theo mỗi
                                        phút, trong vòng 30 đến 60 phút, sẽ tăng đủ số like tối đa do bạn thiết lập
                                        <span style="color: red;">bạn có thể thiết lập số like tối đa nhận được trên mỗi bài
                                            đăng khi đăng ký dịch vụ trong khoảng 100 like đến 5.000 like</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Giới hạn</b>
                                    </td>
                                    <td>
                                        - <span style="color: red;">Không giới hạn</span> số lượng Fan-page/ FB cá nhân
                                        thêm vào<br>
                                        - Giới hạn <span style="color: red;">15 bài đăng</span> trên cùng 1 Fanpage/ FB
                                        cá nhân
                                        trong ngày, reset vào lúc 24h hàng ngày, mỗi bài đăng trong ngày ít nhất phải
                                        đăng cách nhau 40 phút để đạt số like tối da mong muốn
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Điều kiện</b>
                                    </td>
                                    <td>
                                        - Bài đăng trên Fanpage/ FB cá nhân chia sẻ với
                                        <span style="color: red;">Mọi người</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Sử dụng</b>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">
                                                Nhập link/ID Facebook cá nhân hoặc Fanpage (nên nhập ID facebook để
                                                tránh bị lỗi, vì một số link chúng tôi có thể không nhận diện được)
                                            </label>
                                            <input class="form-control" id="uid-facebook"
                                                   type="text" name="fanpage" placeholder="Nhập link facebook hoặc ID">
                                            <input type="hidden" name="action" value="1" class="text-input">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="button" onclick="check_uid()">
                                                Kiểm tra
                                            </button>
                                        </div>
                                        <div class="loading-search" style="text-align: center; display: none;">
                                            <img style="width: 50px;" src="/uploads/core/images/loading-search.gif"
                                                 alt="">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
						<?php ActiveForm::end(); ?>
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
                            <h2 class="panel-title">Like tương tác fanpage/profile</h2>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-close"></span>
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
                            <div class="form-group">
                                <button class="btn btn-success" type="button" onclick="check_uid_step_2()">
                                    Kiểm tra
                                </button>
                            </div>
                            <div class="loading-search" style="text-align: center; display: none;">
                                <img style="width: 50px;" src="/uploads/core/images/loading-search.gif"
                                     alt="">
                            </div>
                            <br>
							<?php $form = ActiveForm::begin( [ 'id' => 'buff-like-form' ] ); ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr class="active">
                                    <th>Đối tượng</th>
                                    <th>Kết quả kiểm tra</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="active">ID:</td>
                                    <td>
                                        <b class="uid-result"></b>
										<?= $form->field( $model, 'uid' )->hiddenInput( [ 'id' => 'uid' ] )->label( false ) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="active">Tên Fanpage/Profile:</td>
                                    <td>
                                        <b><span class="name-result" style="color: red;"></span></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="active">Thời gian mua like:</td>
                                    <td class="info">
										<?= $form->field( $model, 'months' )->dropDownList(
											[
												'1'  => '1 tháng',
												'3'  => '3 tháng',
												'6'  => '6 tháng',
												'12' => '12 tháng'
											]
										)->label( false ) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="active">Tiền cần thanh toán:</td>
                                    <td>
                                        <b><span style="color: red;">35000 VNĐ</span></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="active">Số dư tài khoản:</td>
                                    <td>
                                        <center><b>0 VNĐ</b><br>Chú ý: tiền cần thanh toán phải nhỏ hơn hoặc bằng số
                                            dư tài khoản
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="active">Ghi chú nếu có:</td>
                                    <td class="info">
                                        <input title="" type="text" class="form-control" name="info" value="">
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>Hành động:</td>
                                    <td>
                                        <button type="submit" class="btn btn-danger" onclick="load()">
                                            THANH TOÁN VÀ HOÀN THÀNH
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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