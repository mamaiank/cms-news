<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vw_posts".
 *
 * @property string $post_pic
 * @property string $post_title
 * @property string $post_content
 * @property string $ID
 * @property string $post_date
 * @property string $object_id
 * @property string $term_taxonomy_id
 * @property string $term_id
 * @property string $name
 * @property string $active
 */
class VwPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_title', 'post_content', 'active'], 'string'],
            [['ID', 'object_id', 'term_taxonomy_id', 'term_id'], 'integer'],
            [['post_date','post_pin'], 'safe'],
            [['post_pic'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_pic' => 'Post Pic',
            'post_title' => 'Post Title',
            'post_content' => 'Post Content',
            'ID' => 'ID',
            'post_date' => 'Post Date',
            'object_id' => 'Object ID',
            'term_taxonomy_id' => 'Term Taxonomy ID',
            'term_id' => 'Term ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
}