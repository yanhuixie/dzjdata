<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */

$this->title = Yii::t('common', 'Create Tptk Error Char');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Tptk Error Chars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
