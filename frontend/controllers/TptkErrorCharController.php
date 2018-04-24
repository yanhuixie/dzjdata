<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TptkErrorChar;
use frontend\models\search\TptkErrorCharSearch;
use frontend\models\TptkErrorCharTask;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TptkErrorCharController implements the CRUD actions for TptkErrorChar model.
 */
class TptkErrorCharController extends Controller
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
     * Lists all TptkErrorChar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TptkErrorCharSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TptkErrorChar model.
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
     * Creates a new TptkErrorChar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TptkErrorChar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TptkErrorChar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model = $this->findModel($id);
        $pageArr = explode('_', $model->page);
        $model->imagePath = 'http://storage.dzjdata.locl/source/dzjdata/'.$pageArr[0].'/image/'.$pageArr[1].'/'.$model->page.'.jpg';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 保存
            if (($curTask = TptkErrorCharTask::findOne($id)) !== null) {
                $curTask->status = TptkErrorCharTask::STATUS_FINISHED;
                $curTask->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing TptkErrorChar model.
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
     * Finds the TptkErrorChar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TptkErrorChar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TptkErrorChar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
    }

    /**
     * @return mixed
     */
    public function actionCheck($id=null)
    {
        if(!$id) {
            $nextTask = TptkErrorCharTask::getNextTodoTask(TptkErrorCharTask::TYPE_CHECK);
            return $this->redirect(['check', 'id' => $nextTask->id]);
        }

        $model = $this->findModel($id);
        if(empty($model->check_txt)) {
            $model->check_txt = $model->line_txt;
        }
        $pageArr = explode('_', $model->page_code);
        $model->imagePath = 'http://storage.dzjdata.locl/source/dzjdata/'.$pageArr[0].'/image/'.$pageArr[1].'/'.$model->page_code.'.jpg';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 保存上一条记录
            if (($curTask = TptkErrorCharTask::findOne($id)) !== null) {
                $curTask->status = TptkErrorCharTask::STATUS_FINISHED;
                $curTask->save();
            }

            // 获取下一条记录
            $nextTask = TptkErrorCharTask::getNextTodoTask(TptkErrorCharTask::TYPE_CHECK);
            return $this->redirect(['check', 'id' => $nextTask->id]);
        }

        return $this->render('check', [
            'model' => $model,
        ]);
    }
}
