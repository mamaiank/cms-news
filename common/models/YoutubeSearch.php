<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Youtube;

/**
 * YoutubeSearch represents the model behind the search form about `common\models\Youtube`.
 */
class YoutubeSearch extends Youtube
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['youtube_name', 'youtube_detail', 'youtube_link', 'create_date', 'update_date'], 'safe'],
            [['active'], 'boolean'],
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
        $query = Youtube::find();

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
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'youtube_name', $this->youtube_name])
            ->andFilterWhere(['like', 'youtube_detail', $this->youtube_detail])
            ->andFilterWhere(['like', 'youtube_link', $this->youtube_link]);

        return $dataProvider;
    }
}
