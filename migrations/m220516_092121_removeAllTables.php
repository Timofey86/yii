<?php

use yii\db\Migration;

/**
 * Class m220516_092121_removeAllTables
 */
class m220516_092121_removeAllTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('activity_userFK','activity');
        $this->dropColumn('activity','user_id');
        $this->dropIndex('usersEmailInd','users');
        $this->dropTable('users');
        $this->dropTable('activity');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220516_092121_removeAllTables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220516_092121_removeAllTables cannot be reverted.\n";

        return false;
    }
    */
}
