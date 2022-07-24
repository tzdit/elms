<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chatroomsignals".
 *
 * @property int $signalID
 * @property int $signaler
 * @property int $receiver
 * @property string $room_type
 * @property string $signal_type
 * @property string|null $time
 *
 * @property User $signaler0
 */
class Chatroomsignals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chatroomsignals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['signaler', 'receiver', 'room_type', 'signal_type'], 'required'],
            [['signaler', 'receiver'], 'integer'],
            [['time'], 'safe'],
            [['room_type', 'signal_type'], 'string', 'max' => 20],
            [['signaler'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['signaler' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'signalID' => 'Signal ID',
            'signaler' => 'Signaler',
            'receiver' => 'Receiver',
            'room_type' => 'Room Type',
            'signal_type' => 'Signal Type',
            'time' => 'Time',
        ];
    }

    /**
     * Gets query for [[Signaler0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSignaler0()
    {
        return $this->hasOne(User::className(), ['id' => 'signaler']);
    }
}
