<?php
/**
 * Created by PhpStorm.
 * User: Vaharsolta
 * Date: 26.05.2017
 * Time: 5:21
 */

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}