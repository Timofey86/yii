<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220516_092446_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'token' => $this->string()->unique(),
            'date_add' => $this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->insert('users',[
            'id' => 1,
            'email' => 'test@test.ru',
            'password_hash' => uniqid(),
            'auth_key' => uniqid()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
