<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wp_terms".
 *
 * @property string $term_id
 * @property string $name
 * @property string $slug
 * @property string $term_group
 */
class Terms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wp_terms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['term_group'], 'integer'],
            [['sort_order'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'term_id' => 'Term ID',
            'name' => 'ชื่อหมวดหมู่',
            'slug' => 'Slug',
            'term_group' => 'Term Group',
        ];
    }
}
