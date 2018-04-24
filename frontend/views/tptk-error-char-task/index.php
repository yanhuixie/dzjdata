<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TptkErrorCharTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Tptk Error Char Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common', 'Create Tptk Error Char Task'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tptk_error_char_id',
            'user_id',
            'task_type',
            'status',
            //'created_at',
            //'assigned_at',
            //'completed_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
