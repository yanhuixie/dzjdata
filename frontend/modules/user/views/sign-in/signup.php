<?php
use common\models\User;
use kartik\builder\Form;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\base\BizMeta;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?php echo Html::encode($this->title) ?></h1>
    
	<?php echo \common\widgets\DbText::widget(['key'=>'frontend.reg.tips']); ?>
	
	<div class="user-form">
		<?php echo "<legend>个人信息</legend>"; ?>
		<?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableAjaxValidation' => false]); 	
			// echo Form::widget([
			// 	'model'=>$profile,
			// 	'form'=>$form,
			// 	'columns'=>1,
			// 	'attributes'=>[
			// 		'picture' =>[
			// 			'type' => Form::INPUT_WIDGET,
			// 			'widgetClass' => '\trntv\filekit\widget\Upload',
			// 			'options' =>[
			// 				'url' => ['avatar-upload']
			// 			],
			// 			'hint' => '请注意必须为本人真实照片'
			// 		],
			// 	]
			// ]);
			
			echo Form::widget([
				'model'=>$profile,
				'form'=>$form,
				'columns'=>2,
				'attributes'=>[
					'firstname'=>[ 
						'type' => Form::INPUT_TEXT,
						'options' => [
							'placeholder' => '实名全称'
						] 
					],
					'gender'=>[
						'type' => Form::INPUT_RADIO_LIST,
						'items' => BizMeta::genders(),
						'options'=>[ 
							'inline' => true,
						],
					],
				]
			]);
		?>
	
		<?php echo "<legend>系统信息</legend>"; ?>
        <div></div>
		<?php
			echo Form::widget([
				'model'=>$model,
				'form'=>$form,
				'columns'=>2,
				'attributes'=>[
					'username'=>[ 
						'type' => Form::INPUT_TEXT,
						'options' => [
							'placeholder' => '为登录本系统所用，不能重复'
						] 
					],
					'email'=>[ 
						'type' => Form::INPUT_TEXT,
						'options' => [
							'placeholder' => '为登录本系统所用，必须真实有效'
						] 
					],
					'password'=>[ 
						'type' => Form::INPUT_PASSWORD,
						'options' => [
							'placeholder' => '至少6位，请勿使用弱智密码'
						] 
					],

				]
			]);
		?>
		<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
				'captchaAction'=>'/user/sign-in/captcha',
				'imageOptions' =>['alt'=>'点击换图', 'title'=>'点击换图', 'style'=>'cursor:pointer'],
                'template' => '<div class="row"><div class="col-lg-3">{image} {input}</div></div>',
            ]) ?>

		<div class="form-group">
			<?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
		</div>
		<?php ActiveForm::end(); ?>
	
	</div>
</div>

