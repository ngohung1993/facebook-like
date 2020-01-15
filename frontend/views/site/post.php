<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;

/* @var $this yii\web\View */

$general = FunctionHelper::get_general_information();

$this->title = $general['site_name'];

$this->registerMetaTag( [
	'name'    => 'description',
	'content' => $general['home_page_description']
] );

$this->registerMetaTag( [
	'property' => 'og:url',
	'content'  => Url::to( [ 'site/index' ], true )
] );

$this->registerMetaTag( [
	'property' => 'og:type',
	'content'  => 'homepage'
] );

$this->registerMetaTag( [
	'property' => 'og:title',
	'content'  => $general['site_name']
] );

$this->registerMetaTag( [
	'property' => 'og:description',
	'content'  => $general['home_page_description']
] );


$this->registerMetaTag( [
	'property' => 'og:image',
	'content'  => Url::to( [ $general['logo'] ], true )
] );

?>

<style>
    .wrapper.wrapper-content {
        padding: 40px 0 !important;
    }

    .contact-box .btn {
        margin: 2px;
    }

    .contact-box .label {
        top: 0;
        right: -5px;
        border: none;
        border-top-left-radius: unset;
        border-bottom-left-radius: unset;
    }

    .user-stats {
        margin-top: 5px;
    }

    .user-stats span {
        margin: 0 2px;
    }

    .position-relative {
        position: relative !important;
    }

    .post__vote-widget {
        width: 70px;
    }

    .post__vote-widget .ratings {
        height: 150px;
    }

    .post__vote-widget > .widget {
        display: flex;
        margin-bottom: 1rem;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }

    .icon-btn, .icon-btn:active, .icon-btn:focus {
        outline: none;
    }

    .icon-btn {
        display: inline-block;
        padding: 0;
        border: 0;
        background: none;
        cursor: pointer;
        text-decoration: none;
    }

    .post__vote-widget .ratings .points {
        height: 28px;
        font-size: 28px;
        line-height: 28px;
        color: #9b9b9b;
        font-weight: 500;
    }

    .points {
        display: flex;
        align-items: center;
        cursor: default;
    }

    .post__vote-widget .ratings .vote .fa {
        font-size: 50px;
    }
</style>

