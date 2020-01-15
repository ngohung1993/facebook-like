<?php

use yii\db\Migration;

/**
 * Handles the creation of table `excel`.
 */
class m180719_090113_create_excel_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%excel}}', [
			'id'         => $this->primaryKey(),
			'user_id'    => $this->integer(),
			'title'      => $this->string(),
			'created_at' => $this->dateTime(),
			'path'       => $this->string(),
			'type'       => $this->integer()
		], $tableOptions );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'excel' );
	}
}
