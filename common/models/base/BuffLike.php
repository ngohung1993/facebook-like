<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "buff_like".
 *
 * @property int $id
 * @property int $user_id
 * @property string $post_id
 * @property int $like_total
 * @property int $liked
 * @property int $speed
 * @property string $emotion
 * @property int $free
 */
class BuffLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buff_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'like_total', 'liked', 'speed', 'free'], 'integer'],
            [['post_id', 'like_total', 'speed', 'emotion'], 'required'],
            [['post_id', 'emotion'], 'string', 'max' => 255],
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
            'like_total' => 'Like Total',
            'liked' => 'Liked',
            'speed' => 'Speed',
            'emotion' => 'Emotion',
            'free' => 'Free',
        ];
    }
}
