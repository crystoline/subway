<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meal".
 *
 * @property string $id
 * @property string $date
 * @property string $status
 * @property string $location
 *
 * @property Order[] $orders
 * @property string active
 */
class Meal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['status'], 'integer'],
            [['location'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'status' => 'Status',
            'location' => 'Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['meal_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MealQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MealQuery(get_called_class());
    }
    public function getActive()
    {
        return $this->status? 'Yes': 'No';

    }
}
