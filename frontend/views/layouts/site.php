<?php

use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\helpers\ConnectHelper;
use common\models\User;
use frontend\assets\SiteAsset;

/* @var $this \yii\web\View */
/* @var $content string */

SiteAsset::register( $this );

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
    <body class="body-2">
	<?php $this->beginBody() ?>

    <section id="promo" class="d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="mb-0 d-flex align-items-center justify-content-center">
                        <label class="badge badge-secondary mr-3">HOT</label>
                        Hãy thử Austin trong 14 ngày.
                        <span class="d-none d-lg-inline-block">
                            Không có rủi ro, và không yêu cầu thẻ tín dụng. Lưu trữ miễn phí trong 3 tháng
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <i class="icon icon-Close-Window"></i>
    </section>

    <main id="main" class="main main-1">
        <nav class="navbar navbar-1 navbar-expand-lg navbar-light justify-content-center">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="http://piotr.stare.pro/hosting/images/logo-white.png" alt="" class="light">
                    <img src="http://piotr.stare.pro/hosting/images/logo.png" alt="" class="dark">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto fill-flex justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#pricing">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pricing">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#locations">Bảng giá</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Giá trị</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto justify-content-end align-items-start align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link nav-link__cta rounded"
                               href="<?= ConnectHelper::generate_url_login() ?>">
                                Đăng nhập
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main-content">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6 offset-lg-0 col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center text-lg-left mb-5 mb-lg-0">
                        <div class="pr-0 pr-xl-5 pr-lg-0">
                            <h1 class="main-content__title mb-3 mb-lg-4 h2">
                                Công cụ tương tác facebook hiệu quả
                            </h1>
                            <p class="main-content__lead lead mb-4">
                                Giúp bạn tìm kiếm, tinh lọc bài viết. Tăng lượng tương tác thích, chia sẻ, bình luận cho
                                tài khoản cá nhân, nhóm, trang.
                            </p>
                            <div class="row d-none d-lg-flex">
                                <div class="col-lg-6 col-md-6">
                                    <ul class="features-list list-unstyled m-0">
                                        <li class="features-list__item d-flex align-items-center">
                                            <i class="features-list__item--icon mr-2"></i>
                                            <span class="features-list__item--text color--white">
                                                5 ngày dùng thử miễn phí
                                            </span>
                                        </li>
                                        <li class="features-list__item d-flex align-items-center">
                                            <i class="features-list__item--icon mr-2"></i>
                                            <span class="features-list__item--text color--white">
                                                Hỗ trợ tìm kiếm UID
                                            </span>
                                        </li>
                                        <li class="features-list__item d-flex align-items-center">
                                            <i class="features-list__item--icon mr-2"></i>
                                            <span class="features-list__item--text color--white">
                                                Giao diện thân thiện
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul class="features-list list-unstyled m-0">
                                        <li class="features-list__item d-flex align-items-center">
                                            <i class="features-list__item--icon mr-2"></i>
                                            <span class="features-list__item--text color--white">
                                                Giá cả phù hợp
                                            </span>
                                        </li>
                                        <li class="features-list__item d-flex align-items-center">
                                            <i class="features-list__item--icon mr-2"></i>
                                            <span class="features-list__item--text color--white">
                                                Tích hợp nhiều tài khoản
                                            </span>
                                        </li>
                                        <li class="features-list__item d-flex align-items-center">
                                            <i class="features-list__item--icon mr-2"></i>
                                            <span class="features-list__item--text color--white">
                                                Tiết kiệm thời gian
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="btn btn--green btn--lg mb-0 mt-4 d-inline-flex align-items-center">
                                Đăng nhập ngay
                                <i class="icon icon-Right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center text-lg-right position-relative">
                        <img src="http://piotr.stare.pro/hosting/images/hero-illustration-2.png" alt=""
                             class="main-content__img img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section id="pricing" class="pricing pricing-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="pricing-card pricing-card-first">
                        <h5 class="pricing-card__title mb-4">Single</h5>
                        <h3 class="pricing-card__value"><span class="pricing-currency">$</span><span
                                    class="pricing-cost">19</span><span class="pricing-period">/mo</span></h3>
                        <ul class="pricing-card__list list-unstyled mb-0 pb-1">
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span>1 Website</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span>4GB Disk Space</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span>1000GB Bandwidth</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span>50 MySQL Database</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span>5 FTP User</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span>100 Email Account</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__false mr-2"></i>
                                <span>Unlimited Website Builder</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__false mr-2"></i>
                                <span>Unlimited Control Panel</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__false mr-2"></i>
                                <span>User Friendly Access Manager</span>
                            </li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn--blue btn--lg">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-card pricing-card-highlighted">
                        <div class="ribbon"><h6 class="text-uppercase mb-0">Popular Option</h6></div>
                        <h5 class="pricing-card__title mb-4">Premium</h5>
                        <h3 class="pricing-card__value"><span class="pricing-currency">$</span><span
                                    class="pricing-cost">99</span><span class="pricing-period">/mo</span></h3>
                        <ul class="pricing-card__list list-unstyled mb-0 pb-1">
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Websites</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Disk Space</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Bandwidth</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> MySQL Database</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> FTP User</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Email Account</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Website Builder</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__false mr-2"></i>
                                <span><strong>Unlimited</strong> Control Panel</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__false mr-2"></i>
                                <span><strong>User Friendly</strong> Access Manager</span>
                            </li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn--green btn--lg">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-card">
                        <h5 class="pricing-card__title mb-4">Business</h5>
                        <h3 class="pricing-card__value"><span class="pricing-currency">$</span><span
                                    class="pricing-cost">139</span><span class="pricing-period">/mo</span></h3>
                        <ul class="pricing-card__list list-unstyled mb-0 pb-1">
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Websites</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Disk Space</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Bandwidth</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> MySQL Database</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> FTP User</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Email Account</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Website Builder</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>Unlimited</strong> Control Panel</span>
                                <i data-feather="help-circle" data-toggle="tooltip" data-placement="top"
                                   title="Tooltip on top"></i>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="pricing-icon pricing-icon__true mr-2"></i>
                                <span><strong>User Friendly</strong> Access Manager</span>
                            </li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn--blue btn--lg">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="clients" class="clients-1 section section--padding__bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="http://piotr.stare.pro/hosting/images/clients/product-hunt.svg" alt=""
                                 class="img-fluid">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="http://piotr.stare.pro/hosting/images/clients/buzzfeed.svg" alt=""
                                 class="img-fluid">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="http://piotr.stare.pro/hosting/images/clients/bbc.svg" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="http://piotr.stare.pro/hosting/images/clients/the-guardian.svg" alt=""
                                 class="img-fluid">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="http://piotr.stare.pro/hosting/images/clients/the-verge.svg" alt=""
                                 class="img-fluid">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="http://piotr.stare.pro/hosting/images/clients/yahoo-tech.svg" alt=""
                                 class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="locations">
        <div class="container">
            <div class="row">
                <div class="preamble col-lg-8 offset-lg-2">
                    <h3 class="title">DataCenter Locations</h3>
                    <p class="lead">Demonstrating core competencies to in turn innovate. Create stakeholder engagement
                        so that we gain traction.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <img src="http://piotr.stare.pro/hosting/images/map.png" alt="" class="map img-fluid">
                    <div class="location location-paris" data-toggle="tooltip" data-html="true"
                         title="<h5>Paris Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>France</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Paris Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>France</p>
                        </div>
                    </div>
                    <div class="location location-amsterdam" data-toggle="tooltip" data-html="true"
                         title="<h5>Amsterdam Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>The Netherlands</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Amsterdam Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>The Netherlands</p>
                        </div>
                    </div>
                    <div class="location location-sydney" data-toggle="tooltip" data-html="true"
                         title="<h5>Sydney Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>Australia</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Sydney Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>Australia</p>
                        </div>
                    </div>
                    <div class="location location-singapore" data-toggle="tooltip" data-html="true"
                         title="<h5>Singapore Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>Singapore</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Singapore Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>Singapore</p>
                        </div>
                    </div>
                    <div class="location location-tokyo" data-toggle="tooltip" data-html="true"
                         title="<h5>Tokyo Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>Japan</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Tokyo Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>Japan</p>
                        </div>
                    </div>
                    <div class="location location-losangeles" data-toggle="tooltip" data-html="true"
                         title="<h5>Los Angeles Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>USA</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Los Angeles Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>USA</p>
                        </div>
                    </div>
                    <div class="location location-miami" data-toggle="tooltip" data-html="true"
                         title="<h5>Miami Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>USA</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Miami Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>USA</p>
                        </div>
                    </div>
                    <div class="location location-seattle" data-toggle="tooltip" data-html="true"
                         title="<h5>Seattle Data Center</h5><p>60 Faubourg Saint Honoré, <br>Île-de-France <br>USA</p>">
                        <div class="location__pin"></div>
                        <div class="location__rwd d-block d-md-none">
                            <h5>Seattle Data Center</h5>
                            <p>60 Faubourg Saint Honoré, <br>Île-de-France <br>USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features-1 section section--padding__wmargin">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature d-flex">
                        <i class="feature__icon icon icon--md icon-CPU icon--color mr-4"></i>
                        <div>
                            <h5>100% Intel Cores</h5>
                            <p class="pr-4">Diversify kpis gain traction, so anti-pattern and get all your ducks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature d-flex">
                        <i class="feature__icon icon icon--md icon-Billing icon--color mr-4"></i>
                        <div>
                            <h5>No long term contracts</h5>
                            <p class="pr-4">Shoot me an email we've got to manage that low hanging fruit that jerk.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature d-flex">
                        <i class="feature__icon icon icon--md icon-Atom icon--color mr-4"></i>
                        <div>
                            <h5>Powerful API</h5>
                            <p class="pr-4">Powerpoint Bunny we need distributors to evangelize the new line to local
                                markets.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature d-flex">
                        <i class="feature__icon icon icon--md icon-Restore-Window icon--color mr-4"></i>
                        <div>
                            <h5>Whenever something happens</h5>
                            <p class="pr-4">We need more paper drill down, yet t-shaped individual nor are we in
                                agreeance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature d-flex">
                        <i class="feature__icon icon icon--md icon-Data-Lock icon--color mr-4"></i>
                        <div>
                            <h5>Root administrator access</h5>
                            <p class="pr-4">Dog and pony show your work on this project has been really impactful quick
                                win.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature d-flex">
                        <i class="feature__icon icon icon--md icon-Target icon--color mr-4"></i>
                        <div>
                            <h5>Infinite OS combinations</h5>
                            <p class="pr-4">Time to open the kimono I have zero cycles for this. Where do we stand on
                                the latest client ask.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="integrations" class="section section--padding section--gradient__1">
        <div class="container">
            <div class="row">
                <div class="preamble preamble--light col-lg-8 offset-lg-2">
                    <h3 class="title">Integrations</h3>
                    <p class="lead">Demonstrating core competencies to in turn innovate. Create stakeholder engagement
                        so that we gain traction.</p>
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <div class="col-lg-5 order-2 order-lg-1 mt-5 mt-lg-0">
                    <ul class="features list-unstyled mb-0">
                        <li class="d-flex">
                            <i class="icon icon-Consulting icon--md"></i>
                            <div class="ml-4">
                                <h5>24/7 Real Support</h5>
                                <p>Feature creep going forward you better eat a reality sandwich before you walk back in
                                    that boardroom can you send me an invite</p>
                            </div>
                        </li>
                        <li class="d-flex">
                            <i class="icon icon-SSL icon--md"></i>
                            <div class="ml-4">
                                <h5>SSL Domain Certificate</h5>
                                <p>Can you ballpark the cost per unit for me accountable talk bells and whistles, so
                                    goalposts for where the metal hits the meat.</p>
                            </div>
                        </li>
                        <li class="d-flex">
                            <i class="icon icon-Wordpress icon--md"></i>
                            <div class="ml-4">
                                <h5>Wordpress One Click</h5>
                                <p>We want to see more charts streamline, or we need to build it so that it scales
                                    marketing computer development html roi feedback.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 order-1 order-lg-2">
                    <div class="illustration text-right ml-0 ml-xl-5">
                        <img src="/uploads/theme/images/circle.png" alt="">
                        <span class="illustration__icons">
                        <img src="http://piotr.stare.pro/hosting/images/integration-1.png" alt="">
                        <img src="http://piotr.stare.pro/hosting/images/integration-2.png" alt="">
                        <img src="/uploads/theme/images/integration-3.png" alt="">
                        <img src="/uploads/theme/images/integration-4.png" alt="">
                        <img src="/uploads/theme/images/integration-5.png" alt="">
                        <img src="http://piotr.stare.pro/hosting/images/integration-6.png" alt="">
                        <img src="/uploads/theme/images/integration-7.png" alt="">
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="charts" class="section section--padding">
        <div class="container">
            <div class="row">
                <div class="preamble col-lg-8 offset-lg-2">
                    <h3 class="title">Performance Comparison</h3>
                    <p class="lead">Demonstrating core competencies to in turn innovate. Create stakeholder engagement
                        so that we gain traction.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                    <header class="chart-header">
                        <h5>UnixBench Scores</h5>
                        <p>higher is better</p>
                    </header>
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
                <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                    <header class="chart-header">
                        <h5>Performance Per Dollar</h5>
                        <p>higher is better</p>
                    </header>
                    <canvas id="myChart2" width="400" height="400"></canvas>
                </div>
                <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                    <header class="chart-header">
                        <h5>I/O Benchmark</h5>
                        <p>higher is better</p>
                    </header>
                    <canvas id="myChart3" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonials-1 section section--gradient__4">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <img src="http://piotr.stare.pro/hosting/images/testimonials.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <blockquote class="blockquote">
                        <p class="mb-0">"Generate relevant and engaging content and above all, increase viewability.
                            Demonstrate scrum masters and try to innovate. Funneling a holistic approach with a goal to
                            create a better customer experience."</p>
                        <footer>
                            <h5 class="mb-0 mt-4">— Austin Clein</h5>
                            <p>Interface Designer</p>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <section id="cta" class="cta-1 section section--padding section--gradient__2">
        <div class="container">
            <div class="row">
                <div class="preamble preamble--light col-lg-8 offset-lg-2 mb-5">
                    <h3 class="title">Get Austin Enterprise</h3>
                    <p class="lead">Demonstrating core competencies to in turn innovate. Create stakeholder engagement
                        so that we gain traction.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <form action="#" class="footer-form mb-0">
                        <div class="form-group">
                            <label class="footer-form__label" for="name">Full Name <span
                                        class="required">*</span></label>
                            <input type="text" class="form-control footer-form__input" id="name" aria-describedby="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="footer-form__label" for="email">Email Address <span class="required">*</span></label>
                            <input type="email" class="form-control footer-form__input" id="email"
                                   aria-describedby="email" required>
                        </div>
                        <div class="form-group">
                            <label class="footer-form__label" for="number">Phone Number <span class="required">*</span></label>
                            <input type="number" class="form-control footer-form__input" id="number"
                                   aria-describedby="number" required>
                        </div>
                        <div class="form-group justify-content-center d-flex mt-4">
                            <button class="btn btn--blue btn--lg w-100">Start your Trial</button>
                        </div>
                        <small class="d-block text-center">Signing up signifies you have read and agree to our
                            Terms of Service and <a href="#">Privacy Policy.</a></small>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="footer-1">
        <div class="container">
            <div class="row d-block d-md-flex align-items-center fill-flex">
                <div class="col justify-content-center justify-content-md-start d-flex mb-3 mb-md-0">
                    <div class="footer__contact d-flex align-items-center">
                        <i class="icon icon-Phone"></i>
                        <p class="mb-0 ml-3">+48 543 654 432</p>
                    </div>
                </div>
                <div class="col justify-content-center justify-content-md-center d-flex mb-3 mb-md-0">
                    <p class="footer__copyrights mb-0">2018. Created by PeElOne</p>
                </div>
                <div class="col justify-content-center justify-content-md-end d-flex">
                    <ul class="footer__social list-unstyled m-0 d-flex">
                        <li>
                            <a href="#">
                                <i class="socicon-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="socicon-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="socicon-skype"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="socicon-disqus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="socicon-medium"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="modal-body__image col-md-5"></div>
                        <div class="modal-body__content col-md-7">
                            <div class="d-flex justify-content-center">
                                <div class="col-lg-9 col-md-8">
                                    <div class="preamble text-left mb-5">
                                        <h3 class="title">Just 24 Hours Left!</h3>
                                        <p class="lead">Your limited-time offer to upgrade to Austin Premium is almost
                                            up.</p>
                                    </div>
                                    <form action="#" class="modal__form">
                                        <div class="form-group">
                                            <input type="text" placeholder="Your Name"
                                                   class="form-control modal__form--input" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" placeholder="Your Email"
                                                   class="form-control modal__form--input" required>
                                        </div>
                                        <div class="form-group justify-content-center d-flex mt-3 mb-0">
                                            <button class="btn btn--blue btn--lg w-100 modal__form--btn">Join Newsletter
                                                Now
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var base = "<?= Yii::$app->getHomeUrl() ?>";
        console.log(base);
    </script>
	<?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>