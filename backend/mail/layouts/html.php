<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message bing composed */
/* @var $content string main view render result */

$email = Yii::$app->keyStorage->get('hr-email', 'hr@lqsic.cn');
$tel   = Yii::$app->keyStorage->get('hr-tel', '010-62409092-221');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::$app->charset ?>" />
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?php echo $content ?>
    <?php $this->endBody() ?>

    <p> 
    ※注意：本电邮为系统自动发送，请勿直接回复，如有需要请联系下方电邮或电话。<br/><br/>
    以上。<br/>
    －－－－－－－－－－－－－－－－－－－－－<br/>
    龙泉寺智能信息中心 敬上<br/>
    Email: <a href="mailto:<?=$email?>"><?=$email?></a> <br/>
    电话：<?=$tel?><br/>
    －－－－－－－－－－－－－－－－－－－－－
    </p>
    <p> </p>
    <p>
	敬告收件方：<br/>
	<br/>
	本电邮所包含或其随附的信息可能属于保密信息，仅供指定收件方使用。如阁下并非本电邮指明的收件方，请将阁下拥有的本电邮及其所有备份（包括所有附件）删除并销毁，
	并将阁下误收本电邮一事通知发件方或北京龙泉寺智能信息中心；在此特提请阁下注意不得泄露、复制或散发本电邮，并不得倚赖本电邮而采取任何行动。<br/>
	<br/>
	电邮或其他电子信息可能含有计算机病毒或其他缺陷。北京龙泉寺智能信息中心并未作出与该等事项有关的任何保证，亦不对因病毒或缺陷引起的任何损失或损害承担责任。
	请注意，北京龙泉寺智能信息中心在法律允许的范围内，保留对其系统所收到或发出的电邮或其他电子信息予以监控及保存的权利。<br/>
	<br/>
	NOTICE TO RECIPIENT(S):<br/>
	<br/>
	The information contained in and accompanying this email may be confidential, and is intended solely for the use of the intended recipient(s). 
	If you are not the intended recipient of this email, please delete and destroy all copies (including any attachments) in your possession, 
	notify the sender or "AI & IT Center of Beijing LongQuanSi". that you have received this email in error; 
	and you are hereby notified that any disclosure, duplication or dissemination of, or the taking of any action in reliance on, 
	this email is expressly prohibited.<br/>
	<br/>
	E-mail or other electronic messages may contain computer viruses or other defects. "AI & IT Center of Beijing LongQuanSi" 
	makes no warranties in relation to these matters and does not accept liability for any loss or damage caused by any viruses or defects.  
	Please note that "AI & IT Center of Beijing LongQuanSi" reserves the right to monitor and record e-mail or other electronic messages to 
	and from its systems as permitted by applicable law.<br/>
    </p>
</body>
</html>
<?php $this->endPage() ?>
