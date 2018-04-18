<?php

namespace common\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "user_audit_log".
 *
 * @property integer $id
 * @property string $op_time
 * @property integer $op_user
 * @property string $from_ip
 * @property string $application
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $get_parms
 * @property string $post_parms
 */
class UserAuditLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_audit_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['op_time', 'controller', 'action'], 'required'],
            [['op_time'], 'safe'],
            [['op_user'], 'integer'],
            [['get_parms', 'post_parms'], 'string'],
            [['from_ip'], 'string', 'max' => 45],
            [['application', 'module', 'controller', 'action'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'op_time' => Yii::t('common', 'Op Time'),
            'op_user' => Yii::t('common', 'Op User'),
            'from_ip' => Yii::t('common', 'From Ip'),
            'application' => Yii::t('common', 'Application'),
            'module' => Yii::t('common', 'Module'),
            'controller' => Yii::t('common', 'Controller'),
            'action' => Yii::t('common', 'Action'),
            'get_parms' => Yii::t('common', 'Get Parms'),
            'post_parms' => Yii::t('common', 'Post Parms'),
        ];
    }
    
    /**
     * 
     * @param string $app
     * @param string $mod
     * @param string $ctl
     * @param string $act
     * @param integer $usrId
     * @param string $ip
     * @param string $getpArr
     * @param string $postpArr
     */
    public static function saveLog($app, $mod, $ctl, $act, $usrId, $ip, $getpArr, $postpArr){
    	if(isset($postpArr['LoginForm']) && isset($postpArr['LoginForm']['password'])){
    		$postpArr['LoginForm']['password'] = "*";
    	}
    	$model = new UserAuditLog;
    	$model->application = $app;
    	$model->module = $mod;
    	$model->controller = $ctl;
    	$model->action = $act;
    	$model->op_user = $usrId;
    	$model->from_ip = $ip;
    	$model->get_parms = \yii\helpers\Json::encode($getpArr); 
    	$model->post_parms = \yii\helpers\Json::encode($postpArr);
    	$model->op_time = new Expression('NOW()');
    	$model->save();
    }
}
