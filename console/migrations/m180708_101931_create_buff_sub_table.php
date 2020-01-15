<?php

use yii\db\Migration;

/**
 * Handles the creation of table `buff_sub`.
 */
class m180708_101931_create_buff_sub_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%buff_sub}}', [
			'id'              => $this->primaryKey(),
			'user_id'         => $this->integer(),
			'uid'             => $this->string()->notNull(),
			'subscribe_total' => $this->integer()->notNull(),
			'subscribed'      => $this->integer()->defaultValue( 0 ),
			'speed'           => $this->integer()->notNull()
		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'buff_sub' );
	}
}
