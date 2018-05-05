<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use frontend\models\TptkPage;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkAddThouChar */

$this->params['breadcrumbs'][] = '嘉兴藏';
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


    <?php foreach ($notes as $note) { ?>
        <div style="height: 700px;">
            <div class="col-md-6">
                <?= $note['image'] ?>
                <img src="<?= $note['image'] ?>" style="width:100%;"/>
            </div>
            <div class="col-md-6">
                <?php foreach ($note['txt'] as $line) {
                    echo $line . '<br/>';
                } ?>
            </div>
        </div>
    <?php } ?>
</div>

