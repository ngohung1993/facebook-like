<?php

use frontend\assets\HelpAsset;

/* @var $this yii\web\View */

HelpAsset::register( $this );

$this->title = 'Hướng dẫn sủ dụng';

?>

<style>
    .search-content-1 .search-container > ul .search-item > .search-content {
        padding-left: 0;
    }

    .search-title {
        margin: 0;
        line-height: 0.5;
    }

    .search-title a {
        text-decoration: none;
        font-size: 20px;
    }
</style>

<div class="page-content" style="min-height:585px">
    <div class="row">
        <div class="col-md-12 search-page search-content-1">
            <div class="search-container ">
                <h2 style="padding: 15px 15px 0 15px;font-size: 25px;">Hướng dẫn sử dụng</h2>
                <ul>
                    <li class="search-item clearfix">
                        <div class="search-content">
                            <div class="col-md-3">
                                <a href="">
                                    <img style="width: 100%"
                                         src="http://quangcaouidfb.com/upload/images/quan-ly-email-sdt-nguoi-comment-bai-viet-facebook-3.png">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <h2 class="search-title">
                                    <a href="">
                                        Quản lí email số điện thoại người comment bài viết Facebook
                                    </a>
                                </h2>
                                <p></p>
                                <div style="font-size: 12px; margin-bottom: 5px;color: #808080;">
                                    1/26/2018 9:22:30 PM
                                </div>
                                <p class="search-desc">
                                    Quét trực tiếp những người đã để lại comment dưới bài viết
                                    facebook ra email, số điện thoại của họ nhằm giúp bạn thu thập thông tin khách hàng
                                    nhanh nhất.
                                </p>
                                <p></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>