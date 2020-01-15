<?php

namespace common\models;

use common\models\base;

class BuffLike extends base\BuffLike {

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id'         => 'ID',
			'user_id'    => 'User ID',
			'post_id'    => 'Post ID',
			'like_total' => 'Số like cần mua',
			'liked'      => 'Like hoàn thành',
			'speed'      => 'Số like giữa 2 phiên (1 phút)',
			'emotion'    => 'Cảm xúc',
		];
	}

}
