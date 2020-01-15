<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 3/18/2018
 * Time: 6:26 PM
 */

use yii\helpers\Url;

/** @var $category \common\models\Category */
/** @var $post \common\models\Post */

$this->title = $post['title'];

$this->registerMetaTag( [
	'name'    => 'description',
	'content' => $post['seoTool']['meta_description']
] );

$this->registerMetaTag( [
	'property' => 'og:url',
	'content'  => Url::to( [
		'site/view',
		'category_slug' => $category['slug'],
		'content_slug'  => $post['slug']
	], true )
] );

$this->registerMetaTag( [
	'property' => 'og:type',
	'content'  => 'category'
] );

$this->registerMetaTag( [
	'property' => 'og:title',
	'content'  => $post['seoTool']['seo_title']
] );

$this->registerMetaTag( [
	'property' => 'og:description',
	'content'  => $post['seoTool']['meta_description']
] );

$this->registerMetaTag( [
	'property' => 'og:image',
	'content'  => Url::to( [ $post['category'] ], true )
] );

?>