<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TptkAddThouChar;
use frontend\models\search\TptkAddThouCharSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TptkAddThouCharController implements the CRUD actions for TptkAddThouChar model.
 */
class TptkAddThouCharController extends Controller
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
     * Displays a single TptkAddThouChar model.
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
     * Finds the TptkAddThouChar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TptkAddThouChar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TptkAddThouChar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }


    /**
     * Add.
     * 千字文补录.
     * @id 实体数据的id
     */
    public function actionCheck($id = null, $update = 0)
    {
        if (!$id) {
            $nextTask = TptkAddThouChar::getNextTodoTask();
            return $this->redirect(['check', 'id' => $nextTask->id]);
        }

        $model = $this->findModel($id);
        if ($model->is_right === null) {
            $model->is_right = 1;
        }

        $pageArr = explode('_', $model->page_code);
        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
        $model->imagePath = 'https://s3.cn-north-1.amazonaws.com.cn/lqdzj-image/' . $pageArr[0] . '/' . $pageArr[1] . '/' . $model->page_code . '.jpg';
        $txtUrlPath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $pageArr[0] . '/txt/' . $pageArr[1] . '/' . $model->page_code . '.txt';
        $pageArray = file($txtUrlPath);

        if ($model->load(Yii::$app->request->post())) {
            // 保存当前记录
            $model->status = TptkAddThouChar::STATUS_FINISHED;
            $model->user_id = Yii::$app->user->id;
            $model->completed_at = time();

            if ($model->save()) {
                // 跳转
                if ($update) {
                    return $this->redirect(['view', 'id' => $id]);
                } else {
                    // 获取下一条记录
                    $nextTask = TptkAddThouChar::getNextTodoTask();
                    return $this->redirect(['check', 'id' => $nextTask->id]);
                }
            }
        }

        return $this->render('check', [
            'model' => $model,
            'pageArray' => $pageArray
        ]);
    }


    /**
     * Add.
     * 千字文补录.
     * @id 实体数据的id
     */
    public function actionCheckTask()
    {
        include 'AddThouChar.php';

        $storageDir = 'D:/Projects/dzjdata/storage/web/source/dzjdata/';
        $fileNotExist = [];
        // 检查每个model对应的图片和文件是否存在
        foreach ($page_codes as $page_code) {
            $image_path = $storageDir .explode('_', $page_code)[0] .  '/image/' . explode('_', $page_code)[1] . '/' . $page_code . '.jpg';
            $txt_path = $storageDir . explode('_', $page_code)[0] . '/txt/' . explode('_', $page_code)[1] . '/' . $page_code . '.txt';
            if (!file_exists($image_path)) {
                $fileNotExist[] = $page_code;
            } elseif (!file_exists($txt_path)) {
                $fileNotExist[] = $page_code;
            }
        }

        foreach (array_unique($fileNotExist) as $item) {
            echo $item . '<br/>';
        }

        echo 'Done!';
        die;


    }

    /**
     * Add.
     * 任务管理
     * @return mixed
     */
    public function actionTask()
    {
        $searchModel = new TptkAddThouCharSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('task', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Add.
     * 任务管理
     * @return mixed
     */
    public function actionMyTask()
    {
        $searchModel = new TptkAddThouCharSearch();
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkAddThouCharSearch']['user_id'] = Yii::$app->user->id;
        $dataProvider = $searchModel->search($conditions);

        return $this->render('my-task', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
