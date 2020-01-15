<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "buff_share".
 *
 * @property int $id
 * @property int $user_id
 * @property string $post_id
 * @property int $share_total
 * @property int $shared
 * @property int $speed
 * @property int $free
 */
class BuffShare extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buff_share';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'share_total', 'shared', 'speed', 'free'], 'integer'],
            [['post_id', 'share_total', 'speed'], 'required'],
            [['post_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'share_total' => 'Share Total',
            'shared' => 'Shared',
            'speed' => 'Speed',
            'free' => 'Free',
        ];
    }
}
