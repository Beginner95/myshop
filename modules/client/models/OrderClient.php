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
            [['client_id', 'qty'], 'integer'],
            [['date_added', 'date_update'], 'safe'],
            [['sum'], 'number'],
            [['status'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
            [['email', 'phone'], 'string', 'max' => 45],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
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
            'date_added' => 'Дата',
//            'date_update' => 'Date Update',
//            'qty' => 'Qty',
            'sum' => 'Сумма',
            'status' => 'Статус заказа',
//            'name' => 'Name',
//            'email' => 'Email',
//            'phone' => 'Phone',
//            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
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
