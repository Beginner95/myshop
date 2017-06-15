<?php

namespace app\models;

use yii\db\ActiveRecord;

class Slider extends ActiveRecord
{
    public static function tableName()
    {
        return 'slider';
    }
}