<?php

namespace frontend\controllers\base;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\User;

/**
 * BaseController
 */
class BaseController extends Controller {
	/***
	 * @var User
	 */
	public $user;

	/**
	 * @inheritdoc
	 * @throws NotFoundHttpException
	 */
	public function init() {
		parent::init(); // TODO: Change the autogenerated stub

		if ( ! Yii::$app->user->isGuest ) {
			$this->user = $this->findModel( Yii::$app->user->identity->getId() );
		}
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => [ 'index', 'create', 'delete', 'free', 'me', 'friends' ],
				'rules' => [
					[
						'actions' => [ 'index', 'create', 'delete', 'free', 'me', 'friends' ],
						'allow'   => true,
						'roles'   => [ '@' ]
					]
				]
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'POST' ],
				]
			]
		];
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	private function findModel( $id ) {
		if ( ( $model = User::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist . ' );
		}
	}
}
