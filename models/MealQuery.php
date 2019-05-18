<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Meal]].
 *
 * @see Meal
 */
class MealQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Meal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Meal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
