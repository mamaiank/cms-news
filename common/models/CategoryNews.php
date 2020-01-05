<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_news".
 *
 * @property integer $id
 * @property string $cate_news_name
 * @property string $create_date
 * @property string $update_date
 * @property boolean $active
 */
class CategoryNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_news_name'], 'required'],
            [['create_date', 'update_date'], 'safe'],
            [['active'], 'boolean'],
            [['cate_news_name'], 'string', 'max' => 255],
            [['cate_news_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'หมวดหมู่ข่าว',
            'cate_news_name' => 'ชื่อหมวดหมู่',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
        ];
    }
    
}
