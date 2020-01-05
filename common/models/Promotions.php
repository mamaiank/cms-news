<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotions".
 *
 * @property integer $id
 * @property string $ads_name
 * @property string $ads_detail
 * @property string $start_date
 * @property string $end_date
 * @property string $ads_pic_file
 * @property string $ads_click
 * @property string $ads_link
 * @property string $create_date
 * @property string $update_date
 * @property string $level
 * @property string $active
 * @property integer $sort_order
 * @property string $create_by
 * @property string $update_by
 */
class Promotions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ads_detail', 'active'], 'string'],
            [['start_date', 'end_date', 'create_date', 'update_date', 'ads_type'], 'safe'],
            [['sort_order'], 'integer'],
            [['ads_name', 'ads_pic_file', 'ads_click', 'ads_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสโฆษณา',
            'ads_name' => 'ชื่อ',
            'ads_detail' => 'รายละเอียด',
            'start_date' => 'วันที่เริ่ม',
            'end_date' => 'วันที่สิ้นสุด',
            'ads_pic_file' => 'รูปภาพ',
            'ads_click' => 'จำนวนคลิก',
            'ads_link' => 'ลิงค์',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'level' => 'Level',
            'active' => 'สถานะ',
            'sort_order' => 'Sort Order',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'ads_type' => 'ประเภทลิงค์',
        ];
    }
}
