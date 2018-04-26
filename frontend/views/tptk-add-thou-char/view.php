<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkAddThouChar */

$this->title = $model->page_code;
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Tptk Add Thou Chars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-add-thou-char-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page_code',
            'block_num',
            'line_num',
            'add_txt',
            'is_right',
            'remark',
            'user_id',
            'status',
            'created_at',
            'assigned_at',
            'completed_at',
        ],
    ]) ?>

</div>
