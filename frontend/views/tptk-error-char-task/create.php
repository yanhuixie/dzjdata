<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TptkErrorCharTask */

$this->title = 'Create Tptk Error Char Task';
$this->params['breadcrumbs'][] = ['label' => 'Tptk Error Char Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tptk-error-char-task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
