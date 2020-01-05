<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property integer $id
 * @property string $partner_name
 * @property string $partner_link
 * @property string $partner_pic
 * @property string $create_date
 * @property string $update_date
 * @property string $active
 */
class Partner extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_date'], 'safe'],
            [['sort_order'], 'integer'],
            [['partner_name'], 'required'],
            [['partner_name', 'partner_link', 'partner_pic', 'active'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_name' => 'ชื่อ',
            'partner_link' => 'ลิงค์',
            'partner_pic' => 'รูปภาพ',
            'file' => 'รูปภาพ',
            'create_date' => 'สร้างวันที่',
            'update_date' => 'แก้ไขวันที่',
            'active' => 'สถานะ',
        ];
    }
}
