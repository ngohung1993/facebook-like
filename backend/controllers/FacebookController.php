<?php

namespace backend\controllers;

use yii\web\Controller;

class FacebookController extends Controller {

	/**
	 * Lists all Facebook models.
	 * @return mixed
	 */
	public function actionIndex() {

		return $this->render( 'index' );
	}
}