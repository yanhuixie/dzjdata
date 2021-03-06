<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\TptkAddThouChar;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TptkAddThouCharSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Tptk Add Thou Chars');
$this->params['breadcrumbs'][] = '任务管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-add-thou-char-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'label' => '页码',
                'attribute' => 'page_code',
                'headerOptions' => ['style' => 'width:10%'],
                'format' => 'raw',
                'value' => function ($data) {
                    //超链接
                    return Html::a($data->page_code, "/tptk-add-thou-char/check?update=1&id=" . $data->id, ['title' => '查看', 'target' => '_blank']);
                }
            ],
            [
                'attribute' => 'block_num',
                'value' => 'block_num',
                'headerOptions' => ['style' => 'width:5%'],
            ],
            [
                'attribute' => 'line_num',
                'value' => 'line_num',
                'headerOptions' => ['style' => 'width:5%'],
            ],
            [
                'attribute' => 'add_txt',
                'value' => 'add_txt',
                'headerOptions' => ['style' => 'width:12%'],
            ],
            [
                'attribute' => 'is_right',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return array(1 => '是', 0 => '否', null => '')[$data['is_right']];
                },
                'filter' => array(1 => '是', 0 => '否'),
            ],
            [
                'label' => '领取用户',
                'headerOptions' => ['style' => 'width:8%'],
                'attribute' => 'user_name',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return TptkAddThouChar::statuses()[$data['status']];
                },
                'filter' => TptkAddThouChar::statuses()
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
