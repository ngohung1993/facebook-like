<?php

use yii\db\Migration;

/**
 * Class m180721_101109_update_buff_sub_table
 */
class m180721_101109_update_buff_sub_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->addColumn( 'buff_sub', 'free', $this->boolean()->defaultValue( false ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		echo "m180721_101109_update_buff_sub_table cannot be reverted.\n";

		return false;
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180721_101109_update_buff_sub_table cannot be reverted.\n";

		return false;
	}
	*/
}
