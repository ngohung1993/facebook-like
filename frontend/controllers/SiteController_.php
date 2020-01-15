<?php

namespace frontend\controllers;

use common\helpers\AuthHelper;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\FunctionHelper;
use common\models\Product;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\helpers\ClientHelper;
use yii\httpclient\Client;

/**
 * Site controller
 */
class SiteController_ extends Controller {
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
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => [ 'post' ],
				],
			],
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

		$this->layout = 'site';

		return $this->render( 'index' );
	}

	/**
	 * @param $ct
	 * @param $category_id
	 *
	 * @return array
	 */
	protected function search( $ct, $category_id ) {
		$query = null;
		if ( $ct ) {
			$query = Product::find();

			$ct = explode( ',', $ct );

			foreach ( $ct as $key => $value ) {
				$query->orWhere( [ 'category_id' => $value ] );
			}
		} else {

			$fun           = new FunctionHelper;
			$categories_id = $fun->get_all_categories_id_children( FunctionHelper::get_categories(), $category_id );

			$query = Product::find()->orWhere( [ 'category_id' => $category_id ] );
			foreach ( $categories_id as $key => $value ) {
				$query->orWhere( [ 'category_id' => $value ] );
			}
		}

		$pagination = new Pagination( [
			'defaultPageSize' => 9,
			'totalCount'      => $query->count(),
		] );

		$search = $query->offset( $pagination->offset )->limit( $pagination->limit )
		                ->orderBy( 'product.id DESC' )
		                ->orderBy( 'product.featured DESC' )
		                ->asArray()->all();

		return [
			'search' => $search,
			'pages'  => $pagination,
			'ct'     => $ct
		];

	}

	/**
	 * @param null $category_slug
	 * @param null $content_slug
	 * @param null $ct
	 *
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException
	 */
	public function actionView( $category_slug = null, $content_slug = null, $ct = null ) {
		$category = FunctionHelper::get_category_by_slug( $category_slug );

		if ( ! $category ) {
			throw new NotFoundHttpException( Yii::t( 'app', 'The requested page does not exist.' ) );
		}

		$post = FunctionHelper::get_post_by_slug( $content_slug );

		$page = '';

		$search = $this->search( $ct, $category['id'] );

		switch ( $category['page']['key'] ) {
			case 'news-page':
				if ( ! $post && $content_slug ) {
					throw new NotFoundHttpException( Yii::t( 'app', 'The requested page does not exist.' ) );
				}

				$page = ! $post ? 'news-page' : 'detail-news-page';
				break;
			case 'single-page':
				$page = 'single-page';
				break;
			case 'posting-page':
				$page = 'posting-page';
				break;
			case 'project-page':
				break;
			case 'ad-page':
				break;
			case 'contact-page':
				$page = 'contact-page';
				break;
			case 'product-page':
				$page = 'product-page';
				break;
			case 'pricing-page':
				$page = 'pricing-page';
				break;
			default;
				return $this->redirect( [ 'site/index' ] );
				break;
		}

		return $this->render( $page, [
			'category' => $category,
			'post'     => $post,
			'products' => $search['search'],
			'pages'    => $search['pages'],
		] );
	}

	/**
	 * @param null $code
	 *
	 * @return \yii\web\Response
	 */
	public function actionLogin( $code=null ) {

		if ( ! Yii::$app->user->isGuest ) {
			return $this->goHome();
		}

		$key = base64_encode( ClientHelper::$config['client_id'] . ':' . ClientHelper::$config['client_secret'] );

		$auth = new AuthHelper();

		$auth->get_access_token( ClientHelper::$config['url_token'], $code, $key, ClientHelper::$config['url_return'] );

		$user_info = $auth->get_user_info( ClientHelper::$config['url_user_info'], $auth->access_token );

		$client = new Client();

		$header = [
			'Content-Type' => 'application/x-www-form-urlencoded'
		];

		$post_data = array(
			'api_key'  => ClientHelper::$config['client_id'],
			'username' => $user_info['sub'],
		);

		$body = http_build_query( [
			'client_id' => ClientHelper::$config['client_id'],
			'sig'       => $this->generate_sig( $post_data, ClientHelper::$config['client_secret'] ),
			'username'  => $user_info['sub'],
		] );

		$response = $client->post( ClientHelper::$config['url_user_info_server'], $body, $header )->send();

		if ( $response->isOk ) {
			$user = User::findByUsername( $response->data['username'] );

			if ( ! $user ) {
				$model = new SignupForm();

				$model->username = $response->data['username'];
				$model->email    = $response->data['username'];
				$model->password = 'Thangngo@123';

				if ( $user = $model->signup() ) {

					$user['avatar']    = $response->data['avatar'];
					$user['last_name'] = $response->data['name'];

					$user->save();
				}
			}

			if ( $user ) {
				$model = new LoginForm();

				$model->username = $response->data['username'];
				$model->password = 'Thangngo@123';

				if ( $model->login() ) {
					return $this->redirect( [ 'buff-share/index' ] );
				}
			}
		}

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
