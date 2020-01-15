<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TableAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'components/datatables.net-bs/css/dataTables.bootstrap.min.css',
	];
	public $js = [
		'components/datatables.net/js/jquery.dataTables.min.js',
		'components/datatables.net-bs/js/dataTables.bootstrap.min.js',
		'js/tool.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
