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
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash', 'auth_key'], 'required'],
            [['date_add'], 'safe'],
            [['email', 'password_hash', 'token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'token' => Yii::t('app', 'Token'),
            'date_add' => Yii::t('app', 'Date Add'),
        ];
    }

    /**
     * Gets query for [[Activities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::class, ['user_id' => 'id']);
    }
}
