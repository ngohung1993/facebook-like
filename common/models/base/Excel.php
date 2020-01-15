<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "excel".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $created_at
 * @property string $path
 * @property int $type
 */
class Excel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'excel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'path'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'created_at' => 'Created At',
            'path' => 'Path',
            'type' => 'Type',
        ];
    }
}
