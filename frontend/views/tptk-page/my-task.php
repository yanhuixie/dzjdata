<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\TptkPage;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TptkAddThouCharSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Tptk Pages');
$this->params['breadcrumbs'][] = '我的任务';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-page-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'page_code',
                'headerOptions' => ['style' => 'width:10%'],
                'format' => 'raw',
                'value' => function ($data) {
                    //超链接
                    return Html::a($data->page_code, "/tptk-page/check?update=1&id=" . $data->id, ['title' => '查看', 'target' => '_blank']);
                }
            ],
            [
                'attribute' => 'page_source',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return TptkPage::pageSources()[$data['page_source']];
                },
                'filter' => TptkPage::pageSources()
            ],
            [
                'attribute' => 'if_match',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return array(1 => '是', 0 => '否', null => '')[$data['if_match']];
                },
                'filter' => [1 => '是', 0 => '否']
            ],
            [
                'attribute' => 'page_type',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return $data['page_type'] ? TptkPage::pageTypes()[$data['page_type']] : '';
                },
                'filter' => TptkPage::pageTypes()
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return TptkPage::statuses()[$data['status']];
                },
                'filter' => TptkPage::statuses()
            ],
            'remark',
            [
                'attribute' => 'assigned_at',
                'headerOptions' => ['style' => 'width:12%'],
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'completed_at',
                'headerOptions' => ['style' => 'width:12%'],
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
