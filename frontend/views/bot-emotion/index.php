<?php

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\base\BotEmotionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

	.modal-footer {
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
			<span aria-hidden="true">×</span>
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

<div class="col-lg-12">
	<section class="box">
		<div class="content-body" style="padding-top: 15px;">
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h2 class="panel-title">Tăng like bài viết</h2>
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
							<label class="form-label" for="field-1">Post ID</label>
							<?= $form->field( $model, 'post_id', [
								'options'       => [ 'class' => 'form-group has-feedback' ],
								'inputTemplate' => "{input}<span class='glyphicon glyphicon-qrcode form-control-feedback'></span>"
							] )->textInput( [ 'placeholder' => 'Status định dạng id như sau uid_postid | Ảnh định dạng id như sau postid' ] )->label( false ) ?>
							<div class="row">
								<div class="col-md-12">
									<label class="form-label">Số like cần mua</label>
									<div class="form-group like-total-input" style="padding: 0 20px;">
										<div class="controls">
											<div id="like-total-input"
											     class="slider slider-primary ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
											     data-min="10" data-max="2000" data-value="10">
												<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"></div>
												<span class="ui-slider-handle ui-state-default ui-corner-all">
                                                    <span class="ui-label">10</span>
                                                </span>
											</div>
										</div>
									</div>
									<?= $form->field( $model, 'like_total' )->hiddenInput( [ 'id' => 'like-total' ] )->label( false ) ?>
								</div>
								<div class="col-md-12" style="margin: 20px 0;">
									<label class="form-label">
										Số like giữa 2 phiên (1 phút)
									</label>
									<div class="form-group speed-input" style="padding: 0 20px;">
										<div class="controls">
											<div class="slider slider-danger ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
											     data-min="5" data-max="100" data-value="5">
												<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"></div>
												<span class="ui-slider-handle ui-state-default ui-corner-all">
                                                    <span class="ui-label">5</span>
                                                </span>
											</div>
										</div>
									</div>
									<?= $form->field( $model, 'speed' )->hiddenInput( [ 'id' => 'speed' ] )->label( false ) ?>
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
							<div class="form-group">
								<label class="form-label" for="field-1">
									Tiền cần thanh toán
								</label>
								<p style="color: red;text-align: center;"><b>35000 VNĐ</b></p>
							</div>
							<div class="form-group">
								<label class="form-label" for="field-1">
									Số dư tài khoản
								</label>
								<p style="text-align: center;"><b>0 VNĐ</b></p>
								<div style="text-align: center;">
									<span>Chú ý: tiền cần thanh toán phải nhỏ hơn hoặc bằng số dư tài khoản</span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" type="submit" onclick="load()">
								<span class="fa fa-arrow-up"></span>
								Tăng ngay
							</button>
						</div>
						<?php ActiveForm::end(); ?>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h2 class="panel-title">HƯỚNG DẪN LẤY LINK</h2>
						</div>
						<div class="panel-body" style="min-height: 509px;">
							Bạn truy cập vào <span style="color: blue">facebook</span> và tìm đến trang cá nhân hoặc
							Fanpage có bài đăng, bình luận cần tăng like (Bài đăng có thể là status trạng thái, hình
							ảnh, video, album... và bình luận nằm trên đó). Bạn lấy link bài đăng cần tăng like bằng
							cách bấm vào phần thời gian post bài hiển thị dưới tên tài khoản người đã post như hình
							dưới:<br>
							<img class="img-responsive" src="http://hacklike.vn/img/hack-like-stt-fanpage.png"
							     alt="hack like stt, tang like status, hack nhiều like status"
							     title="hack like stt, tang like status, hack nhiều like status">
							<br>
							Sau đó, chờ trình duyệt chuyển trang thì bạn copy toàn bộ địa chỉ (url) trên thanh địa chỉ
							của trình duyệt, đó chính là địa chỉ bài đăng (comment) facebook bạn cần lấy. Sau đó bạn dán
							nội dung vừa copy vào ô <i>Nhập link hoặc ID bài đăng FB vào đây</i> (phía bên trên) rồi
							chọn nút <b>Tiếp tục</b>.
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
								<th>Post ID</th>
								<th>Số share cần tăng</th>
								<th>Số share thành công</th>
								<th>Trạng thái</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ( $buff_likes as $key => $value ): ?>
								<tr>
									<td style="text-align: center"><?= $key + 1 ?></td>
									<td>
										<a target="_blank" href="https://www.facebook.com/<?= $value['post_id'] ?>">
											<?= $value['post_id'] ?>
										</a>
									</td>
									<td><?= $value['like_total'] . ' like' ?></td>
									<td><?= ( $value['liked'] ? $value['liked'] : 0 ) . ' like' ?></td>
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