<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity_repeat_type}}`.
 */
class m220516_100437_create_activity_repeat_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity_repeat_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->addForeignKey('fk_activity_repeat_type_activity',
            'activity', 'repeat_type_id',
            'activity_repeat_type', 'id',
            'RESTRICT', 'RESTRICT');

        $this->batchInsert('activity_repeat_type',
            ['id', 'name'],
            [
                [1, 'Без повтора'],
                [2, 'Ежедневно'],
                [3, 'Еженедельно'],
                [4, 'Ежемесячно'],
                [5, 'Ежегодно'],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_activity_repeat_type_activity','activity');
        $this->dropTable('activity_repeat_type');
    }
}
