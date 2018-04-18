<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $token string */

$activeLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/sign-in/reset-password', 'token' => $token]);
?>

你好 <?php echo Html::encode($user->username) ?>！ <br/>
<p>
收到本电邮意味着您在 <?=Yii::$app->name ?> 网站提出了重置密码的申请，
您可以点击以下链接继续完成重置密码流程
（如果您的浏览器或邮箱不支持自动跳转，请将该链接复制粘贴到浏览器地址栏执行）。
如果这不是您本人提出的申请，为保护您的隐私安全请无视该电邮，并不向任何人透露以下链接：<br/>
</p>

<?php echo Html::a(Html::encode($activeLink), $activeLink) ?>
