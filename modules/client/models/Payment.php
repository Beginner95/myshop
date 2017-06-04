<?php

namespace app\modules\client\models;
use yii\db\ActiveRecord;

class Payment extends ActiveRecord
{
    public static function tableName()
    {
        return 'payment';
    }
}