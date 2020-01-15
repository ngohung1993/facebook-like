<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use common\models\BuffLike;

/**
 * BuffLikeController implements the CRUD actions for BuffLike model.
 */
class BuffLikeController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'POST' ],
				],
			],
		];
	}

	/**
	 * Lists all BuffLike models.
	 * @return mixed
	 */
	public function actionIndex() {

		$model = new BuffLike();

		$buff_likes = BuffLike::find()->all();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

			return $this->refresh();
		}

		return $this->render( 'index', [
			'model'      => $model,
			'buff_likes' => $buff_likes
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
