<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $model
 * @property string $image
 * @property string $price
 * @property string $wholesale_price
 * @property string $status
 * @property string $sale
 * @property string $new
 * @property string $hit
 * @property string $keywords
 * @property string $description
 * @property string $date_added
 * @property string $date_update
 *
 * @property OrderItems[] $orderItems
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['price', 'wholesale_price'], 'number'],
            [['status', 'sale', 'new', 'hit'], 'string'],
            [['date_added', 'date_update'], 'safe'],
            [['name', 'model', 'image'], 'string', 'max' => 200],
            [['keywords', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'model' => 'Model',
            'image' => 'Image',
            'price' => 'Price',
            'wholesale_price' => 'Wholesale Price',
            'status' => 'Status',
            'sale' => 'Sale',
            'new' => 'New',
            'hit' => 'Hit',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'date_added' => 'Date Added',
            'date_update' => 'Date Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
