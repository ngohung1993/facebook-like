<?php

use yii\helpers\Url;
use common\helpers\FunctionHelper;
use frontend\assets\MarkdownAsset;

MarkdownAsset::register( $this );

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

    .user-stats span {
        margin: 0 2px;
    }

    .md-editor > textarea {
        background: unset;
        padding: 10px;
    }

    .md-editor.active {
        border-color: inherit;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .select2-container--default .select2-selection--single {
        border-radius: unset;
    }

    .select2-container .select2-selection--single {
        height: 34px;
    }

    .dropdown-user {
        min-width: 305px;
        padding: 0 20px;
    }

    .dropdown-user:after {
        top: 1px;
        margin-left: -6px;
        border-top-width: 0;
        border-bottom-color: #fff;

    }

    .wrapper-content {
        padding-top: 25px !important;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="padding: 10px 20px 5px 20px;">
                <div class="form-group">
                    <input type="email" placeholder="Title" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select title="" class="js-example-basic-single form-control" name="state">
                                <option value="">Chọn danh mục</option>
								<?php foreach ( FunctionHelper::get_categories_by_page_key( 'blog-page' ) as $key => $value ): ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select title="" class="js-example-basic-single form-control" name="state">
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>
                </div>

                <textarea title="" name="content" data-provide="markdown" rows="10"></textarea>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" style="margin-top:15px;text-align: center;">
                            <div class="radio radio-info radio-inline">
                                <input style="cursor: pointer;" type="radio" id="inlineRadio1" value="option1"
                                       name="radioInline" checked="">
                                <label for="inlineRadio1"> Public </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input style="cursor: pointer;" type="radio" id="inlineRadio2" value="option2"
                                       name="radioInline">
                                <label for="inlineRadio2"> Unlisted </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input style="cursor: pointer;" type="radio" id="inlineRadio3" value="option3"
                                       name="radioInline">
                                <label for="inlineRadio3"> Private draft </label>
                            </div>
                            <br>
                            <span class="visibility-explain">
                                <i aria-hidden="true" class="fa fa-globe"></i>
                                Everyone can see your post.
                            </span>
                            <br>
                            <span class="visibility-explain">
                                <i aria-hidden="true" class="fa fa-eye-slash"></i>
                                Only those with the link to this post can see it.
                            </span>
                            <br>
                            <span class="visibility-explain">
                                <i aria-hidden="true" class="fa fa-lock"></i>
                                Only you can see this post. Your draft is already saved automatically as you type.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" style="text-align: center;">
                            <button class="btn btn-success btn-outline">
                                Public
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
