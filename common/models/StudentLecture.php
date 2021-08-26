<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_lecture".
 *
 * @property int $SL_ID
 * @property string|null $reg_no
 * @property int|null $lectureID
 * @property string $participationStatus
 *
 * @property Student $regNo
 * @property LiveLecture $lecture
 */
class StudentLecture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lectureID'], 'integer'],
            [['participationStatus'], 'required'],
            [['reg_no'], 'string', 'max' => 20],
            [['participationStatus'], 'string', 'max' => 10],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
            [['lectureID'], 'exist', 'skipOnError' => true, 'targetClass' => LiveLecture::className(), 'targetAttribute' => ['lectureID' => 'lectureID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SL_ID' => 'Sl ID',
            'reg_no' => 'Reg No',
            'lectureID' => 'Lecture ID',
            'participationStatus' => 'Participation Status',
        ];
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

    /**
     * Gets query for [[Lecture]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLecture()
    {
        return $this->hasOne(LiveLecture::className(), ['lectureID' => 'lectureID']);
    }
}
