<?php

use yii\db\Migration;

/**
 * Class m180720_190346_update_buff_share_table
 */
class m180720_190346_update_buff_share_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn( 'buff_share', 'free', $this->boolean()->defaultValue( false ) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180720_190346_update_buff_share_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180720_190346_update_buff_share_table cannot be reverted.\n";

        return false;
    }
    */
}
