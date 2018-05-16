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
     * Lists all TptkErrorChar models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new TptkErrorCharSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
     * Add.
     * Check errors.
     * @id tptk_error_char_id
     * @update 0: 工作提交，完成后跳转下一个任务； 1：更新提交，完成后跳转查看页面
     */
    public function actionCheck($id = null, $update = 0)
    {
        if (!$id) {
            $nextTask = TptkErrorCharTask::getNextTodoTask(TptkErrorCharTask::TYPE_CHECK);
            return $this->redirect(['check', 'id' => $nextTask->tptk_error_char_id]);
        }

        $model = $this->findModel($id);
        if (empty($model->check_txt)) {
            $model->check_txt = $model->line_txt;
        }
        if (empty($model->if_doubt)) {
            $model->if_doubt = 0;
        }

        $pageArr = explode('_', $model->page_code);
        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
        $model->imagePath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $pageArr[0] . '/image/' . $pageArr[1] . '/' . $model->page_code . '.jpg';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 保存当前记录
            $curTask = TptkErrorCharTask::findOne(['tptk_error_char_id' => $id, 'task_type' => TptkErrorCharTask::TYPE_CHECK]);
            if ($curTask !== null) {
                $curTask->status = TptkErrorCharTask::STATUS_FINISHED;
                $curTask->completed_at = time();
                $curTask->save();
            }

            // 将审查任务状态设置为就绪
            $ConfirmTask = TptkErrorCharTask::findOne(['tptk_error_char_id' => $curTask->tptk_error_char_id, 'task_type' => TptkErrorCharTask::TYPE_CONFIRM]);
            if ($ConfirmTask !== null) {
                $ConfirmTask->status = TptkErrorCharTask::STATUS_UNASSIGNED;
                $ConfirmTask->save();
            }

            // 跳转
            if ($update) {
                return $this->redirect(['view', 'id' => $id]);
            } else {
                // 获取下一条记录
                $nextTask = TptkErrorCharTask::getNextTodoTask(TptkErrorCharTask::TYPE_CHECK);
                return $this->redirect(['check', 'id' => $nextTask->tptk_error_char_id]);
            }
        }

        return $this->render('check', [
            'model' => $model,
        ]);
    }

    /**
     * Add.
     * Confirm errors.
     * @id tptk_error_char_id
     * @update 0: 工作提交，完成后跳转下一个任务； 1：更新提交，完成后跳转查看页面
     */
    public function actionConfirm($id = null, $update = 0)
    {
        if (!$id) {
            $nextTask = TptkErrorCharTask::getNextTodoTask(TptkErrorCharTask::TYPE_CONFIRM);
            if ($nextTask) {
                return $this->redirect(['confirm', 'id' => $nextTask->tptk_error_char_id]);
            } else {
                return $this->redirect(['no-task']);
            }
        }

        $model = $this->findModel($id);
        if (empty($model->confirm_txt)) {
            $model->confirm_txt = $model->check_txt;
        }

        $pageArr = explode('_', $model->page_code);
        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
        $model->imagePath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $pageArr[0] . '/image/' . $pageArr[1] . '/' . $model->page_code . '.jpg';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 保存当前记录
            $curTask = TptkErrorCharTask::findOne(['tptk_error_char_id' => $id, 'task_type' => TptkErrorCharTask::TYPE_CONFIRM]);
            if ($curTask !== null) {
                $curTask->status = TptkErrorCharTask::STATUS_FINISHED;
                $curTask->completed_at = time();
                $curTask->save();
            }

            // 跳转
            if ($update) {
                return $this->redirect(['view', 'id' => $id]);
            } else {
                // 获取下一条记录
                $nextTask = TptkErrorCharTask::getNextTodoTask(TptkErrorCharTask::TYPE_CONFIRM);
                if ($nextTask) {
                    return $this->redirect(['confirm', 'id' => $nextTask->tptk_error_char_id]);
                } else {
                    return $this->redirect(['no-task']);
                }
            }
        }

        return $this->render('confirm', [
            'model' => $model,
        ]);
    }

    /**
     * Add.
     * Confirm errors.
     */
    public function actionNoTask()
    {

        return $this->render('no-task');
    }
}
