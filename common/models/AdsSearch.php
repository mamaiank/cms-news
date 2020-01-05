<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ads;

/**
 * AdsSearch represents the model behind the search form about `common\models\Ads`.
 */
class AdsSearch extends Ads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ads_name', 'ads_detail', 'start_date', 'end_date', 'ads_pic_file', 'ads_click', 'ads_link', 'create_date', 'update_date', 'active','level'], 'safe'],
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
        $query = Ads::find();

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

        $query->andFilterWhere(['like', 'ads_name', $this->ads_name])
            ->andFilterWhere(['like', 'ads_detail', $this->ads_detail])
            ->andFilterWhere(['like', 'ads_pic_file', $this->ads_pic_file])
            ->andFilterWhere(['like', 'ads_click', $this->ads_click])
            ->andFilterWhere(['like', 'ads_link', $this->ads_link])
            ->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
