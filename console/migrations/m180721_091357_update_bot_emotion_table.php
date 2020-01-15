<?php

use yii\db\Migration;

/**
 * Class m180721_091357_update_bot_emotion_table
 */
class m180721_091357_update_bot_emotion_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->addColumn( 'bot_emotion', 'note', $this->string() );
		$this->addColumn( 'bot_emotion', 'name', $this->string() );
		$this->addColumn( 'bot_emotion', 'months', $this->integer() );
		$this->renameColumn( 'bot_emotion', 'emotion', 'emotions' );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		echo "m180721_091357_update_bot_emotion_table cannot be reverted.\n";

		return false;
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180721_091357_update_bot_emotion_table cannot be reverted.\n";

		return false;
	}
	*/
}
