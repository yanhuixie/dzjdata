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
            <div style="font-size: 16px;">
                <?php
                $curBlock = 0;
                $curlineNum = 0;
                $preLine = null;
                foreach ($pageArray as $curline) {
                    // 初始化
                    if (empty(trim($preLine)) && !empty(trim($curline))) {
                        ++$curBlock;
                        $curlineNum = 1;
                    }
                    // 判断当前列
                    if ($curBlock == $model->block_num && $curlineNum == $model->line_num)
                        echo '<span style="color: red">' . $curline . '</span><br/>';
                    else
                        echo $curline . '<br/>';
                    // 后处理
                    $preLine = $curline;
                    $curlineNum++;
                }
                ?>
            </div>
            <hr/>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'is_right')->radioList([1 => '是', 0 => '否'], ['itemOptions' => ['style' => ['width' => '30px', 'height' => '30px']]]); ?>
            <?php if (empty($model->remark)) {
                echo $form->field($model, 'remark')->dropDownList(['', '位置不对', '图文不对应', '千字文不对', '夹注小字缺少文字', '其它',],
                    ['maxlength' => true, 'style' => 'width:80%']);
            } else {
                echo $form->field($model, 'remark')->textInput(['maxlength' => true]);
            }
            ?>
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <hr/>
            <div>
                <p>【帮助】</p>
                <p>1. 检查位置：红色千字文所在行的位置和图片中的位置是否一致；</p>
                <p>2. 检查文字内容：红色千字文的内容和图片中是否一致。</p>
                <p>发现问题时，请选择“否”，并将错误信息填写在备注中。 </p>
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
