<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $create_date
 * @property string $update_date
 * @property string $active
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_date'], 'safe'],
            [['active'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'link' => 'ลิงค์',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
        ];
    }
}
