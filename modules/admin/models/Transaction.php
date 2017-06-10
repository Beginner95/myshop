<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "transaction".
 *
 * @property string $id
 * @property string $amount
 * @property string $status
 * @property string $payment_method
 * @property string $date_added
 * @property string $date_update
 * @property string $user_id
 *
 * @property User $user
 */
class Transaction extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
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
