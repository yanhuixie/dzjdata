<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use frontend\models\TptkErrorCharTask;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TptkErrorCharTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '阙疑文字审查';
$this->params['breadcrumbs'][] = '任务管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-task-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label' => '阙疑页码',
                'attribute' => 'tptk_page_code',
                'headerOptions' => ['style' => 'width:10%'],
                'format' => 'raw',
                'value' => function ($data) {
                    //超链接
                    return Html::a($data->tptkErrorChar->page_code, "/tptk-error-char/check?update=1&id=" . $data->tptk_error_char_id, ['title' => '查看', 'target' => '_blank']);
                }
            ],
            [
                'label' => '行号',
                'attribute' => 'tptk_line_num',
                'headerOptions' => ['style' => 'width:5%'],
                'value' => 'tptkErrorChar.line_num',
            ],
            [
                'label' => '原始文字',
                'attribute' => 'tptk_line_txt',
                'value' => 'tptkErrorChar.line_txt',
            ],
            [
                'label' => '校对结果',
                'attribute' => 'tptk_check_txt',
                'value' => 'tptkErrorChar.check_txt',
            ],
            [
                'label' => '审查结果',
                'attribute' => 'tptk_confirm_txt',
                'value' => 'tptkErrorChar.confirm_txt',
            ],
            [
                'label' => '是否存疑',
                'attribute' => 'tptk_if_doubt',
                'value' => function ($data) {
                    return [0 => '否', 1 => '是', null => ''][$data->tptkErrorChar->if_doubt];
                },
                'filter' => [0 => '否', 1 => '是']
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['style' => 'width:8%'],
                'value' => function ($data) {
                    return TptkErrorCharTask::statuses()[$data['status']];
                },
                'filter' => TptkErrorCharTask::statuses()
            ],
            [
                'label' => '备注',
                'attribute' => 'tptk_remark',
                'value' => 'tptkErrorChar.remark',
            ],
            [
                'label' => '领取用户',
                'headerOptions' => ['style' => 'width:8%'],
                'attribute' => 'user_name',
                'value' => 'user.username'
            ],
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

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    ?>
</div>
