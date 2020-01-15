<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;


class HelpController extends BaseController {

	/**
	 * @return string
	 */
	public function actionIndex() {

		$profile_url = 'https://www.facebook.com/leviet173';
		function get_web_page( $url ) {
			$user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
			$options    = array(
				CURLOPT_CUSTOMREQUEST  => "GET",        //set request type post or get
				CURLOPT_POST           => false,        //set to GET
				CURLOPT_USERAGENT      => $user_agent, //set user agent
				CURLOPT_COOKIEFILE     => "cookie.txt", //set cookie file
				CURLOPT_COOKIEJAR      => "cookie.txt", //set cookie jar
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			);
			$ch         = curl_init( $url );
			curl_setopt_array( $ch, $options );
			$content = curl_exec( $ch );
			$err     = curl_errno( $ch );
			$errmsg  = curl_error( $ch );
			$header  = curl_getinfo( $ch );
			curl_close( $ch );
			$header['errno']   = $err;
			$header['errmsg']  = $errmsg;
			$header['content'] = $content;

			return $header;
		}

		/*Getting user id */
		$url  = 'http://findmyfbid.com';
		$data = array( 'url' => $profile_url );
// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => array(
					'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201',
					"Content-type: application/x-www-form-urlencoded\r\n"
				),
				'method'  => 'POST',
				'content' => http_build_query( $data ),
			),
		);
		$context = stream_context_create( $options );
		$result  = file_get_contents( $url, false, $context );
		function getData( $data ) {

			$document = new \DOMDocument( '1.0', 'UTF-8' );

			$internalErrors = libxml_use_internal_errors( true );

			$document->loadHTML( $data );

			$document->loadHTML( $data );
			libxml_use_internal_errors( $internalErrors );

			$divs = $document->getElementsByTagName( 'code' );

			foreach ( $divs as $div ) {

				var_dump( $div->nodeValue );

				return $div->nodeValue;
			}

			return false;
		}

		$uid = getData( $result );

		var_dump( $uid );
		die;

		return $this->render( 'index' );
	}

	/**
	 * @return string
	 */
	public function actionSettingFacebook() {
		return $this->render( 'setting-facebook' );
	}

}
