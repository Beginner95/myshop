<?php

namespace app\modules\admin\models;

use app\modules\client\models\Delivery;
use app\modules\client\models\OrderItemsClient;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $delivery_id
 * @property string $date_added
 * @property string $date_update
 * @property integer $qty
 * @property string $sum
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 *
 * @property OrderItems[] $orderItems
 */
class OrderClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_added', 'date_update', 'comment'], 'safe'],
            [['qty', 'delivery_id'], 'integer'],
            [['sum'], 'number'],
            [['status'], 'string'],
            [['secondName', 'address'], 'string', 'max' => 255],
            [['email', 'phone'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ заказа',
            'date_added' => 'Дата заказа',
            'date_update' => 'Дата изменения',
            'qty' => 'Кол-во',
            'sum' => 'Сумма',
            'status' => 'Статус',
            'secondName' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'delivery_id' => 'Способ доставки',
            'comment' => 'Дополнение к заказу',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItemsClient::className(), ['order_client_id' => 'id']);
    }

    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }
}
