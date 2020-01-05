<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $ID
 * @property string $customer_date
 * @property string $customer_title
 * @property string $customer_modified
 * @property string $customer_pic
 * @property string $create_by
 * @property string $update_by
 * @property string $active
 */
class Customer extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_date', 'customer_modified'], 'safe'],
            [['customer_title', 'active'], 'string'],
            [['customer_title'], 'required'],
            [['customer_pic'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'customer_date' => 'สร้างวันที่',
            'customer_title' => 'หัวข้อ',
            'customer_modified' => 'Customer Modified',
            'customer_pic' => 'รูปภาพ',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'file' => 'รูปภาพ',
            'active' => 'Active',
        ];
    }
}
