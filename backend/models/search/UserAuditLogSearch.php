<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserAuditLog;

/**
 * UserAuditLogSearch represents the model behind the search form about `common\models\UserAuditLog`.
 */
class UserAuditLogSearch extends UserAuditLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'op_user'], 'integer'],
            [['op_time', 'from_ip', 'application', 'module', 'controller', 'action', 'get_parms', 'post_parms'], 'safe'],
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
        $query = UserAuditLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'op_time' => $this->op_time,
            'op_user' => $this->op_user,
        ]);

        $query->andFilterWhere(['like', 'from_ip', $this->from_ip])
            ->andFilterWhere(['like', 'application', $this->application])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'controller', $this->controller])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'get_parms', $this->get_parms])
            ->andFilterWhere(['like', 'post_parms', $this->post_parms]);

        return $dataProvider;
    }
}
