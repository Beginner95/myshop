<?php

namespace app\modules\client\models;

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