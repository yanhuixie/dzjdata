<?php
namespace common\components;

use Yii;
use yii\base\ActionFilter;
use common\models\UserAuditLog;


/**
 * 
 * @author yanhui
 *
 */
class UserAuditLogFilter extends ActionFilter
{

	/**
	 * @param \yii\base\Action $action
	 * @return bool
	 */
	public function  beforeAction($action)
	{
	    if(!env('USER_AUDIT_LOG')){
	        return parent::beforeAction($action);
	    }
	    
	    if(empty(Yii::$app->user->id)) return parent::beforeAction($action);
	    
		if(Yii::$app->id == 'frontend' && 
			$action->controller->id == 'site' && 
			$action->id == 'index' && 
			empty(Yii::$app->request->get()) &&
			empty(Yii::$app->request->post())){
			
			return parent::beforeAction($action);
		}
		
		UserAuditLog::saveLog(
				Yii::$app->id, 
				Yii::$app->controller->module ? Yii::$app->controller->module->id : '', 
				$action->controller->id, 
				$action->id, 
				Yii::$app->user->id, 
				Yii::$app->request->userIP, 
				Yii::$app->request->get(), 
				Yii::$app->request->post()
		);
		return parent::beforeAction($action);
	}



}