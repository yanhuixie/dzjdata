<?php

use common\models\User;
use common\models\UserProfile;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\base\BizMeta;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $eventUsersProvider \yii\data\ActiveDataProvider */
/* @var $groupUsersProvider \yii\data\ActiveDataProvider */

$this->title = $model->getPublicIdentity();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

	<p>
		<?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?php if($profile){ 
	echo "<legend>个人信息</legend>";
	echo DetailView::widget([
		'template' => "<tr><th class='col-md-2'>{label}</th><td>{value}</td></tr>",
		'model' => $profile,
		'attributes' => [
			[
				'attribute' => 'picture',
				'value' => $profile->avatar,
				'format' => ['image',['width'=>'125','height'=>'125']],
			],
			'firstname',
//			 'middlename',
//			 'lastname',
			[
				'attribute' => 'gender', 
				'value' => $profile->gender === null ? null : BizMeta::genders()[$profile->gender]
			],
		],
	]); }?>

	<?php 
	echo "<legend>系统信息</legend>";
	echo DetailView::widget([
		'template' => "<tr><th class='col-md-2'>{label}</th><td>{value}</td></tr>",
		'model' => $model,
		'attributes' => [
			'id',
			'username',
			'auth_key',
			'email:email',
			[
				'attribute' => 'status', 
				'value' => $model->status === null ? null : User::statuses()[$model->status]
			],
			'created_at:datetime',
			'updated_at:datetime',
			'logged_at:datetime',
		],
	]) ?>
	
</div>
