<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "bot_emotion".
 *
 * @property int $id
 * @property int $user_id
 * @property string $uid
 * @property string $start
 * @property string $end
 * @property string $access_token
 * @property int $type
 * @property string $emotions
 * @property string $note
 * @property string $name
 * @property int $months
 */
class BotEmotion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot_emotion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'months'], 'integer'],
            [['start', 'end'], 'safe'],
            [['uid', 'access_token', 'emotions', 'note', 'name'], 'string', 'max' => 255],
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
            'uid' => 'Uid',
            'start' => 'Start',
            'end' => 'End',
            'access_token' => 'Access Token',
            'type' => 'Type',
            'emotions' => 'Emotions',
            'note' => 'Note',
            'name' => 'Name',
            'months' => 'Months',
        ];
    }
}
