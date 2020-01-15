<?php

use yii\db\Migration;

/**
 * Handles the creation of table `facebook_account`.
 */
class m180711_083511_create_facebook_account_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{facebook_account}}', [
			'id'           => $this->primaryKey(),
			'user_id'      => $this->integer(),
			'uid'          => $this->string(),
			'name'         => $this->string(),
			'email'        => $this->string(),
			'gender'       => $this->integer(),
			'avatar'       => $this->string(),
			'session_key'  => $this->string(),
			'secret'       => $this->string(),
			'access_token' => $this->string(),
			'identifier'   => $this->string(),
		], $tableOptions );

		$this->addForeignKey( 'fk_facebook_account_user', 'facebook_account', 'user_id', 'user', 'id', 'CASCADE' );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'facebook_account' );
	}
}
