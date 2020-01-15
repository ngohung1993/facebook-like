<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MarkdownAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'theme/css/plugins/bootstrap-markdown/bootstrap-markdown.min.css'
	];
	public $js = [
		'theme/js/plugins/bootstrap-markdown/bootstrap-markdown.js',
		'theme/js/plugins/bootstrap-markdown/markdown.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
