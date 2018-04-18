<?php

use common\models\User;
use kartik\tree\TreeViewInput;
use kartik\widgets\DatePicker;
use kartik\builder\Form;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\base\BizMeta;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */
?>

<div class="user-form">
	<?php echo "<legend>个人信息</legend>"; ?>
	<?php $form = ActiveForm::begin(); 	
		echo Form::widget([
			'model'=>$profile,
			'form'=>$form,
			'columns'=>2,
			'attributes'=>[
				'picture' =>[
					'type' => Form::INPUT_WIDGET,
					'widgetClass' => '\trntv\filekit\widget\Upload',
					'options' =>[
						'url' => ['avatar-upload']
					]
				],
			]
		]);
		
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
						'placeholder' => '为登录本系统所用，不能重复'
					] 
				],
				'password'=>[ 
					'type' => Form::INPUT_PASSWORD,
					'options' => [
						'placeholder' => $model->scenario == 'create' ? '至少6位' : '如不修改请留空'
					] 
				],
				'status' => [ 
					'type' => Form::INPUT_DROPDOWN_LIST,
					'items' => User::statuses(),
					'options'=>[ 
						'prompt'=> ''
					],
				],
				'roles' => [ 
					'type' => Form::INPUT_CHECKBOX_LIST,
					'items' => $roles,
					'options'=>[ 
						'inline' => true,
					],
				],
			]
		]);
	?>
	<div class="form-group">
		<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
	</div>
	<?php ActiveForm::end(); ?>

</div>
