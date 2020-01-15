<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\BuffSub;
use common\helpers\ConnectHelper;
use frontend\controllers\base\BaseController;

/**
 * BuffSubController implements the CRUD actions for BuffSub model.
 */
class BuffSubController extends BaseController {

	/**
	 * Lists all BuffSub models.
	 * @return mixed
	 */
	public function actionIndex() {
		$model = new BuffSub();

		$buff_subs = BuffSub::find()->where( [ 'user_id' => $this->user->id ] )->all();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			$this->user['money'] -= 100 * $model->subscribe_total;
			$this->user->save();

			$model->user_id = $this->user->id;
			$model->save();

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'index', [
			'model'     => $model,
			'buff_subs' => $buff_subs,
			'user'      => $this->user
		] );
	}

	/**
	 * Lists all BuffSub models.
	 * @return mixed
	 */
	public function actionFree() {
		$model = new BuffSub();

		$buff_subs = BuffSub::find()->where( [ 'user_id' => $this->user->id ] )->all();

		$facebook_accounts = ConnectHelper::get_access_token_by_username( $this->user->username );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			$model->user_id = $this->user->id;
			$model->free    = true;
			$model->save();

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'free', [
			'model'             => $model,
			'buff_subs'         => $buff_subs,
			'facebook_accounts' => $facebook_accounts
		] );
	}

	/**
	 * Displays a single BuffSub model.
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
	 * Creates a new BuffSub model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new BuffSub();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}

		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing BuffSub model.
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
	 * Deletes an existing BuffSub model.
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
	 * Finds the BuffSub model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return BuffSub the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = BuffSub::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
