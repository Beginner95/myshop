<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;

/**
 * Class Delivery
 * @package app\modules\client\models
 * @property integer $id
 * @property string $cost
 * @property string $name
 * @property string $description
 */

class Delivery extends ActiveRecord
{
    public static function tableName()
    {
        return 'delivery';
    }

    public function getOrderClient()
    {
        return $this->hasOne(OrderClient::className(), ['delivery_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cost'], 'number'],
            [['cost', 'name', 'description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
            'cost' => 'Цена',
        ];
    }
}