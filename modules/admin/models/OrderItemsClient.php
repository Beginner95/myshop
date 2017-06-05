<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "order_items_client".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $order_id
 * @property string $name
 * @property string $price
 * @property integer $qty_item
 * @property string $sum_item
 *
 * @property OrderClient $order
 * @property Product $product
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'order_client_id'], 'required'],
            [['product_id', 'order_client_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['order_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderClient::className(), 'targetAttribute' => ['order_client_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'order_client_id' => 'Order ID',
            'name' => 'Name',
            'price' => 'Price',
            'qty_item' => 'Qty Item',
            'sum_item' => 'Sum Item',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(OrderClient::className(), ['id' => 'order_client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        //return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
