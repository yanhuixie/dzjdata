<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkAddThouChar */

$this->title = $model->page_code;
$this->params['breadcrumbs'][] = '千字文补录';
$this->params['breadcrumbs'][] = $model->page_code;
$this->params['breadcrumbs'][] = array('1' => '上栏', '2' => '下栏')[$model->block_num];
$this->params['breadcrumbs'][] = '第' . $model->line_num . '行';
?>


    <style type="text/css">
        .control-button {
            float: right;
        }

        #image-page {
            width: 100%;
        }
    </style>

    <div class="tptk-add-thou-char-update">


        <div class="col-md-7" style="overflow:auto; height: 700px;">
            <div class="control-button">
                <button class="btn btn-default glyphicon glyphicon-zoom-in"
                        onclick="changeSize('image-page','+');"></button>
                <button class="btn btn-default glyphicon glyphicon-zoom-out"
                        onclick="changeSize('image-page','-');"></button>
            </div>
            <img src="<?= $model->imagePath ?>" alt="<?= $model->page_code ?>" id="image-page" style="width:100%;"/>
        </div>

        <div class="col-md-5">
            <div style="font-size: 16px;">
                <?php foreach ($pageArray as $item) {
                    echo $item . '<br/>';
                } ?>
            </div>
            <hr/>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'is_right')->radioList([1 => '是', 0 => '否'], ['maxlength' => true]) ?>
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true, 'style'=>'width:80%']) ?>
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
