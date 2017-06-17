<?php

namespace app\modules\client\models;
use yii\db\ActiveRecord;
use Yii;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $password
 */
class User extends ActiveRecord
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;
    
    public static function tableName()
    {
        return 'user';
    }
    
    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'newPasswordRepeat' => 'Повторите пароль',
            'firstName' => 'Фамилия',
            'secondName' => 'Имя',
            'lastName' => 'Отчество',
            'address' => 'Адрес',
            'email' => 'E-mail',
            'username' => 'Логин',
            'discount' => 'Скидка %',
            'phone' => 'Телефон',
        ];
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function changePassword()
    {
        if ($this->validate()) {
            $this->setPassword($this->newPassword);
            return $this->save();
        } else {
            return false;
        }
    }
}