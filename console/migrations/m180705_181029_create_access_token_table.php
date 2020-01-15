<?php

use yii\db\Migration;

/**
 * Handles the creation of table `access_token`.
 */
class m180705_181029_create_access_token_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%access_token}}', [
			'id'           => $this->primaryKey(),
			'user_id'      => $this->integer(),
			'name'         => $this->string(),
			'gender'       => $this->integer(),
			'access_token' => $this->text()
		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'access_token' );
	}
}