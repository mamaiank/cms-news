<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property integer $id
 * @property string $bank_name
 * @property string $bank_link
 * @property string $bank_pic_file
 * @property string $create_date
 * @property string $update_date
 * @property boolean $active
 */
class Bank extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name'], 'required'],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
            [['create_date', 'update_date'], 'safe'],
            [['sort_order'], 'integer'],
            [['bank_name', 'bank_link', 'bank_pic_file','active'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสธนาคาร',
            'bank_name' => 'ชื่อธนาคาร',
            'bank_link' => 'ลิงค์',
            'bank_pic_file' => 'รูปภาพ',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
        ];
    }
}
