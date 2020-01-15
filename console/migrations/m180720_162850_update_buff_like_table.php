<?php

use yii\db\Migration;

/**
 * Class m180720_162850_update_buff_like_table
 */
class m180720_162850_update_buff_like_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->addColumn( 'buff_like', 'free', $this->boolean()->defaultValue( false ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		echo "m180720_162850_update_buff_like_table cannot be reverted.\n";

		return false;
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180720_162850_update_buff_like_table cannot be reverted.\n";

		return false;
	}
	*/
}
