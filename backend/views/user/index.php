<?php

use common\grid\EnumColumn;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?php echo Html::a(Yii::t('backend', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'options' => [
			'class' => 'grid-view table-responsive'
		],
		'columns' => [
			[
				'attribute' => 'id', 
// 				'filterInputOptions'=>['style'=>'max-width:60px;']
			],
			'userProfile.fullname',
			'email:email',
			[
				'attribute' => 'username', 
// 				'filterInputOptions'=>['style'=>'max-width:120px;']
			],
			[
				'attribute' => 'created_at', 
				'format' => ['datetime', 'php:Y-m-d H:i:s'], 
// 				'filterInputOptions'=>['style'=>'max-width:120px;']
			],
		 	[
		 		'attribute' => 'logged_at', 
		 		'format' => ['datetime', 'php:Y-m-d H:i:s']
			],
			[
				'attribute' => 'updated_at', 
				'format' => ['datetime', 'php:Y-m-d H:i:s']
			],
			[
				'class' => EnumColumn::className(),
				'attribute' => 'status',
				'enum' => User::statuses(),
				'filter' => User::statuses(),
// 				'filterInputOptions'=>['style'=>'max-width:100px;']
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
