<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username','firstname','lastname'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            [['username','firstname','lastname'], 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'ชื่อบัญชี',
            'password' => 'รหัสผ่าน',
            'email' => 'อีเมล',
            'firstname' => 'ชื่อ',
            'lastname' => 'นามสกุล',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $profile = new Profile;
        $profile->firstname = $this->firstname;
        $profile->lastname = $this->lastname;
        if($user->validate() && $profile->validate())
        {
            $profile->save();
            return $user->save() ? $user : null;    
        }
    }
}
