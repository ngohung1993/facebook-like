<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BotEmotion */

$this->title = 'Create Bot Emotion';
$this->params['breadcrumbs'][] = ['label' => 'Bot Emotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bot-emotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
