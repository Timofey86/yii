<?php

use yii\db\Migration;

/**
 * Class m220511_065720_alterTablesActivity
 */
class m220511_065720_alterTablesActivity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'user_id',$this->integer()->notNull());

        $this->addForeignKey('activity_userFK','activity', 'user_id',
            'users','id','CASCADE','CASCADE');

        $this->createIndex('usersEmailInd','users','email',true);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activity_userFK','activity');
        $this->dropColumn('activity','user_id');
        $this->dropIndex('usersEmailInd','users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220511_065720_alterTablesActivity cannot be reverted.\n";

        return false;
    }
    */
}
