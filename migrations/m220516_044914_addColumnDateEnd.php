<?php

use yii\db\Migration;

/**
 * Class m220516_044914_addColumnDateEnd
 */
class m220516_044914_addColumnDateEnd extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity','date_end',$this->dateTime());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity','date_end');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220516_044914_addColumnDateEnd cannot be reverted.\n";

        return false;
    }
    */
}
