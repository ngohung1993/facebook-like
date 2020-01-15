<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "buff_sub".
 *
 * @property int $id
 * @property int $user_id
 * @property string $uid
 * @property int $subscribe_total
 * @property int $subscribed
 * @property int $speed
 * @property int $free
 */
class BuffSub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buff_sub';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subscribe_total', 'subscribed', 'speed', 'free'], 'integer'],
            [['uid', 'subscribe_total', 'speed'], 'required'],
            [['uid'], 'string', 'max' => 255],
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
            'subscribe_total' => 'Subscribe Total',
            'subscribed' => 'Subscribed',
            'speed' => 'Speed',
            'free' => 'Free',
        ];
    }
}
