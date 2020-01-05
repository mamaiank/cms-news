<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vw_tag".
 *
 * @property string $ID
 * @property integer $id_tag
 * @property string $name_tag
 */
class VwTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'id_tag'], 'integer'],
            [['name_tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'id_tag' => 'Id Tag',
            'name_tag' => 'Name Tag',
        ];
    }
}
