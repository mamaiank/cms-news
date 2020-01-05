<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hot_news_index".
 *
 * @property string $ID
 * @property string $post_date
 * @property string $post_content
 * @property string $post_title
 * @property string $post_pic
 * @property integer $type
 * @property string $period
 * @property string $count
 */
class HotNewsIndex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hot_news_index';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'type', 'count'], 'integer'],
            [['post_date'], 'safe'],
            [['post_content', 'post_title'], 'string'],
            [['type', 'period', 'count'], 'required'],
            [['post_pic'], 'string', 'max' => 255],
            [['period'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'post_date' => 'Post Date',
            'post_content' => 'Post Content',
            'post_title' => 'Post Title',
            'post_pic' => 'Post Pic',
            'type' => 'Type',
            'period' => 'Period',
            'count' => 'Count',
        ];
    }
}
