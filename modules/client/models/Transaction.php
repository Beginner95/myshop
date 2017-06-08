<?php

namespace app\modules\client\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Transaction extends ActiveRecord
{
    public static function tableName()
    {
        return 'transaction';
    }

    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_added', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_added', 'date_update'], 'safe'],
            [['amount', 'payment_method'], 'required'],
            [['amount'], 'number'],
            [['payment_method'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => 'Введите сумму оплаты (Оплата в у.е.)',
            'payment_method' => 'Опишите способ отправки',
        ];
    }
}