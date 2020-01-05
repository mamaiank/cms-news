<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner_relationships".
 *
 * @property string $banner_id
 * @property string $term_taxonomy_id
 */
class BannerRelationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner_relationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner_id', 'term_taxonomy_id'], 'required'],
            [['banner_id', 'term_taxonomy_id'], 'integer'],
            [['term_type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'banner_id' => 'Banner ID',
            'term_taxonomy_id' => 'Term Taxonomy ID',
        ];
    }
}
