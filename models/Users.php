<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string|null $token
 * @property string $date_add
 *
 * @property Activity[] $activities
 * @property int $date_created [timestamp]
 * @property string $USER [char(32)]
 * @property int $CURRENT_CONNECTIONS [bigint(20)]
 * @property int $TOTAL_CONNECTIONS [bigint(20)]
 */
class Users extends UsersBase implements IdentityInterface
{
    public $password;

    const SCENARIO_AUTH = 'auth_scenario';
    const SCENARIO_REGISTER = 'register_scenario';


    public function rules()
    {
        return array_merge([
            ['password','string', 'min' => 6],
            ['email','email'],
            ['email','exist','on' => self::SCENARIO_AUTH],
            [['email'], 'unique','on' => self::SCENARIO_REGISTER],
            ],parent::rules());
    }

    public function setAuthScenario()
    {
        $this->setScenario(self::SCENARIO_AUTH);
    }

    public function getUsername(){
        return $this->email;
    }

    public function setRegisterScenario()
    {
        $this->setScenario(self::SCENARIO_REGISTER );
    }

    public static function findIdentity($id)
    {
        return Users::find()->andWhere(['id' => $id])->cache(100)->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->andWhere(['token' => $token])->one();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }
}
