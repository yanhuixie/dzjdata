<?php
namespace frontend\modules\user\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use frontend\modules\user\Module;
use yii\base\Exception;
use yii\base\Model;
use Yii;
use yii\helpers\Url;
use common\models\UserProfile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    
    /**
     * 
     * @var string
     */
    public $verifyCode;
    
    /**
     * 
     * @var string
     */
    public $firstname;
    
    /**
     * 
     * @var int
     */
    public $gender;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'verifyCode', 'firstname', 'gender'], 'required'],
            ['username', 'unique',
                'targetClass'=>'\common\models\User',
                'message' => Yii::t('frontend', 'This username has already been taken.')
            ],
            [['username', 'firstname'], 'string', 'min' => 2, 'max' => 100],
            [['gender'], 'in', 'range' => [NULL, UserProfile::GENDER_FEMALE, UserProfile::GENDER_MALE]],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=> '\common\models\User',
                'message' => Yii::t('frontend', 'This email address has already been taken.')
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        		
        	['verifyCode', 'captcha', 'captchaAction'=>'/user/sign-in/captcha'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('frontend', 'Username'),
            'firstname' => Yii::t('common', 'Full Name'),
            'gender' => Yii::t('common', 'Gender'),
            'email'=>Yii::t('frontend', 'E-mail'),
            'password'=>Yii::t('frontend', 'Password'),
        	'verifyCode' => Yii::t('frontend', 'Verification Code')
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
        	return null;
        }

        $shouldBeActivated = $this->shouldBeActivated();
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        if(!$user->save()) {
            throw new Exception("User couldn't be  saved");
        };

//         $user->afterSignup(array_merge($profile->attributes, ['picture'=>$profile->picture])); 
        $user->afterSignup(['firstname'=>$this->firstname, 'gender'=>$this->gender]);

        if ($shouldBeActivated) {
            $token = UserToken::create(
                $user->id,
                UserToken::TYPE_ACTIVATION,
                Time::SECONDS_IN_A_DAY
            );
            
            Yii::$app->commandBus->handle(new SendEmailCommand([
                'subject' => Yii::t('frontend', 'Welcome to {name}, please activate your account', ['name'=>Yii::$app->name]),
                'view' => 'activation',
                'to' => $this->email,
                'params' => [
                	'user' => $user,
                    'url' => Url::to(['/user/sign-in/activation', 'token' => $token->token], true)
                ]
            ]));
        }
        
        return $user;
    }

    /**
     * @return bool
     */
    public function shouldBeActivated()
    {
        /** @var Module $userModule */
        $userModule = Yii::$app->getModule('user');
        if (!$userModule) {
            return false;
        } elseif ($userModule->shouldBeActivated) {
            return true;
        } else {
            return false;
        }
    }
}
