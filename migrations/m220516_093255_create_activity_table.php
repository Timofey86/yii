<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m220516_093255_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'date_start' => $this->dateTime()->notNull(),
            'date_end' => $this->dateTime(),
            'repeat_type_id' => $this->integer()->notNull(),
            'is_blocked' => $this->boolean()->notNull()->defaultValue(0),
            'use_notification' => $this->boolean()->notNull()->defaultValue(0),
            'email' => $this->string(),
            'date_add' => $this->timestamp()->notNull()
            ->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey('fk_user_activity',
        'activity','user_id',
        'users','id',
        'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_activity','activity');
        $this->dropTable('activity');
    }
}
