<?php

use yii\db\Migration;

/**
 * Handles the creation of table `buff_like`.
 */
class m180705_181305_create_buff_like_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%buff_like}}', [
			'id'         => $this->primaryKey(),
			'user_id'    => $this->integer(),
			'post_id'    => $this->string()->notNull(),
			'like_total' => $this->integer()->notNull(),
			'liked'      => $this->integer()->defaultValue( 0 ),
			'speed'      => $this->integer()->notNull(),
			'emotion'    => $this->string()->notNull(),
		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'access_buff_like' );
	}
}