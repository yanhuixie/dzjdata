<?php

namespace frontend\models;

use Yii;
use frontend\models\TptkErrorChar;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "tptk_error_char_task".
 *
 * @property string $id
 * @property string $tripitaka_error_char_id
 * @property int $user_id
 * @property int $task_type
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class TptkErrorCharTask extends \yii\db\ActiveRecord
{

    // 任务类型
    const TYPE_CHECK = 1;
    const TYPE_CONFIRM = 2;

    // 任务状态
    const STATUS_UNASSIGNED = 0;
    const STATUS_ASSIGNED = 1;
    const STATUS_FINISHED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tptk_error_char_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'task_type', 'status', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['user_id', 'task_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tripitaka_error_char_id' => '阙疑文字ID',
            'user_id' => 'User ID',
            'task_type' => '任务类型',
            'status' => '任务状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 自动更新创建和更新时间
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * 阶段
     * Returns user statuses list
     * @return array|mixed
     */
    public static function taskTypes()
    {
        return [
            self::TYPE_CHECK => '校对',
            self::TYPE_CONFIRM => '审查',
        ];
    }

    /**
     * 状态类型
     * Returns user statuses list
     * @return array|mixed
     */
    public static function statuses()
    {
        return [
            self::STATUS_UNASSIGNED => '未分配',
            self::STATUS_ASSIGNED => '进行中',
            self::STATUS_FINISHED => '已完成',
        ];
    }


    /**
     * 获取下一个待办任务
     * 首先，获取我的任务中未完成的任务，如果有，则从这个任务开始。如果没有，则从所有任务中分配一个新任务。
     * $type 任务类型
     */
    public static function getNextTodoTask($type)
    {
        // 获取用户自己未完成任务
        $unFinishedTask = TptkErrorCharTask::find()->where([
            'user_id' => Yii::$app->user->id,
            'task_type' => $type,
            'status' => SELF::STATUS_ASSIGNED])
            ->one();

        if (!$unFinishedTask) {
            // 获取任务池中未分配的任务
            $unFinishedTask = TptkErrorCharTask::find()->orderBy('id ASC')->where([
                'task_type' => $type,
                'status' => SELF::STATUS_UNASSIGNED])
                ->one();

            if (!$unFinishedTask) {
                return null;
            }

            $unFinishedTask->user_id = Yii::$app->user->id;
            $unFinishedTask->status = SELF::STATUS_ASSIGNED;
            $unFinishedTask->save();
        }

        return $unFinishedTask;
    }

    public function  getTptkErrorChar()
    {
        return $this->hasOne(TptkErrorChar::className(), ['id' => 'tripitaka_error_char_id']);
    }

    public function  getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}


