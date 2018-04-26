<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorChar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Tptk Error Chars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page_code',
            'image_path',
            'line_num',
            'error_char',
            'line_txt',
            'check_txt',
            'confirm_txt',
            'if_doubt',
            'remark',
        ],
    ]) ?>

</div>
