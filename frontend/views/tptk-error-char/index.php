<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\TptkErrorChar;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TptkErrorCharSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Tptk Error Chars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'page_code',
                'headerOptions' => ['style' => 'width:14%'],
            ],
            [
                'attribute' => 'line_num',
                'headerOptions' => ['style' => 'width:8%'],
            ],
            [
                'attribute' => 'error_char',
                'headerOptions' => ['style' => 'width:8%'],
            ],
            'line_txt',
            'check_txt',
            'confirm_txt',
            [
                'attribute' => 'remark',
                'headerOptions' => ['style' => 'width:15%'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
