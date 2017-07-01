<?php

namespace app\models;
use yii\db\ActiveRecord;
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        return static::findOne($token);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function rules()
    {
        return [
            [['firstName', 'secondName', 'lastName', 'username', 'password'], 'required'],
            [['firstName', 'secondName', 'lastName', 'email'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 255],
            [['username', 'password'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            ['email', 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User'],
            [['username'], 'unique',  'targetClass' => 'app\models\User']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstName' => 'Фамилия',
            'secondName' => 'Имя',
            'lastName' => 'Отчество',
            'address' => 'Адрес',
            'email' => 'E-mail',
            'username' => 'Логин',
            'password' => 'Пароль',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey()
    {
        $this->authKey = \Yii::$app->security->generateRandomString();
    }
    
}
