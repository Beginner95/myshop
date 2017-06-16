<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $content
 */
class Slider extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 200],
            [['content'], 'string', 'max' => 400],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Слайдер №',
            'name' => 'Имя слайдера',
            'image' => 'Фото',
            'content' => 'Контент',
        ];
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
