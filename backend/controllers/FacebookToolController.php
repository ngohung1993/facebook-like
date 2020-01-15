<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 2/2/2018
 * Time: 6:02 PM
 */

namespace backend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;

/**
 * FacebookToolController
 */
class FacebookToolController extends Controller {

	/**
	 * @param $action
	 *
	 * @return bool
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function beforeAction( $action ) {
		$this->enableCsrfValidation = false;

		return parent::beforeAction( $action );
	}

	/**
	 * @return bool|mixed
	 */
	public function actionVerifyAccount() {
		Yii::$app->response->format = Response::FORMAT_JSON;
		$post                       = Yii:: $app->request->post();

		if ( isset( $post['username'] ) && isset( $post['password'] ) ) {

			$username = $post['username'];
			$password = $post['password'];

			$secret_key = 'c1e620fa708a1d5696fb991c1bde5662';
			$api_key    = '3e7c78e35a76a9299309885393b02d97';

			$post_data = array(
				"api_key"              => $api_key,
				"email"                => $username,
				"format"               => "JSON",
				"locale"               => "vi_vn",
				"method"               => "auth.login",
				"password"             => $password,
				"return_ssl_resources" => "0",
				"v"                    => "1.0"
			);

			$post_data['sig'] = $this->generate_sig( $post_data, $secret_key );

			$rest_server = 'https://api.facebook.com/restserver.php?';

			foreach ( $post_data as $key => $value ) {
				$rest_server .= $key . '=' . $value.'&';
			}

			return $rest_server;

		}

		return false;
	}

	private function generate_sig( $post_data, $secret_key ) {
		$text_sig = '';
		foreach ( $post_data as $key => $value ) {
			$text_sig .= "$key=$value";
		}

		$text_sig .= $secret_key;

		return md5( $text_sig );
	}

	private function get_access_token( $url, $post_data = '' ) {
		$c = curl_init();
		curl_setopt( $c, CURLOPT_URL, $url );
		curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $c, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $c, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );

		curl_setopt( $c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0' );

		curl_setopt( $c, CURLOPT_POST, 1 );
		curl_setopt( $c, CURLOPT_POSTFIELDS, $post_data );

		$page = curl_exec( $c );
		curl_close( $c );

		return $page;
	}

}