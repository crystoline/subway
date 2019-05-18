<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $meal_id
 * @property string $date
 * @property string $location
 *
 * @property Customer $customer
 * @property Meal $meal
 * @property OrderDetail[] $orderDetails
 * @property integer rating
 * @property string ratingHtml
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'meal_id', 'rating'], 'integer'],
            [['date'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['meal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meal::class, 'targetAttribute' => ['meal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'meal_id' => 'Meal ID',
            'date' => 'Date',
            'location' => "Location"
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeal()
    {
        return $this->hasOne(Meal::class, ['id' => 'meal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    public function hasOption($option_id) {
        foreach ($this->orderDetails as $orderDetail) {
            if($orderDetail->option_id == $option_id){
                return true;
            }
        }
            return false;
    }

    public function getOptions($option_type_id){
        $options = [];
        foreach ($this->orderDetails as $orderDetail) {
            if(!empty($orderDetail->option->option_type_id) && $orderDetail->option->option_type_id == $option_type_id){
                $options[] = $orderDetail->option;
            }
        }
        return $options;
    }

    /**
     * @return string
     */
    public function getRatingHtml(){
        //var_dump($this->rating); die();
        if($this->rating == 0) {
            return '<span class="feel"><i class="fa fa-frown fa-3x"></i></span>';
        }else if($this->rating == 1) {
            return '<span class="feel"><i class="fa fa-meh fa-3x"></i></span>';
        }else if($this->rating == 2){
            return '<span class="feel"><i class="fa fa-smile fa-3x"></i></span>';
        }
        return '';
    }
}
