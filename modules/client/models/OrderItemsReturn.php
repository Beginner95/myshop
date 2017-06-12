<?php

namespace app\modules\client\models;


use yii\db\ActiveRecord;

class OrderItemsReturn extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_items_return';
    }

    public function rules()
    {
        return [
            [['user_id', 'order_return_id', 'product_id'], 'required'],
            [['id', 'order_return_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['order_return_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderReturn::className(), 'targetAttribute' => ['order_return_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(OrderReturn::className(), ['id' => 'order_return_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}