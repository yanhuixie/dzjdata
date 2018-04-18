<?php
use yii\helpers\Html;

/**
 * @var $this \yii\web\View
 * @var $user \common\models\User
 * @var $url 
 */
?>
<?php 
	$activeLink = Yii::$app->formatter->asUrl($url);
?>

你好 <?php echo Html::encode($user->username) ?>！ <br/>
<p>
收到本电邮意味着您以当前Email地址在 <?=Yii::$app->name ?> 网站注册了一个帐号，
您可以点击以下链接继续完成帐号激活流程
（如果您的浏览器或邮箱不支持自动跳转，请将该链接复制粘贴到浏览器地址栏执行）。
如果这不是您本人提出的申请，为保护您的隐私安全请无视该电邮，并不向任何人透露以下链接。<br/>
</p>
<p>
<?= Yii::t('frontend', 'Your activation link: {url}', ['url' => Yii::$app->formatter->asUrl($url)]) ?>
</p>