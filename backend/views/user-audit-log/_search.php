<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\UserAuditLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-audit-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'op_time') ?>

    <?= $form->field($model, 'op_user') ?>

    <?= $form->field($model, 'from_ip') ?>

    <?= $form->field($model, 'application') ?>

    <?php // echo $form->field($model, 'module') ?>

    <?php // echo $form->field($model, 'controller') ?>

    <?php // echo $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'get_parms') ?>

    <?php // echo $form->field($model, 'post_parms') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
