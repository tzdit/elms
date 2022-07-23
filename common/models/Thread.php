<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "thread".
 *
 * @property int $threadID
 * @property string|null $reg_no
 * @property int|null $instructorID
 * @property string $starter_type
 *
 * @property FreshThread[] $freshThreads
 * @property RepThread[] $repThreads
 * @property RepThread[] $repThreads0
 * @property Instructor $instructor
 * @property Student $regNo
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thread';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID'], 'integer'],
            [['starter_type'], 'required'],
            [['reg_no'], 'string', 'max' => 20],
            [['starter_type'], 'string', 'max' => 10],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'threadID' => 'Thread ID',
            'reg_no' => 'Reg No',
            'instructorID' => 'Instructor ID',
            'starter_type' => 'Starter Type',
        ];
    }

    /**
     * Gets query for [[FreshThreads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFreshThreads()
    {
        return $this->hasMany(FreshThread::className(), ['threadID' => 'threadID']);
    }

    /**
     * Gets query for [[RepThreads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepThreads()
    {
        return $this->hasMany(RepThread::className(), ['threadID' => 'threadID']);
    }

    /**
     * Gets query for [[RepThreads0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepThreads0()
    {
        return $this->hasMany(RepThread::className(), ['parent_thread' => 'threadID']);
    }

    /**
     * Gets query for [[Instructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructor()
    {
        return $this->hasOne(Instructor::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }
}
