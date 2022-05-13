<?php

use yii\db\Migration;

/**
 * Class m220511_072425_insertsData
 */
class m220511_072425_insertsData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id' => 1,
            'email' => 'test@test.ru',
            'password_hash' => 'qwer',
        ]);
        $this->insert('users',[
            'id' => 2,
            'email' => 'test2@test.ru',
            'password_hash' => 'qwerty',
        ]);

        $this->batchInsert('activity',
            ['title','user_id', 'description','date_start','use_notification'],
            [
                ['title 1',1, 'desc', date('Y-m-d'), mt_rand(0,1)],
                ['title 2',1,'descw 2',date('Y-m-d'), mt_rand(0,1)],
                ['title 3',1, 'desc 3', date('Y-m-d'), mt_rand(0,1)],
                ['title 4',2,'descw 4',date('Y-m-d'), mt_rand(0,1)],
                ['title 5',2,'descw 5',date('Y-m-d'), mt_rand(0,1)],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220511_072425_insertsData cannot be reverted.\n";

        return false;
    }
    */
}
