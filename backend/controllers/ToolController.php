<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\BuffLike;

class ToolController extends Controller {

	public function actionIndex() {

		$user = 'Caubehu.93@gmaol.com';
		$pass = 'Caubehu@123';

//		$secretkey = '62f8ce9f74b12f84c123cc23437a4a32';
//		$api_key   = '882a8490361da98702bf97a021ddc14d';

		$secretkey = 'c1e620fa708a1d5696fb991c1bde5662';
		$api_key   = '3e7c78e35a76a9299309885393b02d97';

		function tao_sig( $postdata, $secretkey ) {
			$textsig = "";
			foreach ( $postdata as $key => $value ) {
				$textsig .= "$key=$value";
			}
			$textsig .= $secretkey;
			$textsig = md5( $textsig );

			return $textsig;
		}

		function getpage( $url, $postdata = '' ) {
			$c = curl_init();
			curl_setopt( $c, CURLOPT_URL, $url );
			curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $c, CURLOPT_SSL_VERIFYHOST, false );
			curl_setopt( $c, CURLOPT_FOLLOWLOCATION, true );
			curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );

			curl_setopt( $c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0' );

			curl_setopt( $c, CURLOPT_POST, 1 );
			curl_setopt( $c, CURLOPT_POSTFIELDS, $postdata );

			$page = curl_exec( $c );
			curl_close( $c );

			return $page;
		}

		$postdata = array(
			"api_key"              => $api_key,
			"email"                => $user,
			"format"               => "JSON",
			"locale"               => "vi_vn",
			"method"               => "auth.login",
			"password"             => $pass,
			"return_ssl_resources" => "0",
			"v"                    => "1.0"
		);

		$postdata['sig'] = tao_sig( $postdata, $secretkey );

		http_build_query( $postdata );

		$data = getpage( "https://api.facebook.com/restserver.php", $postdata );

		var_dump( $data );
		die;

		$data = json_decode( $data, true );

		return $this->render( 'index' );
	}

	/**
	 * @return string
	 */
	public function actionListFriend() {
		return $this->render( 'list-friend' );
	}

	/**
	 * @return string
	 */
	public function actionFriendRequest() {
		return $this->render( 'friend-request' );
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionBuffLike() {

		$model = new BuffLike();

		$buff_likes = BuffLike::find()->all();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			return $this->refresh();
		}

		return $this->render( 'buff-like', [
			'model'      => $model,
			'buff_likes' => $buff_likes
		] );
	}
}