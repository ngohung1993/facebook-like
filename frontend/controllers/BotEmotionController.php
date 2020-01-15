<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\BotEmotion;
use common\helpers\ConnectHelper;
use common\models\base\BotEmotionSearch;
use frontend\controllers\base\BaseController;

/**
 * BotEmotionController implements the CRUD actions for BotEmotion model.
 */
class BotEmotionController extends BaseController {

	/**
	 * Lists all BotEmotion models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new BotEmotionSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render( 'index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Lists all BotEmotion models.
	 * @return mixed
	 */
	public function actionMe() {
		$model = new BotEmotion();

		$buff_emotions = BotEmotion::find()->where( [ 'user_id' => $this->user->id ] )->andWhere( [ 'type' => 1 ] )->all();

		$facebook_accounts = ConnectHelper::get_access_token_by_username( $this->user->username );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			$this->user['money'] -= 40000 * $model->months;

			$this->user->save();

			$model->user_id = $this->user->id;
			$model->type    = 1;

			$model->start = date( 'Y-m-d H:i:s', time() );
			$model->end   = date( 'Y-m-d H:i:s', time() + $model->months * 3600 * 24 );

			$model->save();

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'me', [
			'model'             => $model,
			'buff_emotions'     => $buff_emotions,
			'facebook_accounts' => $facebook_accounts
		] );
	}

	/**
	 * Lists all BotEmotion models.
	 * @return mixed
	 */
	public function actionFriends() {
		$model = new BotEmotion();

		$buff_emotions = BotEmotion::find()->where( [ 'user_id' => $this->user->id ] )->all();

		$facebook_accounts = ConnectHelper::get_access_token_by_username( $this->user->username );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			$this->user['money'] -= 40000 * $model->months;

			$this->user->save();

			$model->user_id = $this->user->id;
			$model->type    = 2;

			$model->start = date( 'Y-m-d H:i:s', time() );
			$model->end   = date( 'Y-m-d H:i:s', time() + $model->months * 3600 * 24 );

			$model->save();

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'friends', [
			'user'              => $this->user,
			'model'             => $model,
			'buff_emotions'     => $buff_emotions,
			'facebook_accounts' => $facebook_accounts
		] );
	}

	/**
	 * Displays a single BotEmotion model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView( $id ) {
		return $this->render( 'view', [
			'model' => $this->findModel( $id ),
		] );
	}

	/**
	 * Creates a new BotEmotion model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new BotEmotion();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing BotEmotion model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate( $id ) {
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'update', [
			'model' => $model,
		] );
	}

	/**
	 * Deletes an existing BotEmotion model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete( $id ) {
		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the BotEmotion model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return BotEmotion the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = BotEmotion::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
