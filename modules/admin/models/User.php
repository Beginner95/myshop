<?php

namespace app\modules\admin\models;
use app\modules\client\models\OrderClient;
use app\modules\client\models\Payment;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $secondName
 * @property string $lastName
 * @property string $address
 * @property string $email
 * @property string $username
 * @property string $password
 * @property double $discount
 * @property string $status
 * @property string $authKey
 * @property string $phone
 *
 * @property OrderClient[] $orderClients
 * @property OrderReturn[] $orderReturns
 * @property Payment[] $payments
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'secondName', 'lastName', 'email', 'username', 'password'], 'required'],
            [['discount'], 'number'],
            [['status'], 'string'],
            [['firstName', 'secondName', 'lastName', 'email'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 255],
            [['username', 'password'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'Фамилия',
            'secondName' => 'Имя',
            'lastName' => 'Отчество',
            'address' => 'Адрес',
            'email' => 'E-mail',
            'username' => 'Логин',
            'password' => 'Пароль',
            'discount' => 'Скидка %',
            'status' => 'Статус',
//            'authKey' => 'Auth Key',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderClients()
    {
        return $this->hasMany(OrderClient::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderReturns()
    {
        return $this->hasMany(OrderReturn::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['client_id' => 'id']);
    }
}
