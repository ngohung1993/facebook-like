<?php

use yii\db\Migration;

/**
 * Handles the creation of table `buff_share`.
 */
class m180708_101943_create_buff_share_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%buff_share}}', [
			'id'          => $this->primaryKey(),
			'user_id'     => $this->integer(),
			'post_id'     => $this->string()->notNull(),
			'share_total' => $this->integer()->notNull(),
			'shared'      => $this->integer()->defaultValue( 0 ),
			'speed'       => $this->integer()->notNull()

		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'buff_share' );
	}
}
