<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Popup;

/**
 * PopupSearch represents the model behind the search form about `common\models\Popup`.
 */
class PopupSearch extends Popup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['popup_name', 'popup_detail', 'start_date', 'end_date', 'popup_link', 'popup_pic_file', 'create_date', 'update_date', 'active'], 'safe'],
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
        $query = Popup::find();

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
        ]);

        $query->andFilterWhere(['like', 'popup_name', $this->popup_name])
            ->andFilterWhere(['like', 'popup_detail', $this->popup_detail])
            ->andFilterWhere(['like', 'popup_link', $this->popup_link])
            ->andFilterWhere(['like', 'popup_pic_file', $this->popup_pic_file])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
