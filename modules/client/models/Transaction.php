<?php


namespace app\modules\client\models;


use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Class Transaction
 * @package app\modules\client\models
 * @property integer $user_id
 */
class Transaction extends ActiveRecord
{
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['status'], 'string'],
            [['date_added', 'date_update'], 'safe'],
//            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['payment_method'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Платеж №',
            'amount' => 'Сумма',
            'status' => 'Статус',
            'payment_method' => 'Метод оплаты',
            'date_added' => 'Дана платежа',
            'date_update' => 'Дата изменения',
            'user_id' => 'Клиент',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}