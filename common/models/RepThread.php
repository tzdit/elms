<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rep_thread".
 *
 * @property int $repID
 * @property int|null $threadID
 * @property int|null $parent_thread
 * @property string $content
 * @property string $repdate
 * @property string $reptime
 *
 * @property Thread $thread
 * @property Thread $parentThread
 */
class RepThread extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rep_thread';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['threadID', 'parent_thread'], 'integer'],
            [['content', 'repdate', 'reptime'], 'required'],
            [['repdate', 'reptime'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['threadID'], 'exist', 'skipOnError' => true, 'targetClass' => Thread::className(), 'targetAttribute' => ['threadID' => 'threadID']],
            [['parent_thread'], 'exist', 'skipOnError' => true, 'targetClass' => Thread::className(), 'targetAttribute' => ['parent_thread' => 'threadID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'repID' => 'Rep ID',
            'threadID' => 'Thread ID',
            'parent_thread' => 'Parent Thread',
            'content' => 'Content',
            'repdate' => 'Repdate',
            'reptime' => 'Reptime',
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

    /**
     * Gets query for [[ParentThread]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentThread()
    {
        return $this->hasOne(Thread::className(), ['threadID' => 'parent_thread']);
    }
}
