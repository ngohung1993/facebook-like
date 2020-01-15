<?php

namespace common\models\base;

/**
 * This is the model class for table "facebook_account".
 *
 * @property int $id
 * @property int $user_id
 * @property string $uid
 * @property string $name
 * @property string $email
 * @property int $gender
 * @property string $avatar
 * @property string $session_key
 * @property string $secret
 * @property string $access_token
 * @property string $identifier
 *
 * @property User $user
 */
class FacebookAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facebook_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'gender'], 'integer'],
            [['uid', 'name', 'email', 'avatar', 'session_key', 'secret', 'access_token', 'identifier'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'name' => 'Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'avatar' => 'Avatar',
            'session_key' => 'Session Key',
            'secret' => 'Secret',
            'access_token' => 'Access Token',
            'identifier' => 'Identifier',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
