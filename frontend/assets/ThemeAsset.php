<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Vietlv <levanviet_t58@hus.eud.vn>
 * @since 1.0
 */
class ThemeAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'complete-admin/assets/plugins/pace/pace-theme-flash.css',
		'complete-admin/assets/plugins/bootstrap/css/bootstrap.min.css',
		'complete-admin/assets/fonts/font-awesome/css/font-awesome.css',
		'complete-admin/assets/css/animate.min.css',
		'complete-admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css',
		'complete-admin/assets/css/style.css',
		'complete-admin/assets/css/responsive.css',
		'css/customer.css',
		'components/bootstrap-slider/css/bootstrap-slider.css',
	];
	public $js = [
		'complete-admin/assets/js/jquery.easing.min.js',
		'complete-admin/assets/plugins/bootstrap/js/bootstrap.min.js',
		'complete-admin/assets/plugins/pace/pace.min.js',
		'complete-admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js',
		'complete-admin/assets/js/scripts.js',
		'components/bootstrap-slider/js/bootstrap-slider.js',
		'js/setting.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
