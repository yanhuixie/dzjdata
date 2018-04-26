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
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkErrorCharTaskSearch']['user_id'] = Yii::$app->user->id;
        $conditions['TptkErrorCharTaskSearch']['task_type'] = TptkErrorCharTask::TYPE_CHECK;

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
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkErrorCharTaskSearch']['user_id'] = Yii::$app->user->id;
        $conditions['TptkErrorCharTaskSearch']['task_type'] = TptkErrorCharTask::TYPE_CONFIRM;

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
        $searchModel = new TptkErrorCharTaskSearch();
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkErrorCharTaskSearch']['task_type'] = TptkErrorCharTask::TYPE_CHECK;

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
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkErrorCharTaskSearch']['task_type'] = TptkErrorCharTask::TYPE_CONFIRM;

        $dataProvider = $searchModel->search($conditions);

        return $this->render('confirm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
