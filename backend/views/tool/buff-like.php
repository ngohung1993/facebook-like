<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/6/2018
 * Time: 12:38 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\TableAsset;
use backend\assets\SweetAlertAsset;

TableAsset::register( $this );
SweetAlertAsset::register( $this );

/* @var $model \common\models\BuffLike */
/* @var $buff_likes array \common\models\BuffLike */

$emotions = [ 'LOVE' => 'LOVE', 'LIKE' => 'LIKE' ];

?>

<style>

    .emotion-box label {
        margin-right: 20px;
    }

    .emotion-box img {
        width: 60px;
    }

</style>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb">
                <i class="fa fa-tags"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Tăng lượt thích' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buff-like">
                    <span class="fa fa-shopping-cart"></span>
                    Mua like
                </button>
            </div>
        </div>
    </div>
</section>

<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-buff-likes" class="table table-bordered table-striped dataTable">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            <input title="" type="checkbox" class="minimal">
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">
                                            UID
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Like cần tăng
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Like hoàn thành
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Tốc độ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Trạng thái
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Thao tác
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach ( $buff_likes as $key => $value ): ?>
                                        <tr>
                                            <th>
                                                <input title="" type="checkbox" class="minimal">
                                            </th>
                                            <td>
                                                <a target="_blank" href="//fb.com/<?= $value['post_id'] ?>">
													<?= $value['post_id'] ?>
                                                </a>
                                            </td>
                                            <td><?= $value['like_total'] . ' Like' ?></td>
                                            <td><?= $value['liked'] . 'Like' ?></td>
                                            <td><?= $value['speed'] . ' Like/phút' ?></td>
                                            <td>
												<?php if ( $value['liked'] == $value['like_total'] ): ?>
                                                    <span style="color: blue;">Hoàn thành</span>
												<?php endif; ?>
												<?php if ( $value['liked'] != $value['like_total'] ): ?>
                                                    <span style="color: coral;">Đang chạy</span>
												<?php endif; ?>
                                            </td>
                                            <td>
												<?= Html::a( Yii::t( 'backend', '<i class="fa fa-trash-o"></i>' ), [
													'delete',
													'id' => $value->id
												], [
													'data' => [
														'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
														'method'  => 'post',
													],
												] ) ?>
                                            </td>
                                        </tr>
									<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay" style="display: none">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span class="fa fa-close"></span>
                </button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="buff-like" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<?php $form = ActiveForm::begin( [ 'id' => 'buff-like-form' ] ); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">

				<?= $form->field( $model, 'post_id' )->textInput( [ 'placeholder' => 'Status định dạng id sau Idfb_Idpost | Ảnh đinh dạng id sau Idpost' ] ) ?>

				<?= $form->field( $model, 'like_total' )->textInput( [ 'placeholder' => 'Nhập số like cần mua' ] ) ?>

				<?= $form->field( $model, 'speed' )->textInput( [ 'placeholder' => 'Nhập số like giữa 2 phiên' ] ) ?>

                <div class="form-group">
                    <label for="package-vip">Cảm xúc:</label><br>
                    <div class="emotion-box">
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
                <button type="button" class="btn btn-primary" onclick="after_submit()">
                    <i style="display: none;" class="load-submit fa fa-refresh fa-spin"></i>
                    Xác nhận
                </button>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#table-buff-likes').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        })
    });
</script>