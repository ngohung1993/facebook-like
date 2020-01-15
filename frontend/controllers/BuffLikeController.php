<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\BuffLike;
use common\helpers\ConnectHelper;
use frontend\controllers\base\BaseController;

/**
 * BuffLikeController implements the CRUD actions for BuffLike model.
 */
class BuffLikeController extends BaseController {

	/**
	 * Lists all BuffLike models.
	 * @return mixed
	 */
	public function actionIndex() {

		$model = new BuffLike();

		$buff_likes = BuffLike::find()->where( [ 'user_id' => $this->user->id ] )->all();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			$this->user['money'] -= 100 * $model->like_total;
			$this->user->save();

			$model->user_id = $this->user->id;
			$model->save();

			Yii::$app->session->setFlash( 'success', true );

			return $this->refresh();
		}

		return $this->render( 'index', [
			'model'      => $model,
			'buff_likes' => $buff_likes,
			'user'       => $this->user
		] );
	}

	/**
	 * Lists all BuffLike models.
	 * @return mixed
	 */
	public function actionFree() {

		$model = new BuffLike();

		$buff_likes = BuffLike::find()->where( [ 'user_id' => $this->user->id ] )->all();

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
			'buff_likes'        => $buff_likes,
			'facebook_accounts' => $facebook_accounts
		] );
	}

	/**
	 * Deletes an existing BuffLike model.
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
	 * Finds the BuffLike model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return BuffLike the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = BuffLike::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
