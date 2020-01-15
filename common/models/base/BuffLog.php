<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "buff_log".
 *
 * @property int $id
 * @property string $access_token
 * @property string $post_id
 */
class BuffLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buff_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_token', 'post_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
            'post_id' => 'Post ID',
        ];
    }
}
