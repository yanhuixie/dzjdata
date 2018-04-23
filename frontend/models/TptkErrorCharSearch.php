<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TptkErrorChar;

/**
 * TptkErrorCharSearch represents the model behind the search form of `frontend\models\TptkErrorChar`.
 */
class TptkErrorCharSearch extends TptkErrorChar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'line', 'status'], 'integer'],
            [['page', 'image_path', 'line_txt', 'error_char', 'check_txt', 'confirm_txt', 'remark'], 'safe'],
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
        $query = TptkErrorChar::find();

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
            'line' => $this->line,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['ilike', 'page', $this->page])
            ->andFilterWhere(['ilike', 'image_path', $this->image_path])
            ->andFilterWhere(['ilike', 'line_txt', $this->line_txt])
            ->andFilterWhere(['ilike', 'error_char', $this->error_char])
            ->andFilterWhere(['ilike', 'check_txt', $this->check_txt])
            ->andFilterWhere(['ilike', 'confirm_txt', $this->confirm_txt])
            ->andFilterWhere(['ilike', 'remark', $this->remark]);

        return $dataProvider;
    }
}
