<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tptk_error_char_task".
 *
 * @property string $id
 * @property string $tptk_error_char_id
 * @property int $user_id
 * @property int $task_type
 * @property int $status
 * @property int $created_at
 * @property int $assigned_at
 * @property int $completed_at
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
            [['user_id', 'task_type', 'status', 'created_at', 'assigned_at', 'completed_at'], 'default', 'value' => null],
            [['user_id', 'task_type', 'status', 'created_at', 'assigned_at', 'completed_at'], 'integer'],
            [['created_at'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'tptk_error_char_id' => Yii::t('frontend', 'Tptk Error Char ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'task_type' => Yii::t('frontend', 'Task Type'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'assigned_at' => Yii::t('frontend', 'Assigned At'),
            'completed_at' => Yii::t('frontend', 'Completed At'),
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
            $unFinishedTask->assigned_at = time();
            $unFinishedTask->status = SELF::STATUS_ASSIGNED;
            $unFinishedTask->save();
        }

        return $unFinishedTask;
    }

    public function  getTptkErrorChar()
    {
        return $this->hasOne(TptkErrorChar::className(), ['id' => 'tptk_error_char_id']);
    }

    public function  getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
