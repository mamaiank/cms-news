<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ads".
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
 * @property string $active
 */
class Ads extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'create_date', 'update_date','level'], 'safe'],
            [['ads_name', 'ads_pic_file', 'ads_click', 'ads_link'], 'string', 'max' => 255],
            [['ads_detail','active'], 'string'],
            [['sort_order'], 'integer'],
            [['ads_name'], 'required'],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
            ['start_date','validateDates'],
        ];
    }

    public function validateDates()
    {
        if(strtotime($this->end_date) < strtotime($this->start_date)){
            $this->addError('start_date','วันที่สิ้นสุด ต้องไม่น้อยกว่า วันที่เริ่ม');
            $this->addError('end_date','วันที่สิ้นสุด ต้องไม่น้อยกว่า วันที่เริ่ม');
        }
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
            'active' => 'สถานะ',
            'file' => 'รูปภาพ',
            'level'=>'ตำแหน่ง'
        ];
    }
}
