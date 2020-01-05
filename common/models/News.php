<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "news".
 *
 * @property integer $id_news
 * @property string $news_title
 * @property string $news_detail
 * @property string $news_type_tag
 * @property string $news_pic
 * @property string $create_date
 * @property string $update_date
 * @property boolean $active
 */
class News extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_title', 'news_detail','news_type_tag','news_short_title'], 'required'],
            [['news_detail', 'news_type_tag','news_short_title'], 'string'],
            [['create_date', 'update_date','news_click'], 'safe'],
            [['active'], 'boolean'],
            [['news_title', 'news_pic'], 'string', 'max' => 255],
            [['news_title'], 'unique'],
            [['file'], 'file', 'extensions' => 'jpg, png, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสข่าว',
            'news_title' => 'หัวข้อ',
            'news_short_title' => 'รายละเอียดย่อ',
            'news_detail' => 'เนื้อหา',
            'news_type_tag' => 'แท็ก',
            'news_pic' => 'รูปภาพ',
            'create_date' => 'วันที่สร้าง',
            'update_date' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'file' => 'รูปภาพ',
        ];
    }

    public function search($params)
    {
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'active' => $this->active,
            'news_click' => $this->news_click,
        ]);

        $query->andFilterWhere(['like', 'news_title', $this->news_title])
            ->andFilterWhere(['like', 'news_detail', $this->news_detail])
            ->andFilterWhere(['like', 'news_type_tag', $this->news_type_tag])
            ->andFilterWhere(['like', 'news_pic', $this->news_pic]);

        return $dataProvider;
    }

    public function getCategotyNews($array){
        if($array){
            $data = '';
            $split = explode(",", $array);
            $i = 1;
            foreach ($split as $key => $value) {
                $model = CategoryNews::findOne($value);
                $data .= $i.'. '.$model->cate_news_name.'<br>';
                $i++;
            }
            return $data;
        } else {
            return 'ไม่มีแท๊ก';
        }
    }
}
