<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "youtube".
 *
 * @property integer $id
 * @property string $youtube_name
 * @property string $youtube_detail
 * @property string $youtube_link
 * @property string $create_date
 * @property string $update_date
 * @property boolean $active
 */
class Youtube extends \yii\db\ActiveRecord
{
    public $linkY;
    public $linkF;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'youtube';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['youtube_name','link_type'], 'required'],
            [['create_date', 'update_date', 'link_type'], 'safe'],
            [['sort_order'], 'integer'],
            [['youtube_detail', 'youtube_link', 'active','linkF','linkY'] , 'string'],
            [['youtube_name'], 'string', 'max' => 255],
            ['linkF','validateFacebook'],
            ['linkY','validateYoutube'],
        ];
    }

    public function validateFacebook()
    {
        if(!strpos($this->linkF, 'iframe src="https://www.facebook.com') !== false) {
            $this->addError('linkF','รูปแบบลิงค์ไม่ถูกต้อง');
        }
    }

    public function validateYoutube()
    {
        if(!strpos($this->linkY, 'www.youtube.com/watch?v=') !== false) {
            $this->addError('linkY','รูปแบบลิงค์ไม่ถูกต้อง');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสยูทูป',
            'youtube_name' => 'ชื่อ',
            'youtube_detail' => 'รายละเอียด',
            'youtube_link' => 'ลิงค์',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'link_type'=>'ประเภทลิงค์',
            'linkY'=>'ลิงค์ยูทูป',
            'linkF'=>'ลิงค์เฟสบุ๊ค',
        ];
    }
}
