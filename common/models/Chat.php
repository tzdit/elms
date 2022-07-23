<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $chatID
 * @property int $sender
 * @property int $receiver
 * @property string $chatText
 * @property string|null $chatDateTime
 * @property string $status
 *
 * @property User $receiver0
 * @property User $sender0
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender', 'receiver', 'chatText', 'status'], 'required'],
            [['sender', 'receiver'], 'integer'],
            [['chatDateTime'], 'safe'],
            [['chatText'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 10],
            [['receiver'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver' => 'id']],
            [['sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chatID' => 'Chat ID',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'chatText' => 'Chat Text',
            'chatDateTime' => 'Chat Date Time',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Receiver0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver0()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
    }

    /**
     * Gets query for [[Sender0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }
}
