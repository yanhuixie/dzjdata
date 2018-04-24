<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\TptkErrorCharSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tptk-error-char-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'page_code') ?>

    <?= $form->field($model, 'image_path') ?>

    <?= $form->field($model, 'line_num') ?>

    <?= $form->field($model, 'error_char') ?>

    <?php // echo $form->field($model, 'line_txt') ?>

    <?php // echo $form->field($model, 'check_txt') ?>

    <?php // echo $form->field($model, 'confirm_txt') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
