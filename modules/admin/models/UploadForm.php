<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $priceFile;

    public function rules()
    {
        return [
            [['priceFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlt, xlsx'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'priceFile' => 'Прайс лист'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->priceFile->saveAs('upload/price-lists/'. date('d-m-Y H-i-s') . ' ' . $this->priceFile->baseName . '.' . $this->priceFile->extension);
            return true;
        } else {
            return false;
        }
    }
}