<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserForm;
use backend\models\search\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UserProfile;
use trntv\filekit\actions\UploadAction;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use common\helpers\CmnHelper;

use yii\helpers\Html;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

	/**
	 *
	 * {@inheritDoc}
	 * @see \yii\base\Controller::actions()
	 */
	public function actions()
	{
		return [
			'upload' => [
				'class' => 'trntv\filekit\actions\UploadAction',
				'deleteRoute' => 'upload-delete',
			],
			'upload-delete' => [
				'class' => 'trntv\filekit\actions\DeleteAction'
			],
			'avatar-upload' => [
				'class' => UploadAction::className(),
				'deleteRoute' => 'avatar-delete',
				'on afterSave' => function ($event) {
					/* @var $file \League\Flysystem\File */
					$file = $event->file;
					$img = ImageManagerStatic::make($file->read())->fit(215, 215);
					$file->put($img->encode());
				}
			],
			'avatar-delete' => [
				'class' => DeleteAction::className()
			]
		];
	}

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new UserForm();
        $model->setModel($this->findModel($id));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$transaction = Yii::$app->db->beginTransaction();
		try{
			Yii::$app->authManager->revokeAll($id);
			$model->delete();
			$transaction->commit();
		}
		catch (\yii\db\Exception $ex){
			$transaction->rollBack();
			$msg = '删除操作失败，该用户[id:%s]已经产生了其他关联业务数据，请先删除其他关联的业务数据再删除该用户。';
			Yii::$app->session->setFlash('alert', [
					'body' => sprintf($msg, $id),
					'options' => ['class' => 'alert-warning']
				]);
			return $this->redirect(Yii::$app->request->referrer);
		}

		return $this->redirect(Yii::$app->request->referrer);
	}


	/**
	 * 根据username或fullname查找用户
	 * @param string $q
	 * @param integer $id
	 * @return array
	 */
	public function actionAutocomplete($q = null, $id = null) {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];

		if (!is_null($q)) {
			$sql = <<<EOF
SELECT p.user_id AS id, concat(ifnull(p.firstname, ''), ' ', ifnull(p.middlename, ''), ' ', ifnull(p.lastname, ''), '(', u.username, ')') AS text
FROM user_profile p LEFT JOIN `user` u ON u.id=p.user_id
WHERE p.firstname LIKE :fn or p.middlename LIKE :fn or p.lastname LIKE :fn or u.username LIKE :fn
LIMIT 20
EOF;
			$data = Yii::$app->db->createCommand($sql, [':fn'=>'%'.$q.'%'])->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => User::find($id)->fullname];
		}

		return $out;
	}
	
	/**
	 * 
	 * @param string $q
	 * @return array[]
	 */
	public function actionQemail($q = null) {
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];

		if (!is_null($q)) {
			$sql = <<<EOF
SELECT p.user_id AS id, concat(ifnull(p.firstname, ''), ' ', ifnull(p.middlename, ''), ' ', ifnull(p.lastname, '')) AS text, u.email
FROM user_profile p LEFT JOIN `user` u ON u.id=p.user_id
WHERE (p.firstname LIKE :fn or p.middlename LIKE :fn or p.lastname LIKE :fn or u.username LIKE :fn)
AND u.email is not null and u.email != ''
LIMIT 20
EOF;
			$data = Yii::$app->db->createCommand($sql, [':fn'=>'%'.$q.'%'])->queryAll();
			$out['results'] = array_map(function($item){
				return [
					'id' => $item['id'], 
					'text' => Html::encode(sprintf("\"%s\"<%s>,", trim($item['text']), $item['email']))
				]; 
			}, $data);
		}

		return $out;
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