<div class="row">
    <div class="col-lg-9">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox">
                <div class="hidden-md-down position-relative" style="width: 70px; margin-left: -70px;">
                    <div class="post__vote-widget position-absolute" style="top: 0;">
                        <div class="widget ratings" style="position: absolute;">
                            <button class="icon-btn vote">
                                <i class="fa fa-caret-up"></i>
                            </button>
                            <div class="points">+11</div>
                            <button class="icon-btn vote">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="pull-right">
                        <button class="btn btn-white btn-xs" type="button">Model</button>
                        <button class="btn btn-white btn-xs" type="button">Publishing</button>
                        <button class="btn btn-white btn-xs" type="button">Modern</button>
                    </div>
                    <div class="text-center article-title">
                        <span class="text-muted"><i class="fa fa-clock-o"></i> 28th Oct 2015</span>
                        <h1>
                            Behind the word mountains
                        </h1>
                    </div>
                    <p>
                        Many desktop publishing packages and web page editors now use <strong>Lorem Ipsum as their
                            default model text</strong>, and a search for 'lorem ipsum' will uncover many web
                    </p>
                    <p>
                        One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his
                        bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little
                        he could see his brown belly, slightly domed and divided by arches into stiff sections. The
                        bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs,
                        pitifully thin compared with the size of the rest of him, waved about helplessly as he looked.
                        "What's happened to me?" he thought. It wasn't a dream. His room, a proper human room although a
                        little too small, lay peacefully between its four familiar walls. A collection of textile
                        samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung
                        a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded
                        frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy
                        fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look
                        out the window at the dull weather. Drops
                    </p>
                    <p>
                        <i>
                            Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the
                            Semantics, a large language ocean. A small river named Duden flows by their place and
                            supplies it with the necessary regelialia. It is a paradisematic country, in which roasted
                            parts of sentences fly into your mouth.
                        </i>
                    </p>
                    <p>
                        The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild
                        Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her
                        seven versalia, put her initial into the belt and made herself on the way. When she reached the
                        first hills of the Italic Mountains, she had a last view back on the skyline of her hometown
                        Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.
                        Pityful a rethoric question ran over her cheek,
                    </p>
                    <p>
                        Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz
                        Jack!" my brave ghost pled. Five quacking zephyrs jolt my wax bed. Flummoxed by job, kvetching
                        W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls.
                        Few quips galvanized the mock jury box. Quick brown dogs jump over the lazy fox. The jay, pig,
                        fox, zebra, and my wolves quack! Blowzy red vixens fight for a quick jump. Joaquin Phoenix was
                        gazed by MTV for luck. A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy!", Alex
                        Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just
                    </p>
                    <p>
                        Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs
                        vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How
                        quickly daft jumping zebras vex.
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tags:</h5>
                            <button class="btn btn-primary btn-xs" type="button">Model</button>
                            <button class="btn btn-white btn-xs" type="button">Publishing</button>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-right">
                                <h5>Stats:</h5>
                                <div><i class="fa fa-comments-o"> </i> 56 comments</div>
                                <i class="fa fa-eye"> </i> 144 views
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <h2>Comments:</h2>
                            <div class="social-feed-box">
                                <div class="social-avatar">
                                    <a href="#" class="pull-left">
                                        <img alt="image" src="img/a1.jpg">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            Andrew Williams
                                        </a>
                                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                    </div>
                                </div>
                                <div class="social-body">
                                    <p>
                                        Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                        their
                                        default model text, and a search for 'lorem ipsum' will uncover many web sites
                                        still
                                        default model text.
                                    </p>
                                </div>
                            </div>
                            <div class="social-feed-box">
                                <div class="social-avatar">
                                    <a href="#" class="pull-left">
                                        <img alt="image" src="img/a2.jpg">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            Michael Novek
                                        </a>
                                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                    </div>
                                </div>
                                <div class="social-body">
                                    <p>
                                        Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                        their
                                        default model text, and a search for 'lorem ipsum' will uncover many web sites
                                        still
                                        default model text, and a search for 'lorem ipsum' will uncover many web sites
                                        still
                                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                        default model text.
                                    </p>
                                </div>
                            </div>
                            <div class="social-feed-box">
                                <div class="social-avatar">
                                    <a href="#" class="pull-left">
                                        <img alt="image" src="img/a3.jpg">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            Alice Mediater
                                        </a>
                                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                    </div>
                                </div>
                                <div class="social-body">
                                    <p>
                                        Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                        their
                                        default model text, and a search for 'lorem ipsum' will uncover many web sites
                                        still
                                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                        default model text.
                                    </p>
                                </div>
                            </div>
                            <div class="social-feed-box">
                                <div class="social-avatar">
                                    <a href="#" class="pull-left">
                                        <img alt="image" src="img/a5.jpg">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            Monica Flex
                                        </a>
                                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                    </div>
                                </div>
                                <div class="social-body">
                                    <p>
                                        Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                        their
                                        default model text, and a search for 'lorem ipsum' will uncover many web sites
                                        still
                                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                        default model text.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="contact-box">
                <a href="">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive"
                                 src="/uploads/core/images/user2-160x160.jpg">
                            <div class="m-t-xs font-bold">Graphics</div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>Lê Việt</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </div>
            <div class="contact-box">
                <p class="suggest-title">
                    <i class="fa fa-tags"></i>
                    Chủ đề nổi bật
                </p>
                <button class="btn btn-white btn-xs">
                    Android
                    <span class="label label-primary">20</span>
                </button>
                <button class="btn btn-white btn-xs">
                    PHP
                    <span class="label label-primary">299</span>
                </button>
                <button class="btn btn-white btn-xs">
                    Java
                    <span class="label label-primary">299</span>
                </button>
                <button class="btn btn-white btn-xs">
                    Yii2
                    <span class="label label-primary">299</span>
                </button>
            </div>
            <div class="contact-box">
                <p class="suggest-title">
                    <i class="fa fa-users"></i>
                    Chủ đề nổi bật
                </p>
                <a href="">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive"
                                 src="/uploads/core/images/user2-160x160.jpg">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>Lê Việt</strong></h3>
                        <p>@vietlv</p>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-outline" style="padding: 4px 12px;">
                            Follow
                        </button>
                    </div>
                    <div class="col-md-8">
                        <div class="user-stats">
                            <span data-tippy="" data-original-title="Reputations">
                                <i aria-hidden="true" class="fa fa-star"></i> 1782
                            </span>
                            <span data-tippy="" data-original-title="Followers">
                                <i aria-hidden="true" class="fa fa-user-plus"></i> 18
                            </span>
                            <span data-tippy="" data-original-title="Posts">
                                <i aria-hidden="true" class="fa fa-pencil"></i> 3
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <hr>
                <a href="">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive"
                                 src="/uploads/core/images/user2-160x160.jpg">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>Lê Việt</strong></h3>
                        <p>@vietlv</p>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-outline" style="padding: 4px 12px;">
                            Follow
                        </button>
                    </div>
                    <div class="col-md-8">
                        <div class="user-stats">
                            <span data-tippy="" data-original-title="Reputations">
                                <i aria-hidden="true" class="fa fa-star"></i> 1782
                            </span>
                            <span data-tippy="" data-original-title="Followers">
                                <i aria-hidden="true" class="fa fa-user-plus"></i> 18
                            </span>
                            <span data-tippy="" data-original-title="Posts">
                                <i aria-hidden="true" class="fa fa-pencil"></i> 3
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <hr>
                <a href="">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive"
                                 src="/uploads/core/images/user2-160x160.jpg">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>Lê Việt</strong></h3>
                        <p>@vietlv</p>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-outline" style="padding: 4px 12px;">
                            Follow
                        </button>
                    </div>
                    <div class="col-md-8">
                        <div class="user-stats">
                            <span data-tippy="" data-original-title="Reputations">
                                <i aria-hidden="true" class="fa fa-star"></i> 1782
                            </span>
                            <span data-tippy="" data-original-title="Followers">
                                <i aria-hidden="true" class="fa fa-user-plus"></i> 18
                            </span>
                            <span data-tippy="" data-original-title="Posts">
                                <i aria-hidden="true" class="fa fa-pencil"></i> 3
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>
</div>
