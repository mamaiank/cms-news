<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag_relationship".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $tag_id
 * @property string $create_date
 * @property string $create_by
 * @property string $update_date
 * @property string $update_by
 * @property string $active
 */
class TagRelationship extends \yii\db\ActiveRecord
{
    public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_relationship';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['create_by', 'update_by', 'active'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
            'active' => 'Active',
        ];
    }

    public function getTag()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->select('name')->scalar();
    }
}
