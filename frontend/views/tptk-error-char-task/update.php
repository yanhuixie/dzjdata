<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorCharTask */

$this->title = Yii::t('common', 'Update Tptk Error Char Task: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Tptk Error Char Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="tptk-error-char-task-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
