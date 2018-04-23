<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tptk-error-char-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line')->textInput() ?>

    <?= $form->field($model, 'line_txt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'error_char')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_txt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirm_txt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
