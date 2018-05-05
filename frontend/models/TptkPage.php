<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tptk_page".
 *
 * @property string $id
 * @property int $page_source
 * @property string $page_code
 * @property string $image_path
 * @property string $txt
 * @property int $if_match
 * @property int $page_type
 * @property string $frame_cut
 * @property string $line_cut
 * @property string $char_cut
 * @property string $remark
 * @property int $user_id
 * @property int $status
 * @property int $created_at
 * @property int $assigned_at
 * @property int $completed_at
 */
class TptkPage extends \yii\db\ActiveRecord
{

    // 数据来源
    const SOURCE_YB = 1;    // 来源于永乐北藏，91册文本标注数据
    const SOURCE_QL = 2;    // 来源于乾隆藏，40册文本标注数据
    const SOURCE_JX = 3;    // 来源于CBETA嘉兴藏，200多部经的文本标注数据
    const SOURCE_1000GL = 4;    // 来源于高丽藏，1000张图的文本和图片标注数据
    const SOURCE_1000MulTptk = 5;   // 来源于多部藏经，1000张图的文本和图片标注数据
    const SOURCE_1000LinePosition = 6;  // 来源于多部藏经，1000张图的行定位标注数据
    const SOURCE_500MulTptk = 7;    // 来源于多部藏经，500张图的图文标注数据
    const SOURCE_60HuaYan = 8;  // 来源于六十华严

    // 图片类型：含特殊字符、含夹注小字、不含文本、标准图片、其它类型
    const TYPE_SPECIAL_CHAR = 1;
    const TYPE_SMALL_NOTES = 2;
    const TYPE_NO_TEXT = 3;
    const TYPE_STANDARD_PIC = 4;
    const TYPE_OTHER = 5;

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
        return 'tptk_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_source', 'if_match', 'page_type', 'user_id', 'status', 'created_at', 'assigned_at', 'completed_at'], 'default', 'value' => null],
            [['page_source', 'if_match', 'page_type', 'user_id', 'status', 'created_at', 'assigned_at', 'completed_at'], 'integer'],
            [['txt', 'frame_cut', 'line_cut', 'char_cut'], 'string'],
            [['created_at'], 'required'],
            [['page_code'], 'string', 'max' => 16],
            [['image_path'], 'string', 'max' => 64],
            [['remark'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'page_source' => Yii::t('frontend', 'Page Source'),
            'page_code' => Yii::t('frontend', 'Page Code'),
            'image_path' => Yii::t('frontend', 'Image Path'),
            'txt' => Yii::t('frontend', 'Txt'),
            'if_match' => Yii::t('frontend', 'If Match'),
            'page_type' => Yii::t('frontend', 'Page Type'),
            'frame_cut' => Yii::t('frontend', 'Frame Cut'),
            'line_cut' => Yii::t('frontend', 'Line Cut'),
            'char_cut' => Yii::t('frontend', 'Char Cut'),
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
     * 图片类型
     * Returns user statuses list
     * @return array|mixed
     */
    public static function pageTypes()
    {
        return [
            self::TYPE_STANDARD_PIC => '标准图片',
            self::TYPE_SPECIAL_CHAR => '含特殊文字',
            self::TYPE_SMALL_NOTES => '含夹注小字',
            self::TYPE_NO_TEXT => '不含文字',
            self::TYPE_OTHER => '其它类型',
        ];
    }

    /**
     * 图片来源
     * Returns user statuses list
     * @return array|mixed
     */
    public static function pageSources()
    {
        return [
            self::SOURCE_YB => '永乐北藏',
            self::SOURCE_QL => '乾隆大藏经',
            self::SOURCE_JX => '嘉兴藏',
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
        $unFinishedTask = TptkPage::find()->where([
            'user_id' => Yii::$app->user->id,
            'status' => SELF::STATUS_ASSIGNED])
            ->one();

        if (!$unFinishedTask) {
            // 获取任务池中未分配的任务
            $unFinishedTask = TptkPage::find()->orderBy('id ASC')->where([
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


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
