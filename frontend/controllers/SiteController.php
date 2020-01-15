<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\helpers\ClientHelper;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => [ 'logout', 'signup' ],
				'rules' => [
					[
						'actions' => [ 'signup' ],
						'allow'   => true,
						'roles'   => [ '?' ],
					],
					[
						'actions' => [ 'logout' ],
						'allow'   => true,
						'roles'   => [ '@' ],
					],
				],
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex() {

		return $this->render( 'index' );
	}

	/**
	 * @param null $code
	 *
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException
	 */
	public function actionLogin( $code = null ) {

		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}

		$client = new Client();

		$header = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$post_data = array(
			'api_key' => ClientHelper::$config['client_id'],
			'code'    => $code
		);

		$body = http_build_query( [
			'client_id' => ClientHelper::$config['client_id'],
			'sig'       => $this->generate_sig( $post_data, ClientHelper::$config['client_secret'] ),
			'code'      => $code
		] );

		$response = $client->post( ClientHelper::$config['url_user_info_server'], $body, $header )->send();

		if ( $response->isOk ) {
			$user = User::findByUsername( $response->data['username'] );

			if ( ! $user ) {
				$model = new SignupForm();

				$model->username = $response->data['username'];
				$model->email    = $response->data['username'];
				$model->password = 'Thangngo@123';

				$user = $model->signup();
			}

			if ( $user ) {

				$user['avatar']    = $response->data['avatar'];
				$user['last_name'] = $response->data['name'];

				$user->save();

				$model = new LoginForm();

				$model->username = $response->data['username'];
				$model->password = 'Thangngo@123';

				if ( $model->login() ) {
					return $this->redirect( [ 'site/index' ] );
				}
			}
		} else {
			throw new NotFoundHttpException( Yii::t( 'app', 'The requested page does not exist.' ) );
		}

		return $this->render( 'login' );

	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact() {
		$model = new ContactForm();
		if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
			if ( $model->sendEmail( Yii::$app->params['adminEmail'] ) ) {
				Yii::$app->session->setFlash( 'success', 'Thank you for contacting us. We will respond to you as soon as possible.' );
			} else {
				Yii::$app->session->setFlash( 'error', 'There was an error sending your message.' );
			}

			return $this->refresh();
		} else {
			return $this->render( 'contact-page', [
				'model' => $model,
			] );
		}
	}

	/**
	 * Displays post page.
	 *
	 * @return mixed
	 */
	public function actionPost() {
		return $this->render( 'post' );
	}

	/**
	 * Displays post page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		return $this->render( 'create' );
	}

	/**
	 * Displays about page.
	 *
	 * @return mixed
	 */
	public function actionAbout() {
		return $this->render( 'about' );
	}

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 */
	public function actionSignup() {

		$this->layout = 'account';

		$model = new SignupForm();
		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $user = $model->signup() ) {
				if ( Yii::$app->getUser()->login( $user ) ) {
					return $this->goHome();
				}
			}
		}

		return $this->render( 'signup', [
			'model' => $model,
		] );
	}

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionRequestPasswordReset() {

		$this->layout = 'account';

		$model = new PasswordResetRequestForm();
		if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
			if ( $model->sendEmail() ) {
				Yii::$app->session->setFlash( 'success', 'Check your email for further instructions.' );

				return $this->goHome();
			} else {
				Yii::$app->session->setFlash( 'error', 'Sorry, we are unable to reset password for the provided email address.' );
			}
		}

		return $this->render( 'requestPasswordResetToken', [
			'model' => $model,
		] );
	}

	/**
	 * Resets password.
	 *
	 * @param string $token
	 *
	 * @return mixed
	 * @throws BadRequestHttpException
	 */
	public function actionResetPassword( $token ) {

		$this->layout = 'account';

		try {
			$model = new ResetPasswordForm( $token );
		} catch ( InvalidParamException $e ) {
			throw new BadRequestHttpException( $e->getMessage() );
		}

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() && $model->resetPassword() ) {
			Yii::$app->session->setFlash( 'success', 'New password saved.' );

			return $this->goHome();
		}

		return $this->render( 'resetPassword', [
			'model' => $model,
		] );
	}

	/**
	 * @param $post_data
	 * @param $secret_key
	 *
	 * @return string
	 */
	private function generate_sig( $post_data, $secret_key ) {
		$text_sig = '';
		foreach ( $post_data as $key => $value ) {
			$text_sig .= '$key=$value';
		}

		$text_sig .= $secret_key;
		$text_sig = md5( $text_sig );

		return $text_sig;
	}
}