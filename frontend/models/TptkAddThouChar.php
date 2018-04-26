<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tptk_add_thou_char".
 *
 * @property string $id
 * @property string $page_code
 * @property int $block_num
 * @property int $line_num
 * @property string $add_txt
 * @property int $is_right
 * @property string $remark
 * @property int $user_id
 * @property int $status
 * @property int $created_at
 * @property int $assigned_at
 * @property int $completed_at
 */
class TptkAddThouChar extends \yii\db\ActiveRecord
{
    // 任务状态
    const STATUS_UNREADY = 0;
    const STATUS_UNASSIGNED = 1;
    const STATUS_ASSIGNED = 2;
    const STATUS_FINISHED = 3;

    public $imagePath; //图片路径

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tptk_add_thou_char';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_num', 'line_num', 'is_right', 'user_id', 'status', 'created_at', 'assigned_at', 'completed_at'], 'default', 'value' => null],
            [['block_num', 'line_num', 'is_right', 'user_id', 'status', 'created_at', 'assigned_at', 'completed_at'], 'integer'],
            [['created_at'], 'required'],
            [['page_code'], 'string', 'max' => 16],
            [['add_txt', 'remark'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'page_code' => Yii::t('frontend', 'Page Code'),
            'block_num' => Yii::t('frontend', 'Block Num'),
            'line_num' => Yii::t('frontend', 'Line Num'),
            'add_txt' => Yii::t('frontend', 'Add Txt'),
            'is_right' => Yii::t('frontend', 'Is Right'),
            'remark' => Yii::t('frontend', 'Remark'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'assigned_at' => Yii::t('frontend', 'Assigned At'),
            'completed_at' => Yii::t('frontend', 'Completed At'),
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
            self::STATUS_UNREADY => '未就绪',
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
    public static function getNextTodoTask()
    {
        // 获取用户自己未完成任务
        $unFinishedTask = TptkAddThouChar::find()->where([
            'user_id' => Yii::$app->user->id,
            'status' => SELF::STATUS_ASSIGNED])
            ->one();

        if (!$unFinishedTask) {
            // 获取任务池中未分配的任务
            $unFinishedTask = TptkAddThouChar::find()->orderBy('id ASC')->where([
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


    public function  getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
