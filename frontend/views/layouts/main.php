<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use frontend\assets\ThemeAsset;
use common\models\User;
use common\helpers\ClientHelper;
use common\helpers\ConnectHelper;

/* @var $this \yii\web\View */
/* @var $content string */

ThemeAsset::register( $this );

$user = null;

if ( ! Yii::$app->user->isGuest ) {
	$user = findModel( Yii::$app->user->identity->getId() );
}

/**
 * @param $id
 *
 * @return User|null
 * @throws NotFoundHttpException
 */
function findModel( $id ) {
	if ( ( $model = User::findOne( $id ) ) !== null ) {
		return $model;
	} else {
		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<?= Html::csrfMetaTags() ?>
        <title><?= Html::encode( $this->title ) ?></title>
		<?php $this->head() ?>
    </head>
    <body class="pace-done">
	<?php $this->beginBody() ?>
    <div class='page-topbar '>
        <div class='logo-area'></div>
        <div class='quick-area'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class='pull-right'>
				<?php if ( $user ): ?>
                    <ul class="info-menu right-links list-inline list-unstyled" style="margin-right: 45px;">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?= $user['avatar'] ? ClientHelper::$config['url_server'] . '/' . $user['avatar'] : '/uploads/core/images/default-avatar.jpg' ?>"
                                     alt="user-image" class="img-circle img-inline">
                                <span>
                                <?= $user['last_name'] ?>
                                    <i class="fa fa-angle-down"></i>
                            </span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="<?= Url::to( [ 'account/profile' ] ) ?>">
                                        <i class="fa fa-user"></i>
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to( [ 'account/password' ] ) ?>">
                                        <i class="fa fa-lock"></i>
                                        Thiết lập mật khẩu
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?= Url::to( [ 'site/logout' ] ) ?>">
                                        <i class="fa fa-sign-out"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
				<?php endif; ?>
				<?php if ( ! $user ): ?>
                    <ul class="info-menu right-links list-inline list-unstyled" style="margin-right: 45px;">
                        <li class="profile">
                            <a href="<?= ConnectHelper::generate_url_login() ?>">
                                <button class="btn btn-success" type="button" style="border-radius: 25px;">
                                    <i class="fa fa-sign-in"></i>
                                    Đăng nhập hoặc tạo tài khoản mới
                                </button>
                            </a>
                        </li>
                    </ul>

				<?php endif; ?>
            </div>
        </div>
    </div>
    <div class="page-container row-fluid container-fluid">
        <div class="page-sidebar pagescroll">
            <div class="page-sidebar-wrapper" id="main-menu-wrapper">
				<?php if ( $user ): ?>
                    <div class="profile-info row">
                        <div class="profile-image col-xs-4">
                            <a href="<?= Url::to( [ 'account/profile' ] ) ?>">
                                <img src="<?= $user['avatar'] ? ClientHelper::$config['url_server'] . '/' . $user['avatar'] : '/uploads/core/images/default-avatar.jpg' ?>"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="profile-details col-xs-8">
                            <h3>
                                <a href="<?= Url::to( [ 'account/profile' ] ) ?>">
									<?= $user['last_name'] ?>
                                </a>
                                <span class="profile-status online"></span>
                            </h3>
                            <p class="profile-title">Cộng tác viên</p>
                        </div>
                    </div>
				<?php endif; ?>
                <ul class='wraplist'>
                    <li class='menusection'>Main</li>
                    <li class="">
                        <a href="<?= Url::to( [ 'site/index' ] ) ?>">
                            <i class="fa fa-dashboard"></i>
                            <span class="title">Trang chủ</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'facebook/index' ] ) ?>">
                            <i class="fa fa-facebook"></i>
                            <span class="title">Tài khoản facebook</span>
                        </a>
                    </li>
                    <li class='menusection'>KÉO LIKE - BÌNH LUẬN FB (miễn phí)</li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-like/free' ] ) ?>">
                            <i class="fa fa-thumbs-o-up"></i>
                            <span class="title">Tăng like bài viết</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-comment/free' ] ) ?>">
                            <i class="fa fa-comments"></i>
                            <span class="title">Tăng comment bài viết</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-share/free' ] ) ?>">
                            <i class="fa fa-share-alt-square"></i>
                            <span class="title">Tăng share bài viết</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-sub/free' ] ) ?>">
                            <i class="fa fa-wifi"></i>
                            <span class="title">Tăng sub - friends</span>
                        </a>
                    </li>
                    <li class='menusection'>VIP THÁNG (trả phí)</li>
                    <li class="">
                        <a href="<?= Url::to( [ 'bot-emotion/me' ] ) ?>">
                            <i class="fa fa-check-circle-o"></i>
                            <span class="title">Bot vip like</span>
                            <span style="right: 0!important;" class="label label-accent">HOT</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'bot-emotion/friends' ] ) ?>">
                            <i class="fa fa-heart"></i>
                            <span class="title">Bot cảm xúc</span>
                            <span style="right: 0!important;" class="label label-accent">HOT</span>
                        </a>
                    </li>
                    <li class='menusection'>VIP BUFF (trả phí)</li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-like/index' ] ) ?>">
                            <i class="fa fa-thumbs-o-up"></i>
                            <span class="title">Mua like bài viết</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-comment/index' ] ) ?>">
                            <i class="fa fa-comments"></i>
                            <span class="title">Mua comment bài viết</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-share/index' ] ) ?>">
                            <i class="fa fa-share-alt-square"></i>
                            <span class="title">Mua share bài viết</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'buff-sub/index' ] ) ?>">
                            <i class="fa fa-wifi"></i>
                            <span class="title">Mua sub - friends</span>
                        </a>
                    </li>
                    <li class='menusection'>Tiện ích mở rộng</li>
                    <li class="open">
                        <a href="<?= Url::to( [ 'search/index' ] ) ?>">
                            <i class="fa fa-search-plus"></i>
                            <span class="title">Tìm kiếm UID</span>
                            <span style="right: 0!important;" class="label label-accent">HOT</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'search/index' ] ) ?>">
                            <i class="fa fa-database"></i>
                            <span class="title">Dữ liệu lưu trữ UID</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to( [ 'help/index' ] ) ?>">
                            <i class="fa fa-life-bouy"></i>
                            <span class="title">Hướng dẫn sử dụng</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <section id="main-content" class=" ">
            <section class="wrapper main-wrapper row" style=''>
				<?= $content ?>
            </section>
        </section>
    </div>
    <script>
        var base = "<?= Yii::$app->getHomeUrl() ?>";
        var server = "<?= ClientHelper::$config['url_server'] ?>";
        console.log(base);
        console.log(server);
    </script>
	<?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>