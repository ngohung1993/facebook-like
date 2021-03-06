<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
?>
<div class="site-reset-password">
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">
            <h1><?= Html::encode( $this->title ) ?></h1>

            <p>Please choose your new password:</p>

			<?php $form = ActiveForm::begin( [ 'id' => 'reset-password-form' ] ); ?>

			<?= $form->field( $model, 'password' )->passwordInput( [ 'autofocus' => true ] ) ?>

            <div class="form-group">
				<?= Html::submitButton( 'Save', [ 'class' => 'btn btn-success', 'style' => 'width:100%' ] ) ?>
            </div>

			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
