<?php

namespace backend\models;

use Yii;
use common\models\Profile;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $super_user
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $newPassword;
    public $validatePassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(),['user_id'=>'id']);
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['super_user'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],

            ['newPassword', 'string', 'min' => 6],
            ['validatePassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>"รหัสผ่านไม่ตรง" ],
            ['newPassword','validatePass'],
        ];
    }

    public function validatePass()
    {
        if(isset($this->newPassword)){
            if(empty($this->validatePassword)){
                $this->addError('validatePassword','กรุณายืนยันรหัสผ่าน');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'ชื่อผู้ใช้',
            'auth_key' => 'Auth Key',
            'password_hash' => 'รหัสผ่าน',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'อีเมล',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'super_user' => 'สิทธิ์การเข้าใช้งาน',
            'newPassword'=>'รหัสผ่านใหม่',
            'validatePassword'=>'ยืนยันรหัสผ่าน',
        ];
    }
}
