<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TptkErrorCharTask;

/**
 * TptkErrorCharTaskSearch represents the model behind the search form of `frontend\models\TptkErrorCharTask`.
 */
class TptkErrorCharTaskSearch extends TptkErrorCharTask
{
    public $tptk_page_code;
    public $tptk_line_num;
    public $tptk_line_txt;
    public $tptk_check_txt;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tptk_error_char_id', 'user_id', 'task_type', 'status', 'created_at', 'assigned_at', 'completed_at'], 'integer'],
            [['tptk_page_code', 'tptk_line_num', 'tptk_line_txt', 'tptk_check_txt'], 'safe']
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
        $query = TptkErrorCharTask::find();
        $query->joinWith(['user']);
        $query->joinWith(['tptkErrorChar']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // 添加额外的类属性
        $addSortAttributes = ['tptk_page_code', 'tptk_line_num', 'tptk_line_txt', 'tptk_check_txt'];
        foreach ($addSortAttributes as $addSortAttribute) {
            $dataProvider->sort->attributes[$addSortAttribute] = [
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
            'tptk_error_char_id' => $this->tptk_error_char_id,
            'user_id' => $this->user_id,
            'task_type' => $this->task_type,
            'tptk_error_char_task.status' => $this->status,
            'created_at' => $this->created_at,
            'assigned_at' => $this->assigned_at,
            'completed_at' => $this->completed_at,
        ]);

        $query->andFilterWhere(['tptk_error_char.line_num' => $this->tptk_line_num]);
        $query->andFilterWhere(['like', 'tptk_error_char.page_code', $this->tptk_page_code]);
        $query->andFilterWhere(['like', 'tptk_error_char.line_txt', $this->tptk_line_txt]);
        $query->andFilterWhere(['like', 'tptk_error_char.check_txt', $this->tptk_check_txt]);

        return $dataProvider;
    }
}