<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 1/18/2018
 * Time: 3:09 PM
 */

namespace console\controllers;

use yii\console\Controller;
use common\models\BotEmotion;
use common\helpers\FacebookHelper;
use common\helpers\ConnectHelper;

class BotController extends Controller {
	public $message;

	public function options( $actionID ) {
		return [ 'message' ];
	}

	public function optionAliases() {
		return [ 'm' => 'message' ];
	}

	public function actionIndex() {

		switch ( $this->message ) {
			case 1:

				$access_tokens = ConnectHelper::get_access_token( 100 );

				$bot_emotions = BotEmotion::find()->where( [ 'type' => 1 ] )->all();

				foreach ( $bot_emotions as $key => $value ) {
					$posts = json_decode( self::load( 'https://graph.facebook.com/v3.0/' . $value['uid'] . '/feed?limit=1&access_token=' . $access_tokens[0][ [ 'access_token' ] ] ), true );

					$today = date( 'Y-m-d' );

					if ( is_array( $posts ) ) {
						foreach ( $posts['data'] as $key_post => $post ) {
							if ( strpos( $post['created_time'], $today ) ) {

								for ( $i = 0; $i < 100; $i ++ ) {
									FacebookHelper::buff_like( $post['post_id'], $access_tokens[ $i ]['access_token'], 'LIKE' );
								}
							}
						}
					}
				}

				break;
			case 2:

				$bot_emotions = BotEmotion::find()->where( [ 'type' => 2 ] )->all();

				foreach ( $bot_emotions as $key => $value ) {
					FacebookHelper::bot_emotion_to_friends( $value['access_token'] );
				}

				break;
			default;
				break;
		}
	}

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	private static function load( $url ) {

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );

		$result = curl_exec( $ch );
		curl_close( $ch );

		return $result;
	}

}