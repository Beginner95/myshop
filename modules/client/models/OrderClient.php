<?php

namespace app\modules\client\models;

use yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "order_client".
 *
 * @property integer $id
 * @property integer $client_id
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
 * @property Client $client
 * @property OrderItemsClient[] $orderItemsClients
 * @property Payment[] $payments
 */
class OrderClient extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_client';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_added', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'required'],
            [['id', 'client_id', 'delivery_id', 'qty'], 'integer'],
            [['date_added', 'date_update', 'comment'], 'safe'],
            [['sum'], 'number'],
            [['status'], 'string'],
            [['secondName', 'address'], 'string', 'max' => 255],
            [['email', 'phone'], 'string', 'max' => 45],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
//            'client_id' => 'Client ID',
            'delivery_id' => 'Способ доставки',
            'date_added' => 'Дата',
//            'date_update' => 'Date Update',
//            'qty' => 'Qty',
            'sum' => 'Сумма',
            'status' => 'Статус заказа',
            'firstName' => 'Фамилия',
            'secondName' => 'Имя',
            'lastName' => 'Отчество',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'comment' => 'Чего нет в прайсе'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemsClients()
    {
        return $this->hasMany(OrderItemsClient::className(), ['order_client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['order_client_id' => 'id']);
    }
}
