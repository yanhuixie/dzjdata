<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TptkErrorCharTask;

/**
 * TptkErrorCharTaskSearch represents the model behind the search form of `frontend\models\TptkErrorCharTask`.
 */
class TptkErrorCharTaskSearch extends TptkErrorCharTask
{
    public $tptk_page;
    public $tptk_line;
    public $tptk_check_txt;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tripitaka_error_char_id', 'user_id', 'task_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['tptk_page', 'tptk_line', 'tptk_check_txt'], 'safe']
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tptk_page' => '阙疑页码',
            'tptk_line' => '行文本',
            'tptk_check_txt' => '校对结果',
        ];
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
//        $query->select("user.*, tptk_error_char.*, tptk_error_char_task.*");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // 添加额外的类属性
        $addSortAttributes = ['tptk_page', 'tptk_line', 'tptk_check_txt'];
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
            'tripitaka_error_char_id' => $this->tripitaka_error_char_id,
            'user_id' => $this->user_id,
            'task_type' => $this->task_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['tptk_error_char.page' => $this->tptk_page]);
//        $query->andFilterWhere(['tptk_line' => $this->tptk_line]);
//        $query->andFilterWhere(['like', 'tptk_check_txt', $this->tptk_check_txt]);

        return $dataProvider;
    }
}
