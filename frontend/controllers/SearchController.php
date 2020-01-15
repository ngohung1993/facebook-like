<?php

namespace frontend\controllers;

use common\helpers\ConnectHelper;
use frontend\controllers\base\BaseController;

class SearchController extends BaseController {

	public function actionIndex() {

		$facebook_accounts = ConnectHelper::get_access_token_by_username( $this->user->username );

		return $this->render( 'index', [
			'user'              => $this->user,
			'facebook_accounts' => $facebook_accounts
		] );
	}

}
