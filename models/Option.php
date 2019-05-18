<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option".
 *
 * @property string $id
 * @property string $option_type_id
 * @property string $value
 *
 * @property OptionType $optionType
 * @property OrderDetail[] $orderDetails
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['option_type_id'], 'integer'],
            [['value'], 'string', 'max' => 100],
            [['option_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OptionType::class, 'targetAttribute' => ['option_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_type_id' => 'Option Type ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionType()
    {
        return $this->hasOne(OptionType::class, ['id' => 'option_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, ['option_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionQuery(get_called_class());
    }

    public function getType(){
        return $this->optionType->name;
    }

}
