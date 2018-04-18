<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserAuditLog */
?>
<div class="user-audit-log-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'op_time',
            'op_user',
            'from_ip',
            'application',
            'module',
            'controller',
            'action',
            'get_parms:ntext',
            'post_parms:ntext',
        ],
    ]) ?>

</div>
