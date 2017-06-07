<?php

namespace app\modules\client\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Class Payment
 * @package app\modules\client\models
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $order_client_id
 * @property float $amount
 * @property string $description
 * @property string $date_operation
 */

class Payment extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_operation', 'date_operation'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_operation'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return 'payment';
    }

    public function rules()
    {
        return [
            [['id', 'client_id', 'order_client_id'], 'integer'],
            [['amount'], 'number'],
            [['description', 'date_operation'], 'string'],

        ];
    }
}