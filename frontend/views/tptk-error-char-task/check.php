<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use frontend\models\TptkErrorCharTask;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TptkErrorCharTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '阙疑文字校对任务管理';
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
                'attribute' => 'tptk_page',
                'format' => 'raw',
                'value' => function ($data) {
                    //超链接
                    return Html::a($data->tptkErrorChar->page, "/tptk-error-char/update?id=" . $data->tripitaka_error_char_id, ['title' => '查看', 'target' => '_blank']);
                }
            ],
            [
                'label' => '行号',
                'attribute' => 'tptk_line',
                'value' => 'tptkErrorChar.line',
            ],
            [
                'label' => '校对结果',
                'attribute' => 'tptk_check_txt',
                'value' => 'tptkErrorChar.check_txt',
            ],
            [
                'label' => '领取用户',
                'attribute' => 'user_id',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return empty($data['status']) ? '' : TptkErrorCharTask::statuses()[$data['status']];
                },
                'filter' => TptkErrorCharTask::statuses()
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            //'created_at',
            //'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    ?>
</div>
