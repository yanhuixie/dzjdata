<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TptkErrorCharTask;
use frontend\models\search\TptkErrorCharTaskSearch;
use frontend\models\TptkErrorChar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TptkErrorCharTaskController implements the CRUD actions for TptkErrorCharTask model.
 */
class TptkErrorCharTaskController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TptkErrorCharTask models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TptkErrorCharTaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TptkErrorCharTask model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TptkErrorCharTask model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TptkErrorCharTask();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TptkErrorCharTask model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TptkErrorCharTask model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TptkErrorCharTask model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TptkErrorCharTask the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TptkErrorCharTask::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
    }

    /**
     * Add.
     * Generate task.
     */
    public function actionGenerateTask()
    {
        $count = TptkErrorChar::find()->count();

        $t = time();

        // 生成初校任务
        for($i = 1; $i<=$count; $i++) {
            $model = new TptkErrorCharTask();
            $model->id = $i;
            $model->tptk_error_char_id = $i;
            $model->task_type = 1;
            $model->status = 0;
            $model->created_at = $t;
            if (!$model->save()) {
                echo $i . ': generate check task failed.';
            }
        }

        // 生成审查任务
        for($i = 1; $i<=$count; $i++) {
            $model = new TptkErrorCharTask();
            $model->id = $count + $i;
            $model->tptk_error_char_id = $i;
            $model->task_type = 2;
            $model->status = 0;
            $model->created_at = $t;
            if (!$model->save()) {
                echo $i . ': generate confirm task failed.';
            }
        }

        echo 'generate success.';
    }


    /**
     * Add.
     * My check task.
     */
    public function actionMyCheck()
    {
        $searchModel = new TptkErrorCharTaskSearch();

        $conditions = array_merge(Yii::$app->request->queryParams, array(
                'TptkErrorCharTaskSearch' => array(
                    'user_id' => Yii::$app->user->id,
                    'task_type' => TptkErrorCharTask::TYPE_CHECK)
            )
        );

        $dataProvider = $searchModel->search($conditions);

        return $this->render('my-check', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Add.
     * My confirm task.
     */
    public function actionMyConfirm()
    {
        $searchModel = new TptkErrorCharTaskSearch();
        $conditions = array_merge(Yii::$app->request->queryParams, array(
                'TptkErrorCharTaskSearch' => array(
                    'user_id' => Yii::$app->user->id,
                    'task_type' => TptkErrorCharTask::TYPE_CHECK)
            )
        );

        $dataProvider = $searchModel->search($conditions);

        return $this->render('my-confirm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Add.
     * Check task.
     */
    public function actionCheck()
    {
//        var_dump(Yii::$app->request->queryParams);
//        echo '<br/>';
        $searchModel = new TptkErrorCharTaskSearch();
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkErrorCharTaskSearch']['task_type'] = TptkErrorCharTask::TYPE_CHECK;
//        var_dump($conditions);
//        die;

        $dataProvider = $searchModel->search($conditions);

        return $this->render('check', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Add.
     * Confirm task.
     */
    public function actionConfirm()
    {
        $searchModel = new TptkErrorCharTaskSearch();
        $conditions = array_merge(Yii::$app->request->queryParams, array(
                'TptkErrorCharTaskSearch' => array(
                    'task_type' => TptkErrorCharTask::TYPE_CONFIRM)
            )
        );

        $dataProvider = $searchModel->search($conditions);

        return $this->render('confirm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
