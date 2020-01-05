<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $banner_name
 * @property string $banner_detail
 * @property string $start_date
 * @property string $end_date
 * @property string $banner_link
 * @property string $banner_pic_file
 * @property string $create_date
 * @property string $update_date
 * @property string $active
 */
class Banner extends \yii\db\ActiveRecord
{
    public $file;
    public $vdo;
    public $hover_status2;
    public $banner_type2;
    public $banner_relate_detail;
    public $banner_relate_index;
    public $type;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'create_date', 'banner_relate_detail', 'banner_relate_index', 'update_date','level','banner_type','banner_type2','type'], 'safe'],
            [['banner_name', 'banner_pic_file','banner_pic_hover'], 'string', 'max' => 255],
            [['banner_name','banner_detail','level'], 'required'],
            [['banner_detail', 'banner_link', 'active','hover_status','hover_status2'], 'string'],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
            [['vdo'], 'file', 'extensions' => 'mp4'],
            [['sort_order'], 'integer'],
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
            'id' => 'รหัสแบนเบอร์',
            'banner_name' => 'ชื่อ',
            'banner_detail' => 'รายละเอียด',
            'start_date' => 'วันที่เริ่ม',
            'end_date' => 'วันที่สิ้นสุด',
            'banner_link' => 'ลิงค์',
            'banner_pic_file' => 'รูปภาพ',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'file' => 'รูปภาพ',
            'vdo' => 'วิดีโอ',
            'level' => 'ลำดับแบนเนอร์',
            'banner_type' => 'ประเภท',
            'banner_type2' => 'ประเภท',
            'banner_pic_hover'=>'รูปขยาย',
            'hover_status'=>'ใช้งานภาพขยาย',
            'hover_status2'=>'ใช้งานภาพขยาย',
            'banner_relate' => 'หมวดหมู่',
            'banner_relate_index' => 'หมวดหมู่ (สำหรับแสดงในหน้าหมวดหมู่)',
            'banner_relate_detail' => 'หมวดหมู่ (สำหรับแสดงในหน้าข่าว)',
            'type' => 'ประเภทรูปภาพ',
        ];
    }
}
