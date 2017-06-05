<?php

namespace app\modules\admin\models;

use app\modules\client\models\OrderItemsClient;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
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
            [['date_added', 'date_update'], 'safe'],
            [['qty'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItemsClient::className(), ['order_client_id' => 'id']);
    }
}
