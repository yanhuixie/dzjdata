<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TptkPage;
use frontend\models\search\TptkPageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * TptkPageController implements the CRUD actions for TptkPage model.
 */
class TptkPageController extends Controller
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
     * Lists all TptkPage models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new TptkPageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TptkPage model.
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
     * Finds the TptkPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TptkPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TptkPage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    /**
     * Add.
     * Generate task.
     */
    public function actionGenerateTask()
    {
        $t = time();
        $dataDir = Yii::$app->basePath . '/../storage/web/source/dzjdata/';

        // 处理永乐北藏，两次循环，向下处理两层目录
//        $ybDir = $dataDir . 'YB/image/';
//        if ($dh = opendir($ybDir)) {
//            while (($volume = readdir($dh)) !== false) {
//                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
//                    $inDh = opendir($ybDir . "/" . $volume);
//                    while (($page = readdir($inDh)) !== false) {
//                        if (!is_dir($ybDir . "/" . $page)) {
//                            $model = new TptkPage();
//                            $model->page_source = TptkPage::SOURCE_YB;
//                            $model->page_code = str_replace('.jpg', '', $page);
//                            $model->status = 1;
//                            $model->created_at = $t;
//                            if (!$model->save()) {
//                                echo $page . ': failed.';
//                            }
//                        }
//                    }
//                    closedir($inDh);
//                }
//            }
//            closedir($dh);
//        }

        // 处理乾隆大藏经，两次循环，向下处理两层目录
//        $ybDir = $dataDir . 'QL/image/';
//        if ($dh = opendir($ybDir)) {
//            while (($volume = readdir($dh)) !== false) {
//                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
//                    $inDh = opendir($ybDir . "/" . $volume);
//                    while (($page = readdir($inDh)) !== false) {
//                        if (!is_dir($ybDir . "/" . $page)) {
//                            $model = new TptkPage();
//                            $model->page_source = TptkPage::SOURCE_QL;
//                            $model->page_code = str_replace('.jpg', '', $page);
//                            $model->status = 1;
//                            $model->created_at = $t;
//                            if (!$model->save()) {
//                                echo $page . ': failed.';
//                            }
//                        }
//                    }
//                    closedir($inDh);
//                }
//            }
//            closedir($dh);
//        }

        // 处理嘉兴藏标准图片
//        $ybDir = $dataDir . 'JX/txt/standard/';
//        if ($dh = opendir($ybDir)) {
//            while (($volume = readdir($dh)) !== false) {
//                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
//                    $inDh = opendir($ybDir . "/" . $volume);
//                    while (($page = readdir($inDh)) !== false) {
//                        if (!is_dir($ybDir . "/" . $page)) {
//                            $model = new TptkPage();
//                            $model->page_source = TptkPage::SOURCE_JX;
//                            $model->page_code = str_replace('.txt', '', $page);
//                            $model->status = 0;
//                            $model->image_path = 'JX/image/'.$volume.'/'.$model->page_code.'.jpg';
//                            $model->txt = 'JX/txt/standard/'.$volume.'/'.$model->page_code.'.txt';;
//                            $model->page_type = TptkPage::TYPE_STANDARD_PIC;
//                            $model->created_at = $t;
//                            if (!$model->save()) {
//                                echo $page . ': failed.';
//                            }
//                        }
//                    }
//                    closedir($inDh);
//                }
//            }
//            closedir($dh);
//        }

        // 处理嘉兴藏夹注小字
//        $ybDir = $dataDir . 'JX/txt/notes/';
//        if ($dh = opendir($ybDir)) {
//            while (($volume = readdir($dh)) !== false) {
//                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
//                    $inDh = opendir($ybDir . "/" . $volume);
//                    while (($page = readdir($inDh)) !== false) {
//                        if (!is_dir($ybDir . "/" . $page)) {
//                            $model = new TptkPage();
//                            $model->page_source = TptkPage::SOURCE_JX;
//                            $model->page_code = str_replace('.txt', '', $page);
//                            $model->status = 0;
//                            $model->image_path = 'JX/image/'.$volume.'/'.$model->page_code.'.jpg';
//                            $model->txt = 'JX/txt/notes/'.$volume.'/'.$model->page_code.'.txt';;
//                            $model->page_type = TptkPage::TYPE_SMALL_NOTES;
//                            $model->created_at = $t;
//                            if (!$model->save()) {
//                                echo $page . ': failed.';
//                            }
//                        }
//                    }
//                    closedir($inDh);
//                }
//
//            }
//            closedir($dh);
//        }

//
//        // 处理嘉兴藏
        $ybDir = $dataDir . 'JX/txt/empty/';
        if ($dh = opendir($ybDir)) {
            while (($volume = readdir($dh)) !== false) {
                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
                    $inDh = opendir($ybDir . "/" . $volume);
                    while (($page = readdir($inDh)) !== false) {
                        if (!is_dir($ybDir . "/" . $page)) {
                            $model = new TptkPage();
                            $model->page_source = TptkPage::SOURCE_JX;
                            $model->page_code = str_replace('.txt', '', $page);
                            $model->status = 0;
                            $model->image_path = 'JX/image/' . $volume . '/' . $model->page_code . '.jpg';
                            $model->txt = 'JX/txt/empty/' . $volume . '/' . $model->page_code . '.txt';;
                            $model->page_type = TptkPage::TYPE_NO_TEXT;
                            $model->created_at = $t;
                            if (!$model->save()) {
                                echo $page . ': failed.';
                            }
                        }
                    }
                    closedir($inDh);
                }
            }
            closedir($dh);
        }

        echo 'generate success.';
    }



