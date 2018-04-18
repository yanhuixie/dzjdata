<?php
$config = [
    'modules' => [
        
    ],
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'linkAssets' => env('LINK_ASSETS'),
            'appendTimestamp' => YII_ENV_DEV,
            'bundles' => [
                // 'nullref\datatable\DataTableAsset' => [
                //    'styling' => \nullref\datatable\DataTableAsset::STYLING_BOOTSTRAP,
                // ]
            ],
        ]
    ],
    'as locale' => [
        'class' => 'common\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ],
	'as beforeRequest' => [
    	'class' => '\common\components\UserAuditLogFilter',
    ],
];

// if (YII_DEBUG) {
//     $config['bootstrap'][] = 'debug';
//     $config['modules']['debug'] = [
//         'class' => 'yii\debug\Module',
//         'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '192.168.99.1'],
//     ];
// }

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '192.168.99.1'],
    ];
}


return $config;
