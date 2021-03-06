<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use frontend\models\TptkPage;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkAddThouChar */

$this->title = Yii::t('frontend', 'Tptk Pages');
$this->params['breadcrumbs'][] = TptkPage::pageSources()[$model->page_source];
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
