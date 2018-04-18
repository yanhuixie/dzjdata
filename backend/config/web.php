<?php
$config = [
    'homeUrl'=>Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute'=>'timeline-event/index',
    'controllerMap'=>[
        'file-manager-elfinder' => [
            'class' => mihaildev\elfinder\Controller::class,
            'access' => ['manager'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@storageUrl',
                    'basePath' => '@storage',
                    'path'   => '/',
                    'access' => ['read' => 'manager', 'write' => 'manager']
                ]
            ]
        ]
    ],
    'components'=>[
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY'),
            'baseUrl' => env('BACKEND_BASE_URL')
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}',
            'defaultRoles'=> ['guest'],
        ],
    ],
    'modules'=>[
        'i18n' => [
            'class' => backend\modules\i18n\Module::class,
            'defaultRoute'=>'i18n-message/index'
        ],
    	'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
        ],
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'brbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'menus' => [
                'user' => null, // disable menu
            ],
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User', 
                    'idField' => 'id',
                    'usernameField' => 'username',
                    'fullnameField' => 'fullname',
                    'extraColumns' => [
                        [
                            'attribute' => 'full_name',
                            'label' => '姓名',
                            'value' => function($model, $key, $index, $column) {
                                return $model->fullname;
                            },
                        ],
                    ],
                    'searchClass' => 'backend\models\search\UserSearch'
                ],
            ],
    	],
    	'db-mgr' => [
            'class' => 'common\modules\bsdbmgr\Module',
            // path to directory for the dumps
            'path' => '@storage/web/source/backup/mysql/',
            // list of registerd db-components
            'dbList' => ['db'],
        ],
    ],
	'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => YII_ENV_DEV ? 
			[
				'*',
			] :
			[
	            'sign-in/login',
				'sign-in/logout',
				'site/error',
	            // The actions listed here will be allowed to everyone including guests.
	            // So, 'admin/*' should not appear here in the production, of course.
	            // But in the earlier stages of your development, you may probably want to
	            // add a lot of actions here until you finally completed setting up rbac,
	            // otherwise you may not even take a first step.
        ]
    ],
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'generators' => [
            'crud' => [
                'class' => yii\gii\generators\crud\Generator::class,
                'templates' => [
                    'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates')
                ],
                'template' => 'yii2-starter-kit',
                'messageCategory' => 'backend'
            ]
        ]
    ];
}

return $config;
