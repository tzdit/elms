<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ext_assess".
 *
 * @property int $assessID
 * @property int|null $instructorID
 * @property string|null $reg_no
 * @property string|null $course_code
 * @property string $title
 * @property int $total_marks
 * @property float $score
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property Student $regNo
 */
class ExtAssess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ext_assess';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'total_marks'], 'integer'],
            [['title', 'total_marks', 'score'], 'required'],
            [['score'], 'number'],
            [['reg_no', 'title'], 'string', 'max' => 20],
            [['course_code'], 'string', 'max' => 7],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
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
            'assessID' => 'Assess ID',
            'instructorID' => 'Instructor ID',
            'reg_no' => 'Reg No',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'total_marks' => 'Total Marks',
            'score' => 'Score',
        ];
    }

    /**
     * Gets query for [[CourseCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode()
    {
        return $this->hasOne(Course::className(), ['course_code' => 'course_code']);
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
