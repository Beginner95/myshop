<?php


namespace app\modules\client\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

/**
 * Class OrderItemsClient
 * @package app\modules\client\models
 * @property string $name
 * @property string $availability
 */
class OrderItemsClient extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_items_client';
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
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['client_id', 'order_client_id', 'product_id'], 'required'],
            [['id', 'order_client_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['order_client_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderClient::className(), 'targetAttribute' => ['order_client_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '',
            'description' => '',
            'qty' => '',
            'sum' => '',
            'availability' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(OrderClient::className(), ['id' => 'order_client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}