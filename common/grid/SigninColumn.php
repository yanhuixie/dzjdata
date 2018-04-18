<?php

namespace common\grid;

use yii\grid\ActionColumn as YiiActionColumn;

class SigninColumn extends YiiActionColumn
{
    public $template = '{view} {update} {delete} {display-code}';

    public $header = '签到';

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('display-code', 'pencil', [
            'data-method' => 'ajax',
        ]);
    }
}
