<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkPage */

$this->title = $model->page_code;
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Tptk Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-page-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page_source',
            'page_code',
            'image_path',
//            'txt:ntext',
            'if_match',
            'page_type',
//            'frame_cut:ntext',
//            'line_cut:ntext',
//            'char_cut:ntext',
            'remark',
            'user_id',
            'status',
            'created_at',
            'assigned_at',
            'completed_at',
        ],
    ]) ?>

</div>
