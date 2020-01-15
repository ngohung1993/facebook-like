<?php

use yii\db\Migration;

/**
 * Handles the creation of table `buff_comment`.
 */
class m180708_101937_create_buff_comment_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%buff_comment}}', [
			'id'            => $this->primaryKey(),
			'user_id'       => $this->integer(),
			'post_id'       => $this->string()->notNull(),
			'comment_total' => $this->integer()->notNull(),
			'commented'     => $this->integer()->defaultValue( 0 ),
			'content'       => $this->text(),
			'speed'         => $this->integer()->notNull()
		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'buff_comment' );
	}
}
