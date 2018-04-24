<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]); ?>
        <?php echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                // ['label' => Yii::t('frontend', 'Home'), 'url' => ['/site/index']],
                ['label' => Yii::t('frontend', '阙疑文字校对'), 'url' => ['/tptk-error-char/check']],
                ['label' => Yii::t('frontend', '阙疑文字审查'), 'url' => ['/tptk-error-char/confirm']],
                // ['label' => Yii::t('frontend', 'Help'), 'url' => ['/article/index']],
                // ['label' => Yii::t('frontend', 'About'), 'url' => ['/page/view', 'slug'=>'about']],
                ['label' => Yii::t('frontend', 'Signup'), 'url' => ['/user/sign-in/signup'], 'visible' => Yii::$app->user->isGuest],
                ['label' => Yii::t('frontend', 'Login'), 'url' => ['/user/sign-in/login'], 'visible' => Yii::$app->user->isGuest],
                [
                    'label' => '我的任务',
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        [
                            'label' => '阙疑文字校对',
                            'url' => ['tptk-error-char-task/my-check']
                        ],
                        [
                            'label' => '阙疑文字审查',
                            'url' => ['tptk-error-char-task/my-confirm']
                        ],
                    ]
                ],
                [
                    'label' => '任务管理',
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        [
                            'label' => '阙疑文字校对',
                            'url' => ['tptk-error-char-task/check']
                        ],
                        [
                            'label' => '阙疑文字检查',
                            'url' => ['tptk-error-char-task/confirm']
                        ],
                    ]
                ],
                [
                    'label' => '数据管理',
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        [
                            'label' => '阙疑文字',
                            'url' => ['tptk-error-char/index']
                        ],
                    ]
                ],
                [
                    'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        [
                            'label' => Yii::t('frontend', 'Settings'),
                            'url' => ['/user/default/index']
                        ],
                        [
                            'label' => Yii::t('frontend', 'Backend'),
                            'url' => Yii::getAlias('@backendUrl'),
                            'visible' => Yii::$app->user->can('loginToBackend')
                        ],
                        [
                            'label' => Yii::t('frontend', 'Logout'),
                            'url' => ['/user/sign-in/logout'],
                            'linkOptions' => ['data-method' => 'post']
                        ]
                    ]
                ]
            ]
        ]); ?>
        <?php NavBar::end(); ?>

        <?php echo $content ?>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; lqsaic <?php echo date('Y') ?></p>
            <p class="pull-right">Powered by lqsaic.</p>
        </div>
    </footer>
<?php $this->endContent() ?>