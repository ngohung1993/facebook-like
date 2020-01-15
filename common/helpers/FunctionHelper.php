<?php

namespace common\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use fproject\components\DbHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;
use common\models\Classified;
use common\models\GeneralInformation;
use common\models\Image;
use common\models\PhotoLocation;
use common\models\Product;
use common\models\Setting;
use common\models\Supporter;
use common\models\District;
use common\models\Page;
use common\models\Province;
use common\models\Category;
use common\models\Post;
use common\models\Tab;

class FunctionHelper {
	/**
	 * @param $str
	 *
	 * @return mixed|string
	 */
	public static function slug( $str ) {
		$str = trim( mb_strtolower( $str ) );
		$str = preg_replace( '/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str );
		$str = preg_replace( '/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str );
		$str = preg_replace( '/(ì|í|ị|ỉ|ĩ)/', 'i', $str );
		$str = preg_replace( '/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str );
		$str = preg_replace( '/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str );
		$str = preg_replace( '/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str );
		$str = preg_replace( '/(đ)/', 'd', $str );
		$str = preg_replace( '/[^a-z0-9-\s]/', '', $str );
		$str = preg_replace( '/([\s]+)/', '-', $str );

		return $str;
	}

	/**
	 * @param $file
	 */
	public static function download( $file ) {
		if ( file_exists( $file ) ) {
			header( 'Content-Description: File Transfer' );
			header( 'Content-Type: application/octet-stream' );
			header( 'Content-Disposition: attachment; filename="' . basename( $file ) . '"' );
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate' );
			header( 'Pragma: public' );
			header( 'Content-Length: ' . filesize( $file ) );
			readfile( $file );
			exit;
		}
	}

	/**
	 * Import date to table $table with $attributes in $file start $start and end $end
	 *
	 * @param $table
	 * @param $attributes
	 * @param $file
	 * @param $start
	 * @param $end
	 *
	 * @throws BadRequestHttpException
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 */
	public static function import_data_excel( $table, $attributes, $file, $start, $end ) {
		ini_set( 'memory_limit', '-1' );
		set_time_limit( 1200 );
		$inputFileName = $file;

		if ( ! file_exists( $inputFileName ) ) {
			throw new BadRequestHttpException( 'File doesn\'t exists.' );
		}

		$inputFileName = $file;

		$spreadsheet = IOFactory::load( $inputFileName );

		$sheetData = $spreadsheet->getActiveSheet()->toArray( null, true, true, true );

		$data = [];
		foreach ( $sheetData as $key => $value ) {
			if ( $key >= $start && $key <= $end ) {
				$row = [];
				foreach ( $attributes as $key_att => $value_att ) {
					$row[ $value_att ] = $value[ $key_att ];
				}
				$data[] = $row;
			}
		}

		DbHelper::insertMultiple( $table, $data );

	}

	/**
	 * @param $table
	 * @param $attributes
	 * @param $file
	 *
	 * @throws BadRequestHttpException
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
	 */
	public static function import_data_excel_col( $table, $attributes, $file ) {
		ini_set( 'memory_limit', '-1' );
		set_time_limit( 1200 );
		$inputFileName = $file;

		if ( ! file_exists( $inputFileName ) ) {
			throw new BadRequestHttpException( 'File doesn\'t exists.' );
		}

		$inputFileName = $file;

		$spreadsheet = IOFactory::load( $inputFileName );

		$sheetData = $spreadsheet->getActiveSheet()->toArray( null, true, true, true );

		$data  = [];
		$count = 0;

		foreach ( $sheetData as $key => $value ) {
			$row[ $attributes[ $count ++ ] ] = $value['B'];
			if ( $key === count( $sheetData ) ) {
				$row['id']     = 1;
				$row['status'] = 1;
				$data[]        = $row;
			}
		}
		DbHelper::insertMultiple( $table, $data );

	}

	/**
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function get_categories( $display_homepage = null, $featured = null ) {
		$query = Category::find()
		                 ->joinWith( 'page' )
		                 ->joinWith( 'seoTool' )
		                 ->joinWith( 'posts' )
		                 ->joinWith( 'products' )
		                 ->joinWith( 'albums' )
		                 ->where( [ ' = ', 'category.status', 1 ] );

		if ( $display_homepage ) {
			$query->andWhere( [ ' = ', 'display_homepage', $display_homepage ] );
		}

		if ( $featured ) {
			$query->andWhere( [ ' = ', 'featured', $featured ] );
		}

		return $query->all();
	}

	public $categories_id = [];

	/**
	 * @param $categories
	 * @param $category_id
	 *
	 * @return array
	 */
	public function get_all_categories_id_children( $categories, $category_id ) {
		$cate_child = array();
		foreach ( $categories as $key => $item ) {
			if ( $item['parent_id'] == $category_id ) {
				$cate_child[] = $item;
				unset( $categories[ $key ] );
			}
		}

		if ( $cate_child ) {
			foreach ( $cate_child as $key => $item ) {
				$this->categories_id[] = $item['id'];
				FunctionHelper::get_all_categories_id_children( $categories, $item['id'] );
			}
		}

		return $this->categories_id;
	}

	/**
	 * @param $slug
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public static function get_category( $slug, $display_homepage = null, $featured = null ) {
		$query = Category::find()
		                 ->joinWith( 'page' )
		                 ->joinWith( 'seoTool' )
		                 ->joinWith( 'posts' )
		                 ->joinWith( 'products' )
		                 ->joinWith( 'albums' )
		                 ->where( [ ' = ', 'category.status', 1 ] )
		                 ->andWhere( [ ' = ', 'category.slug', $slug ] );

		if ( $display_homepage ) {
			$query->andWhere( [ ' = ', 'display_homepage', $display_homepage ] );
		}

		if ( $featured ) {
			$query->andWhere( [ ' = ', 'featured', $featured ] );
		}

		return $query->one();
	}

	/**
	 * @param null $parent_id
	 * @param null $limit
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_categories_by_parent_id( $parent_id = null, $limit = null, $display_homepage = null, $featured = null ) {
		$query = Category::find()
		                 ->joinWith( 'page' )
		                 ->joinWith( 'seoTool' )
		                 ->joinWith( 'posts' )
		                 ->joinWith( 'products' )
		                 ->joinWith( 'albums' )
		                 ->where( [ '=', 'category.status', 1 ] );

		if ( $parent_id ) {
			$query->andWhere( [ '=', 'category.parent_id', $parent_id ] );
		} else {
			$query->andWhere( [ 'is', 'category.parent_id', null ] );
		}

		if ( $display_homepage ) {
			$query->andWhere( [ ' = ', 'display_homepage', $display_homepage ] );
		}

		if ( $featured ) {
			$query->andWhere( [ ' = ', 'featured', $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $page_key
	 * @param null $limit
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function get_categories_by_page_key( $page_key, $limit = null, $display_homepage = null, $featured = null ) {
		$page = Page::find()->where( [ '=', 'key', $page_key ] )->one();

		$query = Category::find()
		                 ->joinWith( 'page' )
		                 ->joinWith( 'seoTool' )
		                 ->joinWith( 'posts' )
		                 ->joinWith( 'products' )
		                 ->joinWith( 'albums' )
		                 ->where( [ '=', 'category.status', '1' ] )
		                 ->andWhere( [ '=', 'category.page_id', $page['id'] ] );

		if ( $display_homepage ) {
			$query->andWhere( [ ' = ', 'category.display_homepage', $display_homepage ] );
		}

		if ( $featured ) {
			$query->andWhere( [ ' = ', 'category.featured', $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $id
	 * @param null $limit
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_tab_by_post_id( $id, $limit = null ) {
		$query = Tab::find()->where( [ '=', 'post_id', $id ] );
		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $slug
	 *
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public static function get_category_by_slug( $slug ) {
		$query = Category::find()
		                 ->joinWith( 'page' )
		                 ->joinWith( 'seoTool' )
		                 ->joinWith( 'posts' )
		                 ->joinWith( 'products' )
		                 ->joinWith( 'albums' )
		                 ->where( [ '=', 'category.slug', $slug ] );

		return $query->one();
	}

	/**
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function get_provinces() {
		$provinces = Province::find()->all();

		return $provinces;
	}

	/**
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function get_districts() {
		$districts = District::find()->all();

		return $districts;
	}

	/**
	 * @param $categories
	 * @param int $parent_id
	 */
	public static function show_categories_nestable( $categories, $parent_id = 0 ) {
		$cate_child = array();
		foreach ( $categories as $key => $item ) {
			if ( $item['parent_id'] == $parent_id ) {
				$cate_child[] = $item;
				unset( $categories[ $key ] );
			}
		}

		usort( $cate_child, function ( $a, $b ) {
			return $a['serial'] > $b['serial'];
		} );

		if ( $cate_child ) {
			echo '<ol class="dd-list">';
			foreach ( $cate_child as $key => $item ) {
				echo '<li class="dd-item" data-id="' . $item['id'] . '"><div class="dd-handle">' . $item['title'] . '</div > ';
				FunctionHelper::show_categories_nestable( $categories, $item['id'] );
				echo '</li>';
			}
			echo '</ol>';
		}
	}

	/**
	 * @param $categories
	 * @param $selected
	 * @param int $parent_id
	 * @param string $serial
	 */
	public static function show_categories_select( $categories, $selected = null, $parent_id = 0, $serial = '' ) {

		$cate_child = array();
		foreach ( $categories as $key => $item ) {
			if ( $item['parent_id'] == $parent_id ) {
				$cate_child[] = $item;
				unset( $categories[ $key ] );
			}
		}

		usort( $cate_child, function ( $a, $b ) {
			return $a['serial'] > $b['serial'];
		} );

		if ( $cate_child ) {

			foreach ( $cate_child as $key => $item ) {
				echo '<option ' . ( $selected == $item['id'] ? 'selected="selected"' : '' ) . ' value="' . $item['id'] . '">';
				echo $serial . $item['serial'] . ' ' . $item['title'];
				echo '</option>';
				FunctionHelper::show_categories_select( $categories, $selected, $item['id'], $item['serial'] . $serial . '.' );
			}
		}
	}

	/**
	 * @param $categories
	 * @param int $parent_id
	 * @param string $serial
	 */
	public static function show_categories_table( $categories, $parent_id = 0, $serial = '' ) {
		$cate_child = array();
		foreach ( $categories as $key => $item ) {
			if ( $item['parent_id'] == $parent_id ) {
				$cate_child[] = $item;
				unset( $categories[ $key ] );
			}
		}

		usort( $cate_child, function ( $a, $b ) {
			return $a['serial'] > $b['serial'];
		} );

		if ( $cate_child ) {
			foreach ( $cate_child as $key => $item ) {
				$dot = $serial == '' ? $item['serial'] : $serial . '.' . $item['serial'];
				echo '<tr>';
				echo '<td style="padding-left: 15px;">';
				echo '<input title="" data-id="' . $item['id'] . '" type="checkbox" class="minimal">';
				echo '</td>';
				echo '<td>' . $dot . '</td>';
				echo '<td><a href="#" class="editable" data-name="category#title" data-type="text"
                                               data-pk="' . $item['id'] . '" data-title="Nhập tiêu đề" data-url="' . Url::to( [ 'ajax/edit-column' ] ) . '">' . $item['title'] . '</a></td>';
				echo '<td>';
				echo '<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini" style="border:none">';
				echo '<input data-id="' . $item['id'] . '" data-api="ajax/enable-column" data-column="status" data-table="category" type="checkbox" ' . ( $item['status'] ? 'checked="checked"' : '' ) . ' title="" name="switch-checkbox">';
				echo '</div></td>';
				echo '<td><a style="margin-right: 5px;" href="' . Url::to( [
						'category/update',
						'id' => $item['id']
					] ) . '"><i class="fa fa-edit"></i></a>' .
				     Html::a( Yii::t( 'backend', '<i class="fa fa-trash-o"></i>' ), [ 'delete', 'id' => $item->id ], [
					     'data' => [
						     'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
						     'method'  => 'post',
					     ],
				     ] ) . '</td>';
				echo '</tr> ';
				FunctionHelper::show_categories_table( $categories, $item['id'], $dot );
			}
		}
	}

	/**
	 * @param $categories
	 * @param int $parent_id
	 * @param string $serial
	 */
	public static function show_categories_of_post_table( $categories, $parent_id = 0, $serial = '' ) {
		$cate_child = array();
		foreach ( $categories as $key => $item ) {
			if ( $item['parent_id'] == $parent_id ) {
				$cate_child[] = $item;
				unset( $categories[ $key ] );
			}
		}

		usort( $cate_child, function ( $a, $b ) {
			return $a['serial'] > $b['serial'];
		} );

		if ( $cate_child ) {
			foreach ( $cate_child as $key => $item ) {
				echo '<tr>';
				echo '<td>' . ( $serial == '' ? $serial : $serial . '.' ) . $item['serial'] . '</td>';
				echo '<td><a href="' . Url::to( [
						'post/post-of-category',
						'category_slug' => $item['slug']
					] ) . '">' . $item['title'] . '</a></td>';
				echo '<td>' . $item['code'] . '</td>';
				echo '</tr> ';
				FunctionHelper::show_categories_of_post_table( $categories, $item['id'], ( $serial == '' ? $serial : $serial . '.' ) . $item['serial'] );
			}
		}

	}

	/**
	 * @param null $limit
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function get_posts( $limit = null, $display_homepage = null, $featured = null ) {
		$query = Post::find()
		             ->joinWith( 'category' )
		             ->joinWith( 'seoTool' )
		             ->joinWith( 'images0' )
		             ->joinWith( 'albums' )
		             ->where( [ ' = ', 'post.status', 1 ] );

		if ( $display_homepage ) {
			$query->andWhere( [ ' = ', 'display_homepage', $display_homepage ] );
		}

		if ( $featured ) {
			$query->andWhere( [ ' = ', 'featured', $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $slug
	 *
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public static function get_post_by_slug( $slug ) {
		$query = Post::find()
		             ->joinWith( 'category' )
		             ->joinWith( 'seoTool' )
		             ->joinWith( 'images0' )
		             ->joinWith( 'albums' )
		             ->where( [ '=', 'post.status', 1 ] )
		             ->andWhere( [ '=', 'post.slug', $slug ] );

		return $query->one();
	}

	/**
	 * @param $category_slug
	 * @param null $limit
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_post_by_category_slug( $category_slug, $limit = null, $display_homepage = null, $featured = null ) {
		$category = Category::find()->where( [ 'slug' => $category_slug ] )->one();

		$query = Post::find()
		             ->joinWith( 'category' )
		             ->joinWith( 'seoTool' )
		             ->joinWith( 'images0' )
		             ->joinWith( 'albums' )
		             ->where( [ 'post.status' => 1 ] )
		             ->andWhere( [ 'post.category_id' => $category['id'] ] );

		if ( $display_homepage ) {
			$query->andWhere( [ 'display_homepage' => $display_homepage ] );
		}

		if ( $display_homepage ) {
			$query->andWhere( [ 'featured' => $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	public static function get_classifieds( $display_homepage = null, $featured = null ) {

	}

	public static function get_classified( $slug ) {
		return Classified::find()
		                 ->joinWith( 'category' )
		                 ->where( [ 'classifieds.status' => 1 ] )
		                 ->andWhere( [ 'classifieds.slug' => $slug ] );
	}

	/**
	 * @param $category_slug
	 * @param null $limit
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_classifieds_by_category_slug( $category_slug, $limit = null, $display_homepage = null, $featured = null ) {
		$category = Category::find()->where( [ 'slug' => $category_slug ] )->one();

		$query = Classified::find()
		                   ->where( [ 'classifieds.status' => 1 ] )
		                   ->andWhere( [ 'classifieds.category_id' => $category['id'] ] );

		if ( $display_homepage ) {
			$query->andWhere( [ 'display_homepage' => $display_homepage ] );
		}

		if ( $display_homepage ) {
			$query->andWhere( [ 'featured' => $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param int $limit
	 * @param int $display_homepage
	 * @param int $featured
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_products( $limit = null, $display_homepage = 0, $featured = 0 ) {
		$query = Product::find()
		                ->joinWith( 'category' )
		                ->joinWith( 'seoTool' )
		                ->joinWith( 'albums' )
		                ->joinWith( 'orderDetails' )
		                ->joinWith( 'images0' )
		                ->joinWith( 'user' )
		                ->where( [ '=', 'product.status', 1 ] );

		if ( $display_homepage ) {
			$query->andWhere( [ '=', 'product.display_homepage', $display_homepage ] );
		}

		if ( $featured ) {
			$query->andWhere( [ '=', 'product.featured', $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $slug
	 *
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public static function get_product( $slug ) {
		return Product::find()->joinWith( 'category' )
		              ->joinWith( 'seoTool' )
		              ->joinWith( 'albums' )
		              ->joinWith( 'orderDetails' )
		              ->joinWith( 'images0' )
		              ->joinWith( 'user' )
		              ->where( [ 'product.slug' => $slug ] )->one();
	}

	/**
	 * @param $category_slug
	 * @param null $limit
	 * @param null $display_homepage
	 * @param null $featured
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_products_by_category_slug( $category_slug, $limit = null, $display_homepage = null, $featured = null ) {
		$category = Category::find()->where( [ 'slug' => $category_slug ] )->one();

		$query = Product::find()
		                ->joinWith( 'category' )
		                ->joinWith( 'seoTool' )
		                ->joinWith( 'albums' )
		                ->joinWith( 'orderDetails' )
		                ->joinWith( 'images0' )
		                ->joinWith( 'user' )
		                ->where( [ 'product.status' => 1 ] )
		                ->andWhere( [ 'product.category_id' => $category['id'] ] );

		if ( $display_homepage ) {
			$query->andWhere( [ 'display_homepage' => $display_homepage ] );
		}

		if ( $display_homepage ) {
			$query->andWhere( [ 'featured' => $featured ] );
		}

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $photo_location_key
	 * @param null $limit
	 *
	 * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
	 */
	public static function get_images_by_photo_location_key( $photo_location_key, $limit = null ) {
		$photo_location = PhotoLocation::find()->where( [ '=', 'key', $photo_location_key ] )->one();

		$query = Image::find()
		              ->where( [ '=', 'image.status', 1 ] )
		              ->andWhere( [ '=', 'image.photo_location_id', $photo_location['id'] ] );

		if ( $limit ) {
			$query->limit( $limit );
		}

		return $limit == 1 ? $query->one() : $query->all();
	}

	/**
	 * @param $key
	 *
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public static function get_setting_by_key( $key ) {
		$query = Setting::find()
		                ->where( [ '=', 'setting.status', 1 ] )
		                ->andWhere( [ '=', 'setting.key', $key ] );

		return $query->one();
	}

	/**
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function get_supporter() {
		return Supporter::find()->where( [ 'status' => 1 ] )->all();
	}

	/**
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public static function get_general_information() {
		return GeneralInformation::find()->one();
	}

}