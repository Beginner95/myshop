<?php


namespace app\modules\client\models;
use yii\db\ActiveRecord;
use Yii;

class OrderItemsClient extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_items_client';
    }

    public function rules()
    {
        return [
            [['order_client_id', 'product_id'], 'required'],
            [['id', 'order_client_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['order_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderClient::className(), 'targetAttribute' => ['order_client_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}