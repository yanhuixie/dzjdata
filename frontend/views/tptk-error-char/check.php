<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */

$this->title = $model->page_code;
$this->params['breadcrumbs'][] = '阙疑文字校对';
$this->params['breadcrumbs'][] = $this->title;
?>

    <style type="text/css">
        .control-button {
            float: right;
        }

        #image-page {
            width: 100%;
        }

        .check-form input {
            font-size: 18px;
        }

    </style>

    <div class="tptk-error-char-view">


        <div class="col-md-7" style="overflow:auto; height: 700px;">
            <div class="control-button">
                <button class="btn btn-default glyphicon glyphicon-zoom-in"
                        onclick="changeSize('image-page','+');"></button>
                <button class="btn btn-default glyphicon glyphicon-zoom-out"
                        onclick="changeSize('image-page','-');"></button>
            </div>
            <img src="<?= $model->imagePath ?>" alt="<?= $model->page_code ?>" id="image-page" style="width:130%;"/>
        </div>

        <div class="col-md-5 check-form">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->errorSummary($model); ?>
            <?= $form->field($model, 'line_num')->textInput(['readonly' => true]) ?>
            <?= $form->field($model, 'error_char')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            <?= $form->field($model, 'check_txt')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'if_doubt')->radioList([0 => '否', 1 => '是'], ['maxlength' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <hr/>
            <div>
                <p>【帮助】</p>
                <p>1. 根据行号的大致提示（有时候不准），在图片中找到阙疑文字对应的汉字，并填写到校对结果中。如果有疑问，可以选择存疑。
                    如果找不到图片对应的文字，则不必修改校对结果，此时请选择存疑；</p>
                <p>2. 按照字形一致的原则进行校对，如果图片中的汉字属于无法写出来（Unicode字符集之外）的异体字，则可以填写对应的正字。如果该异体字可以写出来，则应直接填异体字本身；</p>
                <p>3. 可以根据<a href="http://hanzi.lqdzj.cn" target="_blank">龙泉字库</a>直接查找图片中的阙疑文字。
                    也可以根据前后文到<a href="http://cbetaonline.dila.edu.tw" target="_blank">CBETA Online</a>中查找，以便得到提示。
                    当然，也可以<a href="https://pan.baidu.com/s/1Mpm5-mdjy0JaRgBgNgMz4g" target="_blank">下载</a>（密码：5gou）软件到本地查找，或许更方便。
                </p>


            </div>
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
