<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TptkAddThouChar;

/**
 * TptkAddThouCharSearch represents the model behind the search form of `frontend\models\TptkAddThouChar`.
 */
class TptkAddThouCharSearch extends TptkAddThouChar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'block_num', 'line_num', 'is_right', 'user_id', 'status', 'created_at', 'assigned_at', 'completed_at'], 'integer'],
            [['page_code', 'add_txt', 'remark'], 'safe'],
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
        $query = TptkAddThouChar::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]]
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
            'block_num' => $this->block_num,
            'line_num' => $this->line_num,
            'is_right' => $this->is_right,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'assigned_at' => $this->assigned_at,
            'completed_at' => $this->completed_at,
        ]);

        $query->andFilterWhere(['ilike', 'page_code', $this->page_code])
            ->andFilterWhere(['ilike', 'add_txt', $this->add_txt])
            ->andFilterWhere(['ilike', 'remark', $this->remark]);

        return $dataProvider;
    }
}
