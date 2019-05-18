<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_type".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $sort
 * @property string $is_multiple
 *
 * @property Option[] $options
 */
class OptionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'is_multiple'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'sort' => 'Sort',
            'is_multiple' => 'Is Multiple',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Option::className(), ['option_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OptionTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionTypeQuery(get_called_class());
    }


    public function getIsMultiChoice(){
        return $this->is_multiple? 'Yes': 'No';
    }
}
