<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
 * @property string $content
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
class Product extends ActiveRecord
{
    public $image;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
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
            [['content', 'status', 'sale', 'new', 'hit'], 'string'],
            [['date_added', 'date_update'], 'safe'],
            [['name', 'model'], 'string', 'max' => 200],
            [['keywords', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID товара',
            'category_id' => 'Категория',
            'name' => 'Наименование',
            'model' => 'Модель',
            'image' => 'Фото',
            'price' => 'Цена',
            'wholesale_price' => 'Оптовая цена',
            'content'   => 'Описание товара',
            'status' => 'Статус',
            'sale' => 'Распродажа',
            'new' => 'Новинка',
            'hit' => 'Хит',
            'keywords' => 'Ключевые слова',
            'description' => 'Мето-описание',
            'date_added' => 'Дата добавления',
            'date_update' => 'Дата обнавления',
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

    public function upload(){
        if($this->validate()){
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        }else{
            return false;
        }
    }
}
