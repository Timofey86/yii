<?php

use yii\db\Migration;

/**
 * Class m220518_072828_insertDataTest
 */
class m220518_072828_insertDataTest extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('activity',[
            'user_id' => 1,
            'title' => 'test',
            'description' => 'test_desc',
            'date_start' => date('Y-m-d'),
            'repeat_type_id' => 1
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220518_072828_insertDataTest cannot be reverted.\n";

        return false;
    }
    */
}
