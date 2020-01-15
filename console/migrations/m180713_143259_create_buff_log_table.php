<?php

use yii\db\Migration;

/**
 * Handles the creation of table `buff_log`.
 */
class m180713_143259_create_buff_log_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%buff_log}}', [
			'id'           => $this->primaryKey(),
			'access_token' => $this->string(),
			'uid'      => $this->string()
		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'buff_log' );
	}
}
