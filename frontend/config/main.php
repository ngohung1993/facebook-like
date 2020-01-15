<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

use \yii\web\Request;

$baseUrl = str_replace( '/frontend/web', '', ( new Request )->getBaseUrl() );

return [
	'id'                  => 'app-frontend',
	'basePath'            => dirname( __DIR__ ),
	'bootstrap'           => [ 'log' ],
	'controllerNamespace' => 'frontend\controllers',
	'components'          => [
		'request'      => [
			'csrfParam' => '_csrf-frontend',
			'baseUrl'   => $baseUrl,
		],
		'user'         => [
			'identityClass'   => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie'  => [ 'name' => '_identity-frontend', 'httpOnly' => true ],
		],
		'session'      => [
			// this is the name of the session cookie used for login on the frontend
			'name' => 'advanced-frontend',
		],
		'log'          => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => [ 'error', 'warning' ],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'urlManager'   => [
			'baseUrl'         => '/',
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'rules'           => [
//				'<category_slug>/<content_slug>' => 'site/view',
//				'<category_slug>'                => 'site/view',
//				''                               => 'site/index',
			],
		],
		'view'         => [
			'class'            => '\mirocow\minify\View',
			'base_path'        => '@app/web',
			'minify_path'      => '@app/web/minify',
			'minify_css'       => true,
			'minify_js'        => true,
			'minify_html'      => true,
			'js_len_to_minify' => 1000,
			'force_charset'    => 'UTF-8',
			'expand_imports'   => true,
			'theme'            => [
				'basePath' => '@app/themes/myapp',
				'baseUrl'  => '@app/themes/myapp',
				'pathMap'  => [
					'@app/modules' => '@app/themes/myapp/modules',
				],
			],

		],
	],
	'params'              => $params,
];
