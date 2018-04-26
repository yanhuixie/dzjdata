<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tptk_error_char".
 *
 * @property string $id
 * @property string $page_code
 * @property string $image_path
 * @property int $line_num
 * @property string $error_char
 * @property string $line_txt
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
            [['line_num', 'if_doubt'], 'default', 'value' => null],
            [['line_num', 'if_doubt'], 'integer'],
            [['page_code'], 'string', 'max' => 16],
            [['image_path'], 'string', 'max' => 64],
            [['error_char'], 'string', 'max' => 32],
            [['line_txt', 'check_txt', 'confirm_txt', 'remark'], 'string', 'max' => 128],
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
            'image_path' => Yii::t('frontend', 'Image Path'),
            'line_num' => Yii::t('frontend', 'Line Num'),
            'error_char' => Yii::t('frontend', 'Error Char'),
            'line_txt' => Yii::t('frontend', 'Line Txt'),
            'check_txt' => Yii::t('frontend', 'Check Txt'),
            'confirm_txt' => Yii::t('frontend', 'Confirm Txt'),
            'if_doubt' => Yii::t('frontend', 'If Doubt'),
            'remark' => Yii::t('frontend', 'Remark'),
        ];
    }


}


