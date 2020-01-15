<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\FunctionHelper;
use frontend\assets\ThemeAsset;

ThemeAsset::register( $this );

$favicon = FunctionHelper::get_images_by_photo_location_key( 'favicon', 1 )['avatar'];

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=0"/>
        <link rel="icon" href="<?= $favicon ?>" type="image/x-icon">

        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>

		<?= Html::csrfMetaTags() ?>
        <title><?= Html::encode( $this->title ) ?></title>
		<?php $this->head() ?>

        <style>

            .top-navigation .nav > li a:hover, .top-navigation .nav > li a:focus {
                background: rgba(255, 255, 255, 0.1) !important;
            }

            .nav-blog a {
                color: #fff !important;
                font-size: 13px !important;
            }

            .count-info:hover {
                background-color: rgba(255, 255, 255, 0.1) !important;
            }

            #page-wrapper {
                min-height: 635px;
            }
        </style>

    </head>
    <body class="top-navigation">
	<?php $this->beginBody() ?>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-fixed-top-top" role="navigation"
                     style="margin-bottom: 0;background: #2c4762;border-radius: unset;">
                    <ul class="nav navbar-top-links navbar-right nav-blog">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                        </li>
                        <li>
                            <a class="count-info" href="<?= Url::to( [ 'site/index' ] ) ?>">
                                <i class="fa fa-home"></i>
                                Trang chủ
                            </a>
                        </li>
                        <li>
                            <a class="count-info" href="#">
                                <i class="fa fa-database"></i>
                                Kho log
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="container">
					<?= $content ?>
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>
        </div>
    </div>
	<?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>