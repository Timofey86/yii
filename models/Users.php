<?php

namespace app\models;

use Yii;

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
class Users extends UsersBase
{
    public $password;

    public function rules()
    {
        return array_merge([
            ['password','string', 'min' => 6],
            ['email','email'],
            ],parent::rules());
    }

}
