<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $logID
 * @property int|null $userID
 * @property string $object
 * @property string $activity
 * @property string $logdate
 * @property string $logtime
 *
 * @property User $user
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID'], 'integer'],
            [['object', 'activity', 'logdate', 'logtime'], 'required'],
            [['logdate', 'logtime'], 'safe'],
            [['object'], 'string', 'max' => 10],
            [['activity'], 'string', 'max' => 15],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'logID' => 'Log ID',
            'userID' => 'User ID',
            'object' => 'Object',
            'activity' => 'Activity',
            'logdate' => 'Logdate',
            'logtime' => 'Logtime',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userID']);
    }
}
