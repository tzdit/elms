<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[StudentGroup]].
 *
 * @see StudentGroup
 */
class StudentGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StudentGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StudentGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
