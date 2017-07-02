<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "site_settings".
 *
 * @property integer $id
 * @property string $logotip
 * @property string $phone
 * @property string $name_company
 * @property string $email
 * @property string $address
 * @property string $slogan
 * @property double $usd
 * @property double $rub
 */
class SiteSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usd', 'rub'], 'number'],
            [['logotip', 'phone', 'email'], 'string', 'max' => 45],
            [['name_company', 'address'], 'string', 'max' => 200],
            [['slogan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logotip' => 'Логотип (путь до картинки)',
            'phone' => 'Телефон',
            'name_company' => 'Имя компании',
            'email' => 'E-mail',
            'address' => 'Адрес',
            'slogan' => 'Слоган',
            'usd' => 'USD',
            'rub' => 'RUB',
        ];
    }
}
