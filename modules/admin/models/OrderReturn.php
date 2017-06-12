<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\client\models\OrderItemsReturn;

/**
 * This is the model class for table "order_return".
 *
 * @property string $id
 * @property string $user_id
 * @property string $date_added
 * @property string $date_update
 * @property integer $qty
 * @property string $sum
 * @property string $status
 *
 * @property OrderItemsReturn[] $orderItemsReturns
 * @property User $user
 */
class OrderReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'qty'], 'integer'],
            [['date_added', 'date_update'], 'safe'],
            [['sum'], 'number'],
            [['status'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Возврата',
            'user_id' => 'Клиент',
            'date_added' => 'Дата возврата',
            'date_update' => 'Дата обновления',
            'qty' => 'Количество товаров',
            'sum' => 'Сумма',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemsReturns()
    {
        return $this->hasMany(OrderItemsReturn::className(), ['order_return_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
