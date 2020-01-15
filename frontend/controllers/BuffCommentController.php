<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\BuffComment;
use common\helpers\ConnectHelper;
use frontend\controllers\base\BaseController;

/**
 * BuffCommentController implements the CRUD actions for BuffComment model.
 */
class BuffCommentController extends BaseController {

	/**
	 * Lists all BuffComment models.
	 * @return mixed
	 */
	public function actionIndex() {
		$model = new BuffComment();

		$buff_comments = BuffComment::find()->where( [ 'user_id' => $this->user->id ] )->all();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			$this->user['money'] -= 100 * $model->comment_total;
			$this->user->save();

			$model->user_id = $this->user->id;
			$model->save();

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'index', [
			'model'         => $model,
			'buff_comments' => $buff_comments,
			'user'          => $this->user
		] );
	}

	/**
	 * Lists all BuffComment models.
	 * @return mixed
	 */
	public function actionFree() {
		$model = new BuffComment();

		$buff_comments = BuffComment::find()->where( [ 'user_id' => $this->user->id ] )->all();

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
			'buff_comments'     => $buff_comments,
			'facebook_accounts' => $facebook_accounts
		] );
	}

	/**
	 * Displays a single BuffComment model.
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
	 * Creates a new BuffComment model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new BuffComment();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing BuffComment model.
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
	 * Deletes an existing BuffComment model.
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
	 * Finds the BuffComment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return BuffComment the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = BuffComment::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
