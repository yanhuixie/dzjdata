<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TptkPage;

/**
 * TptkPageSearch represents the model behind the search form of `frontend\models\TptkPage`.
 */
class TptkPageSearch extends TptkPage
{
    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'page_source', 'if_match', 'page_type', 'user_id', 'status', 'created_at', 'assigned_at', 'completed_at'], 'integer'],
            [['page_code', 'image_path', 'txt', 'frame_cut', 'line_cut', 'char_cut', 'remark', 'user_name'], 'safe'],
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
    public function searchYBQLJX($params)
    {
        $query = TptkPage::find();

        // add conditions that should always apply here
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]]
        ]);

        // 添加额外的类属性
        $addSortAttributes = [
            'user_name' => 'user.username'
        ];

        foreach ($addSortAttributes as $key => $addSortAttribute) {
            $dataProvider->sort->attributes[$key] = [
                'asc' => [$addSortAttribute => SORT_ASC],
                'desc' => [$addSortAttribute => SORT_DESC],
                'label' => $this->getAttributeLabel($addSortAttribute),
            ];
        }


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'if_match' => $this->if_match,
            'page_type' => $this->page_type,
            'user_id' => $this->user_id,
            'tptk_page.status' => $this->status,
            'created_at' => $this->created_at,
            'assigned_at' => $this->assigned_at,
            'completed_at' => $this->completed_at,
        ]);

        if (empty($this->page_source)) {
            $query->andFilterWhere(['<=', 'page_source', TptkPage::SOURCE_JX]);
        } else {
            $query->andFilterWhere(['page_source' => $this->page_source,]);
        }

        $query->andFilterWhere(['ilike', 'page_code', $this->page_code])
            ->andFilterWhere(['ilike', 'image_path', $this->image_path])
            ->andFilterWhere(['ilike', 'txt', $this->txt])
            ->andFilterWhere(['ilike', 'frame_cut', $this->frame_cut])
            ->andFilterWhere(['ilike', 'line_cut', $this->line_cut])
            ->andFilterWhere(['ilike', 'char_cut', $this->char_cut])
            ->andFilterWhere(['ilike', 'remark', $this->remark]);

        $query->andFilterWhere(['like', 'user.username', $this->user_name]);

        return $dataProvider;
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
        $query = TptkPage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_ASC]]
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
            'page_source' => $this->page_source,
            'if_match' => $this->if_match,
            'page_type' => $this->page_type,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'assigned_at' => $this->assigned_at,
            'completed_at' => $this->completed_at,
        ]);

        $query->andFilterWhere(['ilike', 'page_code', $this->page_code])
            ->andFilterWhere(['ilike', 'image_path', $this->image_path])
            ->andFilterWhere(['ilike', 'txt', $this->txt])
            ->andFilterWhere(['ilike', 'frame_cut', $this->frame_cut])
            ->andFilterWhere(['ilike', 'line_cut', $this->line_cut])
            ->andFilterWhere(['ilike', 'char_cut', $this->char_cut])
            ->andFilterWhere(['ilike', 'remark', $this->remark]);

        return $dataProvider;
    }
}
