<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tptk-error-char-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_num')->textInput() ?>

    <?= $form->field($model, 'error_char')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_txt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_txt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirm_txt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
