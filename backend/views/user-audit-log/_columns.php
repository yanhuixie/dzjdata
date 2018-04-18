<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'op_time',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'op_user',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'from_ip',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'application',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'module',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'controller',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'action',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'get_parms',
    	'contentOptions' => [
    		'style' => 'max-width:200px;'
    	]
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'post_parms',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template' => '{view}',
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
    ],

];   