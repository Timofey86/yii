<?php

use yii\db\Migration;

/**
 * Class m220511_061238_createTablesActivityUsers
 */
class m220511_061238_createTablesActivityUsers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Activity', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'date_start' => $this->dateTime()->notNull(),
            'email' => $this->string(150),
            'use_notification' => $this->boolean()->notNull()->defaultValue(0),
            'is_blocked' => $this->boolean()->notNull()->defaultValue(0),
            'date_created' => $this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('users',[
            'id' => $this->primaryKey(),
            'email' => $this->string(150)->notNull(),
            'password_hash' => $this->string(300)->notNull(),
            'token' => $this->string(300),
            'auth_key' => $this->string(150),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220511_061238_createTablesActivityUsers cannot be reverted.\n";

        return false;
    }
    */
}
