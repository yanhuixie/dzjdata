<?php
namespace common\base;

use Yii;
use \common\models\UserProfile;

/**
 *
 * @author yanhuixie
 *
 */
class BizMeta{

	/**
	 *
	 * @return string[]
	 */
	public static function genders(){
		return [
	        UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
	        UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
	    ];
	}

	/**
	 * 暂未翻译
	 * @return string[]
	 */
	public static function yesno(){
		return [
    		'0' => '否',
    		'1' => '是',
    	];
	}

	/**
	 *
	 * @return string[]
	 */
	public static function createOrUpdate(){
		return [
    		'1' => '新建',
    		'2' => '覆盖',
    	];
	}

}