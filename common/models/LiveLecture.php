<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "live_lecture".
 *
 * @property int $lectureID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string $title
 * @property string $lectureDate
 * @property string $startTime
 * @property string $endTime
 * @property int|null $lateEntryMaxTime
 * @property string $status
 * @property int $yearID
 *
 * @property Lectureroominfo[] $lectureroominfos
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property Quiz[] $quizzes
 * @property StudentLecture[] $studentLectures
 */
class LiveLecture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'live_lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'lateEntryMaxTime', 'yearID'], 'integer'],
            [['title', 'lectureDate', 'startTime', 'endTime', 'status', 'yearID'], 'required'],
            [['lectureDate', 'startTime', 'endTime'], 'safe'],
            [['course_code'], 'string', 'max' => 7],
            [['title'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 10],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lectureID' => 'Lecture ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'lectureDate' => 'Lecture Date',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
            'lateEntryMaxTime' => 'Late Entry Max Time',
            'status' => 'Status',
            'yearID' => 'Year ID',
        ];
    }

    /**
     * Gets query for [[Lectureroominfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLectureroominfos()
    {
        return $this->hasMany(Lectureroominfo::className(), ['lectureID' => 'lectureID']);
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
     * Gets query for [[Quizzes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzes()
    {
        return $this->hasMany(Quiz::className(), ['lectureID' => 'lectureID']);
    }

    /**
     * Gets query for [[StudentLectures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentLectures()
    {
        return $this->hasMany(StudentLecture::className(), ['lectureID' => 'lectureID']);
    }
}
