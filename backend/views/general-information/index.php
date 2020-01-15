<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $general common\models\GeneralInformation */

$this->title = Yii::t('backend', 'General information');

?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $general,
            ]) ?>
        </div>
    </div>
</section>