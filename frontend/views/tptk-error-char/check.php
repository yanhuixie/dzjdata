<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */

$this->title = $model->page_code;
$this->params['breadcrumbs'][] = ['label' => '阙疑文字', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <style type="text/css">
        .control-button {
            float: right;
        }

        #image-page {
            width: 100%;
        }
    </style>

    <div class="tptk-error-char-view">


        <div class="col-md-8" style="overflow:auto; height: 600px;">
            <div class="control-button">
                <button class="btn btn-default glyphicon glyphicon-zoom-in"
                        onclick="changeSize('image-page','+');"></button>
                <button class="btn btn-default glyphicon glyphicon-zoom-out"
                        onclick="changeSize('image-page','-');"></button>
            </div>
            <img src="<?= $model->imagePath ?>" alt="<?= $model->page_code ?>" id="image-page" style="width:100%;"/>
        </div>

        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->errorSummary($model); ?>
            <?= $form->field($model, 'line_num')->textInput(['readonly' => true]) ?>
            <?= $form->field($model, 'error_char')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            <?= $form->field($model, 'check_txt')->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>

<?php
$script = <<<SCRIPT
    function changeSize(id,action){
        var obj=document.getElementById(id);
        obj.style.width=parseInt(obj.style.width)+(action=='+'?+10:-10)+'%';
    }


SCRIPT;

$this->registerJs($script, \yii\web\View::POS_END);
