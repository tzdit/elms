<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_short_course".
 *
 * @property int $SC_ID
 * @property string|null $reg_no
 * @property string|null $course_code
 *
 * @property Course $courseCode
 * @property Student $regNo
 */
class StudentShortCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_short_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_no'], 'string', 'max' => 20],
            [['course_code'], 'string', 'max' => 7],
            [['reg_no', 'course_code'], 'unique', 'targetAttribute' => ['reg_no', 'course_code']],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SC_ID' => 'Sc ID',
            'reg_no' => 'Reg No',
            'course_code' => 'Course Code',
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
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }
}
