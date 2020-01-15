<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "buff_comment".
 *
 * @property int $id
 * @property int $user_id
 * @property string $post_id
 * @property int $comment_total
 * @property int $commented
 * @property string $content
 * @property int $speed
 * @property int $free
 */
class BuffComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buff_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'comment_total', 'commented', 'speed', 'free'], 'integer'],
            [['post_id', 'comment_total', 'speed'], 'required'],
            [['content'], 'string'],
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
            'comment_total' => 'Comment Total',
            'commented' => 'Commented',
            'content' => 'Content',
            'speed' => 'Speed',
            'free' => 'Free',
        ];
    }
}
