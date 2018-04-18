<?php
namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;

/**
 * 
 * @author yanhui
 *
 */
class CmnHelper{
	
	/**
	 * 
	 * @param string $dt
	 * @return string
	 */
	public static function trimDateTime($dt){
		if(strlen($dt) > 16){
			return substr($dt, 0, 16);
		}
		return $dt;
	}
	
	/**
	 * 
	 * @param string $dt
	 * @return string
	 */
	public static function padDateTime($dt){
		if(strlen($dt) == 16){
			return $dt.':00';
		}
		return $dt;
	}
	
	/**
	 * 验证手机号是否正确
	 * @author honfei
	 * @param number $mobile
	 */
	public static function isChinaMobile($mobile) {
		if (!is_numeric($mobile)) {
			return false;
		}
		return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
	}
	
	/**
	 * 
	 * @var EmailValidator
	 */
	public static $emailValidator = null;
	
	/**
	 * 
	 * @param string $txt
	 * @return boolean
	 */
	public static function isEmail($txt){
		if(self::$emailValidator == null){
			self::$emailValidator = new EmailValidator;
		}
		return self::$emailValidator->validate($txt);
	}
	
	/**
	 * 
	 * @param string $fromUrl
	 * @param string $toFile
	 * @return boolean
	 */
	public static function copyRemote($fromUrl, $toFile) {
		//Yii::trace('copyRemote:'."$fromUrl |-> $toFile", 'devtrace');
		try {
			$myFile = fopen($toFile,"w");
			$client = new \GuzzleHttp\Client();
			$client->get($fromUrl, ['save_to'=>$myFile]);
			return true;
		} catch (\Exception $e) {
			// Log the error or something
			Yii::warning($e->getMessage());
			return false;
		}
	}
	
	/**
	 * 自动判断浏览器差异，格式化下载文件名字符串
	 * @param string $fname
	 * @return string
	 */
	public static function fmtDownloadName($fname){
		$agent = strtoupper(Yii::$app->request->userAgent);
		if(preg_match('/MSIE/', $agent)){
			$fname = str_replace('+', '%20', urlencode($fname));
		}
		return $fname;
	}
	
	/**
	 * 
	 * @param array $array
	 * @return array
	 */
	public static function findDuplicated($array) { 
	    // 获取去掉重复数据的数组 
	    $unique_arr = array_unique ( $array ); 
	    // 获取重复数据的数组 
	    $repeat_arr = array_diff_assoc ( $array, $unique_arr ); 
	    return $repeat_arr; 
	} 
	
	/**
	 * 
	 * @param Model $model
	 * @param string $attr
	 * @param string $tblPrefix
	 * @param string $altAttr
	 * @return string
	 */
	public static function handleNumCond($model, $attr, $tblPrefix, $altAttr=null){
		$cnd = "";
		if(!isset($model->$attr) || $model->$attr === null || $model->$attr === ""){
			return $cnd;
		}
		if(is_numeric($model->$attr)){
			if($altAttr){
				$cnd = sprintf(" and %s = %s ", $altAttr, $model->$attr);
			}
			else{
				$cnd = sprintf(" and %s.%s = %s ", $tblPrefix, $attr, $model->$attr);
			}
			return $cnd;
		}
		if(preg_match('/^\>\d+$/', $model->$attr)){
			if($altAttr){
				$cnd = sprintf(" and %s %s ", $altAttr, $model->$attr);
			}
			else{
				$cnd = sprintf(" and %s.%s %s ", $tblPrefix, $attr, $model->$attr);
			}
			return $cnd;
		}
		if(preg_match('/^\>\=\d+$/', $model->$attr)){
			if($altAttr){
				$cnd = sprintf(" and %s %s ", $altAttr, $model->$attr);
			}
			else{
				$cnd = sprintf(" and %s.%s %s ", $tblPrefix, $attr, $model->$attr);
			}
			return $cnd;
		}
		if(preg_match('/^\<\d+$/', $model->$attr)){
			if($altAttr){
				$cnd = sprintf(" and %s %s ", $altAttr, $model->$attr);
			}
			else{
				$cnd = sprintf(" and %s.%s %s ", $tblPrefix, $attr, $model->$attr);
			}
			return $cnd;
		}
		if(preg_match('/^\<\=\d+$/', $model->$attr)){
			if($altAttr){
				$cnd = sprintf(" and %s %s ", $altAttr, $model->$attr);
			}
			else{
				$cnd = sprintf(" and %s.%s %s ", $tblPrefix, $attr, $model->$attr);
			}
			return $cnd;
		}
		if(preg_match('/^\d+\-\d+$/', $model->$attr)){
			$nums = [];
			preg_match_all('/\d+/', $model->$attr, $nums);
			if($altAttr){
				$cnd = sprintf(" and %s between %s and %s ", $altAttr, $nums[0][0], $nums[0][1]);
			}
			else{
				$cnd = sprintf(" and %s.%s between %s and %s ", $tblPrefix, $attr, $nums[0][0], $nums[0][1]);
			}
			return $cnd;
		}
		
		return $cnd;
	}
	
	/**
	 * 
	 * @param array $errors
	 * @param string $linesep
	 * @return string
	 */
	public static function combineValidationErrors($errors, $linesep="\n"){
		if(empty($errors)){
			return '';
		}
		$msg = "";
		foreach ($errors as $attr => $err){
			$cmb = implode('; ', $err);
			$msg .= sprintf("[%s]%s%s", $attr, $cmb, $linesep);
		}
		return $msg;
	}
	
	/**
	 * 
	 * @param string $text
	 * @param int $length
	 * @return string
	 */
	public static function subtext($text, $length){
        if(mb_strlen($text, 'utf8') > $length) 
            return mb_substr($text, 0, $length, 'utf8').'...';
        return $text;
    }
}