<?php

namespace frontend\models;

use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class Utils
{
    /**
     * ContactForm is the model behind the contact form.
     */
    public static function hasRole($role)
    {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        return array_key_exists($role, $roles);
    }

    public static function hasErrorCharConfirmRight($id)
    {
        $roles = Yii::$app->authManager->getRolesByUser($id);
        return array_key_exists('阙疑文字审查', $roles);
    }

    public static function hasThouCharCheckRight($id)
    {
        $roles = Yii::$app->authManager->getRolesByUser($id);
        return array_key_exists('千字文补录检查', $roles);
    }

    public static function hasManageRight($id)
    {
        $roles = Yii::$app->authManager->getRolesByUser($id);
        return array_key_exists('业务管理员', $roles);
    }

}