//    /**
//     * 检查嘉兴藏
//     * Add.
//     */
//    public function actionCheckJx()
//    {
//        $dataDir = Yii::$app->basePath . '/../storage/web/source/dzjdata/';
//        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
//
//
//        mb_regex_encoding('utf-8');
//        $notes = [];
//        $files = [];
//
//        $standards = [];
    // 检查夹注小字，文本中应该有一行字数是超过19，否则可疑
//        $ybDir = $dataDir . 'JX/txt/notes/';
//        $idx = 1;
//        if ($dh = opendir($ybDir)) {
//            while (($volume = readdir($dh)) !== false) {
//                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
//                    $inDh = opendir($ybDir . "/" . $volume);
//                    while (($page = readdir($inDh)) !== false) {
//                        if (!is_dir($ybDir . "/" . $page)) {
//                            $ifNotes = false;
//                            $array = file($ybDir . "/" . $volume . '/' . $page);
//                            foreach ($array as $item) {
//                                if (mb_strlen($item, 'utf-8') > 19)
//                                    $ifNotes = true;
//                            }
//                            // 如果所有行的字数都不超过14，则作为夹注小字来讲可疑
//                            if (!$ifNotes) {
//                                $notes[$idx]['image'] = 'http://storage.' . $hostInfo . '/source/dzjdata/JX/image/' . $volume . '/' . str_replace('.txt', '.jpg', $page);
//                                $notes[$idx++]['txt'] = $array;
//                            }
//                        }
//                    }
//                    closedir($inDh);
//                }
//
//            }
//            closedir($dh);
//        }
//
//        // 检查嘉兴藏标准图片，文本中所有行都不超过19，否则可疑
//        $ybDir = $dataDir . 'JX/txt/standard/';
//        $idx = 1;
//        if ($dh = opendir($ybDir)) {
//            while (($volume = readdir($dh)) !== false) {
//                if (is_dir($ybDir . "/" . $volume) && $volume != "." && $volume != "..") {
//                    $inDh = opendir($ybDir . "/" . $volume);
//                    while (($page = readdir($inDh)) !== false) {
//                        if (!is_dir($ybDir . "/" . $page)) {
//                            $ifStandard = true;
//                            $array = file($ybDir . "/" . $volume . '/' . $page);
//                            foreach ($array as $item) {
//                                $item = trim($item);
//                                $item = mb_ereg_replace("[：？。，、；！『』「」《》]", '', $item, "UTF-8");
////                                $item = str_replace('?', '', $item);
//                                if (mb_strlen($item, 'utf-8') > 20) {
//                                    $ifStandard = false;
//                                    $notes[] = $volume . '/' . $page . ' : ' . mb_strlen($item, 'utf-8') . ' : ' . $item . "\r\n";
//                                }
//
//                            }
//                            // 如果所有行的字数都不超过19，则作为夹注小字来讲可疑
//                            if (!$ifStandard) {
////                                $notes[$idx]['image'] = 'http://storage.' . $hostInfo . '/source/dzjdata/JX/image/' . $volume . '/' . str_replace('.txt', '.jpg', $page);
////                                $notes[$idx++]['txt'] = $array;
//                                $files[] = $volume . '/' . $page . "\r\n";
//                            }
//
//                        }
//                    }
//                    closedir($inDh);
//                }
//            }
//            closedir($dh);
//        }
//        file_put_contents($dataDir . 'JX/standard-log-lines.txt', $notes);
//        file_put_contents($dataDir . 'JX/standard-log-files.txt', $files);
//        echo 'success!';
//        die;
//        return $this->render('jx-check', [
//            'notes' => $notes,
//        ]);
//
//    }

    /**
     * Add.
     * 图文导航.
     * @id 实体数据的id
     */
    public function actionNavigate($pgcd = 'YB_1_1')
    {
        $model = TptkPage::findOne(['page_code' => $pgcd]);
        if ($model == null) {
            throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
        }
        $pageArr = explode('_', $model->page_code);
        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
        if (empty($model->image_path))
            $model->imagePath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $pageArr[0] . '/image/' . $pageArr[1] . '/' . $model->page_code . '.jpg';
        else
            $model->imagePath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $model->image_path;

        if (empty($model->image_path))
            $txtUrlPath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $pageArr[0] . '/txt/' . $pageArr[1] . '/' . $model->page_code . '.txt';
        else
            $txtUrlPath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $model->txt;
        $pageArray = file($txtUrlPath);

        return $this->render('navigate', [
            'model' => $model,
            'pageArray' => $pageArray,
        ]);
    }


    /**
     * Add.
     * 图文类型检查.
     * @id 实体数据的id
     */
    public function actionCheck($id = null, $update = 0)
    {
        if (!$id) {
            $nextTask = TptkPage::getNextTodoTask();
            if ($nextTask)
                return $this->redirect(['check', 'id' => $nextTask->id]);
            else
                return $this->redirect(['site/error', 'message' => '任务已领取完毕！']);
        }

        $model = $this->findModel($id);
        if (empty($model->if_match)) {
            $model->if_match = 1;
        }
        if (empty($model->page_type)) {
            $model->page_type = 4;
        }

        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
        $model->imagePath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $model->image_path;
        $txtUrlPath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $model->txt;
        $pageArray = file($txtUrlPath);

        if ($model->load(Yii::$app->request->post())) {
            // 保存当前记录
            $model->status = TptkPage::STATUS_FINISHED;
            $model->user_id = Yii::$app->user->id;
            $model->completed_at = time();

            if ($model->save()) {
                // 跳转
                if ($update) {
                    return $this->redirect(['view', 'id' => $id]);
                } else {
                    // 获取下一条记录
                    $nextTask = TptkPage::getNextTodoTask();
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
     * 嘉兴藏浏览.
     * @id 实体数据的id，嘉兴藏的偏移id
     */
    public function actionJx($id = null)
    {
        $model = TptkPage::find()->where(['page_source' => TptkPage::SOURCE_JX])->orderBy('id asc')->one();
        if ($id) {
            $model = $this->findModel($id + $model->id - 1);
        }

        if (empty($model->if_match)) {
            $model->if_match = 1;
        }


        $hostInfo = str_replace('http://', '', Yii::$app->request->getHostInfo());
        $model->imagePath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $model->image_path;
        $txtUrlPath = 'http://storage.' . $hostInfo . '/source/dzjdata/' . $model->txt;
        $pageArray = file($txtUrlPath);

        $pages = new Pagination([
            'totalCount' => TptkPage::find()->where(['page_source' => TptkPage::SOURCE_JX])->orderBy('id asc')->count(),
            'pageSize' => 1,
            'pageParam' => 'id',
            'pageSizeParam' => false,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            // 保存当前记录
            $model->status = TptkPage::STATUS_FINISHED;
            $model->user_id = Yii::$app->user->id;
            $model->completed_at = time();

            if ($model->save()) {
                // 获取下一条记录
                return $this->redirect(['jx', 'id' => (int)$id + 1]);
            }
        }

        return $this->render('jx', [
            'model' => $model,
            'pageArray' => $pageArray,
            'pages' => $pages,
        ]);
    }

    /**
     * Add.
     * 任务管理
     * @return mixed
     */
    public function actionTask()
    {
        $searchModel = new TptkPageSearch();
        $conditions = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchYBQLJX($conditions);

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
        $searchModel = new TptkPageSearch();
        $conditions = Yii::$app->request->queryParams;
        $conditions['TptkPageSearch']['user_id'] = Yii::$app->user->id;
        $dataProvider = $searchModel->searchYBQLJX($conditions);

        return $this->render('my-task', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
