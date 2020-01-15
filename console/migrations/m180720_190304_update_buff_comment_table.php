<?php

use yii\db\Migration;

/**
 * Class m180720_190304_update_buff_comment_table
 */
class m180720_190304_update_buff_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn( 'buff_comment', 'free', $this->boolean()->defaultValue( false ) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180720_190304_update_buff_comment_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180720_190304_update_buff_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
