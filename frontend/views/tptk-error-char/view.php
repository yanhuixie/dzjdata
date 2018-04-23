<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '阙疑文字', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page',
            'image_path',
            'line',
            'line_txt',
            'error_char',
            'check_txt',
            'confirm_txt',
            'status',
            'remark',
        ],
    ]) ?>

</div>
