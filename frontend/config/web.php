<?php
$config = [
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
            'shouldBeActivated' => false
        ],
        'api' => [
            'class' => 'frontend\modules\api\Module',
            'modules' => [
                'v1' => 'frontend\modules\api\v1\Module'
            ]
        ],
    	'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
    	'frbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'menus' => [
                'user'      => null, // disable menu
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
    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => env('GITHUB_CLIENT_ID'),
                    'clientSecret' => env('GITHUB_CLIENT_SECRET')
                ],

            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => 'common\components\maintenance\Maintenance',
            'enabled' => function ($app) {
                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
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
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => YII_ENV_DEV ? 
			[
				'*',
			] :
    		[
	            'user/sign-in/login',
    			'user/sign-in/logout',
    			'user/sign-in/signup', 
				'user/sign-in/request-password-reset', 
				'user/sign-in/reset-password', 
				'user/sign-in/oauth', 
				'user/sign-in/activation', 
				'user/sign-in/captcha', 
				'user/sign-in/avatar-upload', 
				'user/sign-in/avatar-delete',
    			'site/captcha',
    			'site/error',
    			'site/set-locale',
    			'site/index',
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
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'messageCategory'=>'frontend'
            ]
        ]
    ];
}

return $config;
