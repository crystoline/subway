<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OptionType]].
 *
 * @see OptionType
 */
class OptionTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OptionType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OptionType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
