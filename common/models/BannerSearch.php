<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Banner;

/**
 * BannerSearch represents the model behind the search form about `common\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','level'], 'integer'],
            [['banner_name', 'banner_detail', 'start_date', 'end_date', 'banner_link', 'banner_pic_file', 'banner_pic_hover', 'create_date', 'update_date', 'active', 'hover_status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Banner::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [ 'defaultOrder' => [ 'sort_order' => SORT_ASC ] ] 
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'banner_name', $this->banner_name])
            ->andFilterWhere(['like', 'banner_detail', $this->banner_detail])
            ->andFilterWhere(['like', 'banner_link', $this->banner_link])
            ->andFilterWhere(['like', 'banner_pic_file', $this->banner_pic_file])
            ->andFilterWhere(['like', 'active', $this->active])
            ->andFilterWhere(['like', 'level', $this->level]);

        return $dataProvider;
    }
}
