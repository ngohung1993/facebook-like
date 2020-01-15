<?php

namespace common\models;

use common\models\base;

class BuffComment extends base\BuffComment {

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'post_id'     => 'Post ID',
			'share_total' => 'Số share cần mua',
			'speed'       => 'Số share giữa 2 phiên',
		];
	}
}
