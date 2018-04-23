<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TptkErrorCharSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Tptk Error Chars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'page',
            // 'image_path',
            'line',
            'error_char',
            'line_txt',
            //'check_txt',
            //'confirm_txt',
            //'status',
            //'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
