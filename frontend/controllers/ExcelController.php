<?php

namespace frontend\controllers;

use common\helpers\ConnectHelper;
use frontend\controllers\base\BaseController;

class ExcelController extends BaseController {

	/**
	 * @return string
	 */
	public function actionIndex() {

		$facebook_accounts = ConnectHelper::get_access_token_by_username( $this->user->username );

		return $this->render( 'index', [
			'facebook_accounts' => $facebook_accounts,
			'user'              => $this->user
		] );
	}
}