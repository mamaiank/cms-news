<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "popup".
 *
 * @property integer $id
 * @property string $popup_name
 * @property string $popup_detail
 * @property string $start_date
 * @property string $end_date
 * @property string $popup_link
 * @property string $popup_pic_file
 * @property string $create_date
 * @property string $update_date
 * @property string $active
 */
class Popup extends \yii\db\ActiveRecord
{
    public $file;
    public $vdo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'popup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'create_date', 'update_date','popup_type'], 'safe'],
            [['popup_detail','active'], 'string'],
            [['sort_order'], 'integer'],
            [['popup_name', 'popup_link', 'popup_pic_file'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
            ['start_date','validateDates'],
            [['vdo'], 'file', 'extensions' => 'mp4'],
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
            'id' => 'รหัสป๊อปอัพ',
            'popup_name' => 'ชื่อ',
            'popup_detail' => 'รายละเอียด',
            'start_date' => 'วันที่เริ่ม',
            'end_date' => 'วันที่สิ้นสุด',
            'popup_link' => 'ลิงค์',
            'popup_pic_file' => 'รูปภาพ',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'file' => 'รูปภาพ',
            'popup_type'=>'ประเภทไฟล์',
        ];
    }
}
