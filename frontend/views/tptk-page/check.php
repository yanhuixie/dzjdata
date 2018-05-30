<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\TptkPage;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkAddThouChar */

$this->title = $model->page_code;
$this->params['breadcrumbs'][] = '图文类型检查';
$this->params['breadcrumbs'][] = $model->page_code;
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


        <div class="col-md-7" style="overflow:auto; height: 1000px;">
            <div class="control-button">
                <button class="btn btn-default glyphicon glyphicon-zoom-in"
                        onclick="changeSize('image-page','+');"></button>
                <button class="btn btn-default glyphicon glyphicon-zoom-out"
                        onclick="changeSize('image-page','-');"></button>
            </div>
            <img src="<?= $model->imagePath ?>" alt="<?= $model->page_code ?>" id="image-page" style="width:100%;"/>
        </div>

        <div class="col-md-5">
            <div style="font-size: 14px;">
                <?php
                mb_regex_encoding('utf-8');
                $idx = 1;
                foreach ($pageArray as $item) {
                    if ($idx == 1 || $idx == count($pageArray)) {
                        echo '<span style="color: red; font-size: 20px;">' . mb_substr($item, 0, 1) . '</span>' . mb_substr($item, 1) . '<br/>';
                    } else {
                        echo $item . '<br/>';
                    }
                    $idx++;
                }
                ?>
            </div>
            <hr/>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'if_match')->radioList([1 => '是', 0 => '否'], ['maxlength' => true]) ?>
            <?= $form->field($model, 'page_type')->radioList(TptkPage::pageTypes(), ['maxlength' => true]) ?>
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true, 'style' => 'width:80%']) ?>
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <hr/>
            <div>
                <p>【帮助】</p>
                <p>1. 图文是否匹配：检查第一行和最后一行第一个标红的字即可；</p>
                <p>2. 图片类型：</p>
                <p>&nbsp;&nbsp;2.1 标准图片：文字比较规范，包含文字但是不包含夹注小字、特殊文字的图片； </p>
                <p>&nbsp;&nbsp;2.2 含夹注小字：包含夹注小字的图片； </p>
                <p>&nbsp;&nbsp;2.3 不含文字：不包含文字的图片； </p>
                <p>&nbsp;&nbsp;2.4 其它类型：非以上三种情况的类型，比如包含特殊字符。 </p>
            </div>
        </div>

    </div>

<?php
$script = <<<SCRIPT
    function changeSize(id,action){
        var obj=document.getElementById(id);
        obj.style.width=parseInt(obj.style.width)+(action=='+'?+10:-10)+'%';
    }

    function show(event) {  
        var ev = event || window.event;  
        //回车键对应的ASCII是13 
        if (ev.keyCode == 13 || ev.keyCode == 32) {  
            document.getElementById("w0").submit();
        }  
    }  
    //键盘按下事件  
    document.onkeydown = show; 

SCRIPT;

$this->registerJs($script, \yii\web\View::POS_END);
