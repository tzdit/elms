<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fresh_thread".
 *
 * @property int $freshID
 * @property int|null $threadID
 * @property string $threadTitle
 * @property string $thread_desc
 * @property string $thread_date
 * @property string $thread_time
 *
 * @property Thread $thread
 */
class FreshThread extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fresh_thread';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['threadID'], 'integer'],
            [['threadTitle', 'thread_desc', 'thread_date', 'thread_time'], 'required'],
            [['thread_date', 'thread_time'], 'safe'],
            [['threadTitle'], 'string', 'max' => 200],
            [['thread_desc'], 'string', 'max' => 1000],
            [['threadID'], 'exist', 'skipOnError' => true, 'targetClass' => Thread::className(), 'targetAttribute' => ['threadID' => 'threadID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'freshID' => 'Fresh ID',
            'threadID' => 'Thread ID',
            'threadTitle' => 'Thread Title',
            'thread_desc' => 'Thread Desc',
            'thread_date' => 'Thread Date',
            'thread_time' => 'Thread Time',
        ];
    }

    /**
     * Gets query for [[Thread]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThread()
    {
        return $this->hasOne(Thread::className(), ['threadID' => 'threadID']);
    }
}
