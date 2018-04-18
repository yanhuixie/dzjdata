<?php

namespace common\models\query;

use common\models\User;
use yii\db\ActiveQuery;

/**
 * Class UserQuery
 * @package common\models\query
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function notDeleted()
    {
        $this->andWhere(['!=', 'status', User::STATUS_DELETED]);
        return $this;
    }

    /**
     * @return $this
     */
    public function active()
    {
        //$this->andWhere(['status' => User::STATUS_ACTIVE]);
        $this->andWhere(sprintf('status = %s or status = %s', User::STATUS_ACTIVE, User::STATUS_APPROVED));
        return $this;
    }
    
    /**
     * 
     * @return \common\models\query\UserQuery
     * @author xieyh
     */
	public function approved()
    {
        //$this->andWhere(['status' => User::STATUS_ACTIVE]);
        $this->andWhere(sprintf('status = %s', User::STATUS_APPROVED));
        return $this;
    }
}