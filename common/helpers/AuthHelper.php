<?php
/**
 * Created by PhpStorm.
 * User: vietlv
 * Date: 23-Feb-17
 * Time: 11:06 AM
 */

namespace common\helpers;

use Yii;
use yii\helpers\Json;
use yii\httpclient\Client;

class AuthHelper {

	public $u_sid;
	public $sid;
	public $uri;
	public $redirect_uri;
	public $access_token;
	public $refresh_token;
	public $id_token;
	public $token_expires_in;

	private static $header = [
		'Authorization' => 'Bearer ztucZS1ZyFKgh0tUEruUtiSTXhnexmd6',
		'Content-Type'  => 'application/json',
	];

	/**
	 * @param $url
	 * @param $response_type
	 * @param $scope
	 * @param $client_id
	 * @param $redirect_uri
	 *
	 * @return bool
	 */
	public function actionAuth( $url, $response_type, $scope, $client_id, $redirect_uri ) {

		$client = new Client();

		$body = Json::encode( [
			'query' => http_build_query( [
				'response_type' => $response_type,
				'scope'         => $scope,
				'client_id'     => $client_id,
				'redirect_uri'  => $redirect_uri
			] )
		] );

		$response = $client->post( $url, $body, AuthController::$header )->send();
		if ( $response->isOk ) {
			if ( ! empty( $response->data['sid'] ) ) {
				$this->sid = $response->data['sid'];
			}
		}

		return false;
	}

	/**
	 * @param $url
	 * @param $sub
	 * @param $data
	 *
	 * @return bool
	 */
	public function get_sub_id( $url, $sub, $data ) {

		$client = new Client();
		$body   = Json::encode( [
			'sub'      => $sub,
			'max_idle' => Yii::$app->params['max_idle'],
			'data'     => $data,
		] );

		$response = $client->put( $url, $body, AuthController::$header )->send();
		$result   = json_decode( $response->content, true );
		if ( ! empty( $result['sub_session'] ) ) {
			$this->u_sid = $result['sub_session']['sid'];
		} else {
			$this->u_sid        = $result['sub_sid'];
			$this->redirect_uri = $result['parameters']['uri'];
		}

		return false;
	}

	/**
	 * @param $url
	 * @param $scope
	 * @param $clamps
	 */
	public function get_uri( $url, $scope, $clamps ) {

		$client = new Client();

		$body = Json::encode( [
			'scope'  => $scope,
			'claims' => $clamps
		] );

		$response = $client->put( $url, $body, AuthController::$header )->send();

		if ( $response->isOk ) {
			$this->redirect_uri = json_decode( $response->content )->parameters->uri;
		}
	}

	/**
	 * @param $url
	 * @param $redirect_uri
	 * @param $name
	 *
	 * @return bool|mixed
	 */
	public function create_app( $url, $redirect_uri, $name ) {

		$client = new Client();

		$data = Json::encode( [
			'client_name'   => $name,
			'redirect_uris' => $redirect_uri
		] );

		$response = $client->post( $url, $data, AuthController::$header )->send();

		if ( $response->isOk ) {
			return json_decode( $response->content );
		}

		return false;
	}

	/**
	 * @param $url
	 * @param $id
	 *
	 * @return bool
	 */
	public function delete_app( $url, $id ) {

		$client = new Client();
		$body   = Json::encode( [
			'redirect_uris' => $id
		] );

		$url = $url . '/' . $id;
		$client->delete( $url, $body, AuthController::$header )->send();

		return false;
	}

	/*
	 * Get all application had in server
	 * */
	public function getAllApp() {

		$client = new Client();

		$app = $client->get( Yii::$app->params['url_clientRegistration'], null, AuthController::$header )->send();

		return json_decode( $app->content );
	}

	/**
	 * @param $url
	 * @param $code
	 * @param $key
	 * @param $redirect_uri
	 */
	public function get_access_token( $url, $code, $key, $redirect_uri ) {

		$header = [
			'Authorization' => 'Basic ' . $key,
			'Content-Type'  => 'application/x-www-form-urlencoded'
		];

		$client = new Client();

		$body = http_build_query( [
			'grant_type'   => 'authorization_code',
			'code'         => $code,
			'redirect_uri' => $redirect_uri
		] );

		$response = $client->post( $url, $body, $header )->send();

		if ( $response->isOk ) {
			$result                 = json_decode( $response->content, true );
			$this->access_token     = $result['access_token'];
			$this->id_token         = $result['id_token'];
			$this->token_expires_in = $result['expires_in'];
		}
	}

	/**
	 * @param $url
	 * @param $access_token
	 *
	 * @return bool|mixed
	 */
	public function get_user_info( $url, $access_token ) {

		$header = array(
			'Authorization' => 'Bearer ' . $access_token,
			'Content-Type'  => 'application/json'
		);

		$client   = new Client();
		$response = $client->get( $url, null, $header )->send();

		if ( $response->isOk ) {
			$result = json_decode( $response->content, true );

			return $result;
		}

		return false;
	}
}