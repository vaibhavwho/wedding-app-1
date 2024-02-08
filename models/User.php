<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $accessType
 * @property string $authKey
 * @property string $accessToken
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    
    const ACCESS_TYPE_ADMIN = 1;
    const ACCESS_TYPE_CUSTOMER = 2;
    //public $password_repeat;
    
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'accessType', 'authKey', 'accessToken'], 'required'],
            [['accessType'], 'integer'],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            //['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            ['accessType', 'required'],
            ['accessType', 'in', 'range' => [self::ACCESS_TYPE_ADMIN, self::ACCESS_TYPE_CUSTOMER]],
        ];
    }

    public static function findIdentity($id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(['accessToken' => $token])->one();
    }
    

    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }
    

    public function getId()
    {
        return $this->id;
    }
    

    public function getAuthKey()
    {
        return $this->authKey;
    }
    
  
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'accessType' => 'Access Type',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
}
