<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 3/9/2018
 * Time: 11:19 PM
 */

/** @var $category \common\models\Category */

$this->title = $category['title'];

$this->registerMetaTag( [
	'name'    => 'description',
	'content' => $category['seoTool']['meta_description']
] );

$this->registerMetaTag( [
	'property' => 'og:url',
	'content'  => Url::to( [ 'site/view', 'category_slug' => $category['slug'] ], true )
] );

$this->registerMetaTag( [
	'property' => 'og:type',
	'content'  => 'category'
] );

$this->registerMetaTag( [
	'property' => 'og:title',
	'content'  => $category['seoTool']['seo_title']
] );

$this->registerMetaTag( [
	'property' => 'og:description',
	'content'  => $category['seoTool']['meta_description']
] );

$this->registerMetaTag( [
	'property' => 'og:image',
	'content'  => Url::to( [ $category['category'] ], true )
] );

?>