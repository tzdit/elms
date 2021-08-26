<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_course".
 *
 * @property int $SC_ID
 * @property string|null $reg_no
 * @property string|null $course_code
 *
 * @property Course $courseCode
 * @property Student $regNo
 */
class StudentCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_no'], 'string', 'max' => 20],
            [['course_code'], 'string', 'max' => 7],
<<<<<<< HEAD
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
            [['reg_no'], 'default','value'=>Yii::$app->user->identity->username],
            ['course_code', 'unique'],
=======
            [['reg_no', 'course_code'], 'unique', 'targetAttribute' => ['reg_no', 'course_code'],'message'=>'you already have this course'],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
            [['reg_no'], 'default','value'=>Yii::$app->user->identity->username],
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
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
<<<<<<< HEAD
            'course_code' => 'Course Name',
=======
            'course_code' => 'Course Code',
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
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
<<<<<<< HEAD


  
=======
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
}
