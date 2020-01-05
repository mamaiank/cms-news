<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "magazine_index".
 *
 * @property string $ID
 * @property string $post_date
 * @property string $post_content
 * @property string $post_title
 * @property string $post_pic
 * @property string $object_id
 * @property string $term_taxonomy_id
 * @property string $name
 * @property string $term_id
 */
class MagazineIndex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'magazine_index';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'object_id', 'term_taxonomy_id', 'term_id'], 'integer'],
            [['post_date'], 'safe'],
            [['post_content', 'post_title'], 'string'],
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
            'ID' => 'ID',
            'post_date' => 'Post Date',
            'post_content' => 'Post Content',
            'post_title' => 'Post Title',
            'post_pic' => 'Post Pic',
            'object_id' => 'Object ID',
            'term_taxonomy_id' => 'Term Taxonomy ID',
            'name' => 'Name',
            'term_id' => 'Term ID',
        ];
    }
}
