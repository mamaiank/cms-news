<?php

namespace common\models;

use Yii;
use common\models\Posts;

/**
 * This is the model class for table "wp_post_views".
 *
 * @property string $id
 * @property integer $type
 * @property string $period
 * @property string $count
 */
class PostViews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wp_post_views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'period', 'count'], 'required'],
            [['id', 'type', 'count'], 'integer'],
            [['period'], 'string', 'max' => 8],
            [['id', 'period'], 'unique', 'targetAttribute' => ['id', 'period'], 'message' => 'The combination of ID and Period has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'period' => 'Period',
            'count' => 'Count',
        ];
    }

    public function getNews()
    {
        return $this->hasMany(Posts::className(), ['ID' => 'id']);
    }
}
