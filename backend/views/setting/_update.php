<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\SettingAsset;

SettingAsset::register( $this );

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $images \common\models\Image */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="page-form">
	<?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-cog"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Settings' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
				<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ),
					[
						'class'   => 'btn btn-primary pull-right',
						'onclick' => 'getImages()',
					] ) ?>
            </div>
        </div>
    </div>
    <div id="wpbody-content" aria-label="Nội dung chính" tabindex="0" style="overflow: hidden;">
        <div class="wrap">
            <h1 class="wp-heading-inline">Chỉnh sửa cấu hình</h1>
            <hr class="wp-header-end">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;">
                        <div id="titlediv">
                            <div id="titlewrap">
								<?= $form->field( $model, 'title' )->textInput( [
									'maxlength'   => true,
									'placeholder' => 'Nhập tiêu đề tại đây'
								] )->label( 'Tiêu đề' ) ?>
                            </div>
                            <div class="inside">
                                <div class="form-group">
									<?= $form->field( $model, 'describe' )->textarea( [ 'id' => 'describe' ] ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                            <div id="submitdiv" class="postbox ">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Cài đặt</span>
                                </h2>
                                <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                        <div id="minor-publishing">
                                            <div id="misc-publishing-actions">
                                                <div class="misc-pub-section">
                                                    <div class="form-group">
														<?= $form->field( $model, 'key' )->textInput( [ 'disabled' => true ] ) ?>
                                                    </div>
                                                    <div class="form-group">
														<?= $form->field( $model, 'link' )->textInput() ?>
                                                    </div>
                                                    <div class="form-group">
														<?= $form->field( $model, 'status' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;">
                        <div id="titlediv">
                            <div class="inside">
                                <label style="font-weight: 600;" class="control-label" for="content">Hình ảnh</label>
                                <div id="list-img-temp" class="thumbnails ui-sortable" style="display: none">
                                    <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                        <div class="kv-file-content">
                                            <img src="" class="kv-preview-data file-preview-image">
                                        </div>
                                        <div class="file-thumbnail-footer">
                                            <div class="file-footer-caption">
                                                <span class="caption"></span>
                                            </div>
                                            <div class="file-upload-indicator">
                                            </div>
                                            <div class="file-actions">
                                                <div class="file-footer-buttons">
                                                    <button type="button" class="kv-file-zoom btn btn-xs btn-default"
                                                            onclick="deleteFile(event)">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="list-img" class="thumbnails ui-sortable">
									<?php if ( isset( $images ) ): foreach ( $images as $key => $value ): ?>
                                        <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                            <div class="kv-file-content">
                                                <img src="<?= $value['avatar'] ?>"
                                                     class="kv-preview-data file-preview-image">
                                            </div>
                                            <div class="file-thumbnail-footer">
                                                <div class="file-footer-caption" title="">
                                                    <a href="#" class="editable" data-name="image#title"
                                                       data-type="text"
                                                       data-pk="<?= $value['id'] ?>" data-title="Enter title"
                                                       data-url="<?= Url::to( [ 'ajax/edit-column' ] ) ?>">
														<?= $value['title'] ?>
                                                    </a>
                                                </div>
                                                <div class="file-upload-indicator">
                                                    <button type="button" class="btn btn-xs btn-default"
                                                            onclick="load_content_image(<?= $value['id'] ?>)"
                                                            data-toggle="modal" data-target="#content-image">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="file-actions">
                                                    <div class="file-footer-buttons">
                                                        <button type="button" class="btn btn-xs btn-default"
                                                                onclick="deleteFile(event)">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
									<?php endforeach; endif; ?>
                                </div>
                                <div class="spanButtonPlaceholder block-upload-item"
                                     style="position: relative; overflow: hidden;margin: 10px;">
                                    <p>(Click để tải ảnh<br> hoặc kéo thả ảnh vào đây)</p>
                                    <input class="kv-file-drop-zone" multiple="multiple" type="file" name="file">
                                </div>
                                <div class="droptext">
                                    Đăng ảnh thật nhanh bằng cách kéo và thả ảnh vào khung. Thay đổi vị trí của ảnh bằng
                                    cách kéo ảnh vào vị trí mà bạn muốn!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;">
                        <div id="titlediv">
                            <div class="inside">
                                <div class="form-group">
									<?= $form->field( $model, 'content' )->textarea( [ 'id' => 'content' ] ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group">
		<?= $form->field( $model, 'images' )->hiddenInput( [ 'id' => 'images' ] )->label( false ) ?>
    </div>
    <div class="form-group" style="margin-right: 10px;">
		<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [
			'class'   => 'btn btn-primary pull-right',
			'onclick' => 'getImages()',
		] ) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>

<div id="content-image" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Content Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link">Đường dẫn</label>
                            <input class="form-control" type="text" title="" id="link">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="describe-temp">Mô tả</label>
                            <input class="form-control" type="text" title="" id="describe-temp">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="describe">Nội dụng</label>
                            <textarea title="" name="" id="describe" cols="30" rows="10">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id-image">
                <button type="button" class="btn btn-primary" onclick="save_content_image()" data-dismiss="modal">
                    <i class="fa fa-check"></i>
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>