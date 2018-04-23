<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tptk_error_char".
 *
 * @property string $id
 * @property string $page
 * @property string $image_path
 * @property int $line
 * @property string $line_txt
 * @property string $error_char
 * @property string $check_txt
 * @property string $confirm_txt
 * @property int $status
 * @property string $remark
 */
class TptkErrorChar extends \yii\db\ActiveRecord
{

    public $imagePath;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tptk_error_char';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['line', 'status'], 'default', 'value' => null],
            [['line', 'status'], 'integer'],
            [['page', 'error_char'], 'string', 'max' => 16],
            [['image_path'], 'string', 'max' => 64],
            [['line_txt', 'check_txt', 'confirm_txt', 'remark'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => '页码',
            'image_path' => '图片路径',
            'line' => '行号',
            'line_txt' => '行文本',
            'error_char' => '阙疑文字',
            'check_txt' => '校对结果',
            'confirm_txt' => '审定结果',
            'status' => '状态',
            'remark' => '备注',
        ];
    }
}
