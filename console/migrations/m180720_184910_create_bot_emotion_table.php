<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bot_emotion`.
 */
class m180720_184910_create_bot_emotion_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->createTable( 'bot_emotion', [
			'id'           => $this->primaryKey(),
			'user_id'      => $this->integer(),
			'uid'          => $this->string(),
			'start'        => $this->dateTime(),
			'end'          => $this->dateTime(),
			'access_token' => $this->string(),
			'type'         => $this->integer(),
			'emotion'      => $this->string()
		] );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'bot_emotion' );
	}
}
