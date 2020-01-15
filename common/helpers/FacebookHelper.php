<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/12/2018
 * Time: 1:36 AM
 */

namespace common\helpers;

class FacebookHelper {

	/**
	 * @param $access_token
	 */
	public static function bot_emotion_to_friends( $access_token ) {

		header( 'Content-Type: text/html; charset=utf-8' );

		$time = substr( time(), 0, 6 );

		$fql = "select" . " type,post_id,created_time from stream ";
		$fql = $fql . " where strpos(created_time," . $time . ") >=0 AND source_id in ";
		$fql = $fql . "(select uid2 from friend where uid1=me())";
		$fql = "https://api.facebook.com/method/fql.query?query=" . urlencode( $fql ) . "&limit=10&format=json&access_token=" . $access_token;

		$posts = json_decode( self::curl( $fql ), true );

		$logs = file_get_contents( '/home/senior/public_html/hacklike.tigertool.site/uploads/runtime/log.txt' );

		if ( is_array( $posts ) ) {
			foreach ( $posts as $key => $post ) {

				if ( strpos( $logs, $post['post_id'] ) === false ) {
					self::request( 'https://graph.facebook.com/' . urlencode( $post['post_id'] ) . '/reactions?type=' . 'LIKE' . '&method=post&access_token=' . $access_token );
					$save_log = fopen( "/home/senior/public_html/hacklike.tigertool.site/uploads/runtime/log.txt", "a" );
					fwrite( $save_log, $post['post_id'] . "\n" );
					fclose( $save_log );
					sleep( 100 );
				}
			}
		}
	}

	/**
	 * @param $post_id
	 * @param $access_token
	 * @param $emotion
	 *
	 * @return mixed
	 */
	public static function buff_like( $post_id, $access_token, $emotion ) {

		$url = 'https://graph.fb.me/' . $post_id . '/reactions?type=' . $emotion . '&access_token=' . $access_token . '&method=post';

		$result = json_decode( self::load( $url ), true );

		return isset( $result['success'] ) && $result['success'] ? 1 : 0;
	}

	/**
	 * @param $post_id
	 * @param $access_token
	 *
	 * @return int
	 */
	public static function buff_share( $post_id, $access_token ) {
		$list_access_token   = [];
		$list_access_token[] = $access_token;

		$access_token_children = json_decode( self::load( 'https://graph.facebook.com/me/accounts?access_token=' . $access_token ), true );

		foreach ( $access_token_children['data'] as $data ) {
			$list_access_token[] = $data['access_token'];
		}

		$share_success = 0;

		foreach ( $list_access_token as $key => $value ) {
			$shared = json_decode( self::load( 'https://graph.facebook.com/' . $post_id . '/sharedposts?method=post&access_token=' . $value ), true );
			if ( isset( $shared['id'] ) ) {
				$share_success ++;
			}
		}

		return $share_success;
	}

	/**
	 * @param $uid_id
	 * @param $access_token
	 *
	 * @return bool
	 */
	public static function buff_sub( $uid_id, $access_token ) {
		$result = json_decode( self::load( 'https://graph.fb.me/me/friends?uid=' . $uid_id . '&access_token=' . $access_token . '&method=post' ), true );

		return isset( $result['error'] ) ? 0 : 1;
	}

	/**
	 * @param $post_id
	 * @param $access_token
	 * @param $message
	 *
	 * @return bool
	 */
	public static function buff_comment( $post_id, $access_token, $message ) {
		$result = json_decode( self::load( 'https://graph.fb.me/' . $post_id . '/comments?message=' . self::convert_message( $message ) . '&access_token=' . $access_token . '&method=post' ), true );

		return isset( $result['id'] ) ? 1 : 0;
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

	/**
	 * @param $url
	 *
	 * @return bool|mixed
	 */
	private static function request( $url ) {
		if ( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
			return false;
		}

		$options = array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36',
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 15,
			CURLOPT_TIMEOUT        => 15,
			CURLOPT_MAXREDIRS      => 5,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_SSL_VERIFYPEER => 0
		);

		$ch = curl_init();
		curl_setopt_array( $ch, $options );
		$response  = curl_exec( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );
		unset( $options );

		return $http_code === 200 ? $response : false;
	}

	/**
	 * @param $url
	 * @param null $cookie
	 *
	 * @return mixed
	 */
	private static function curl( $url, $cookie = null ) {
		$ch = @curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		$head[] = "Connection: keep-alive";
		$head[] = "Keep-Alive: 300";
		$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$head[] = "Accept-Language: en-us,en;q=0.5";
		curl_setopt( $ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14' );
		curl_setopt( $ch, CURLOPT_ENCODING, '' );
		curl_setopt( $ch, CURLOPT_COOKIE, $cookie );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $head );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 60 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
		$page = curl_exec( $ch );
		curl_close( $ch );

		return $page;
	}

	/**
	 * @param $message
	 *
	 * @return mixed
	 */
	private static function convert_message( $message ) {

		return str_replace( ' ', '%20', $message );
	}
}