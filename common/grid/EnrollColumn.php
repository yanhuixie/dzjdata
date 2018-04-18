<?php

namespace common\grid;

use Yii;
use yii\grid\ActionColumn as YiiActionColumn;

class EnrollColumn extends YiiActionColumn
{
    public $template = '{view} {update} {delete} {do-enroll}';

    public $header = '报名';

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('do-enroll', 'pencil', [
            'data-confirm' => Yii::t('yii', 'Make a confirmation before you enroll this activity.'),
            'data-method' => 'ajax',
        ]);
    }
}
