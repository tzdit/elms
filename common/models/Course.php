<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $course_code
 * @property string $courseName
 * @property int $course_credit
 * @property int $course_semester
 * @property int|null $course_duration
 * @property string|null $course_status
 *
 * @property Announcement[] $announcements
 * @property Assignment[] $assignments
 * @property ExtAssess[] $extAssesses
 * @property Groups[] $groups
 * @property InstructorCourse[] $instructorCourses
 * @property LiveLecture[] $liveLectures
 * @property Material[] $materials
 * @property Notification[] $notifications
 * @property ProgramCourse[] $programCourses
 * @property StudentCourse[] $studentCourses
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code', 'courseName', 'course_credit', 'course_semester'], 'required'],
            [['course_credit', 'course_semester', 'course_duration'], 'integer'],
            [['course_code'], 'string', 'max' => 7],
            [['courseName'], 'string', 'max' => 150],
            [['course_status'], 'string', 'max' => 10],
            [['course_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_code' => 'Course Code',
            'courseName' => 'Course Name',
            'course_credit' => 'Course Credit',
            'course_semester' => 'Course Semester',
            'course_duration' => 'Course Duration',
            'course_status' => 'Course Status',
        ];
    }

    /**
     * Gets query for [[Announcements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncements()
    {
        return $this->hasMany(Announcement::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Assignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[ExtAssesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtAssesses()
    {
        return $this->hasMany(ExtAssess::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCreatedGroups()
    {
        return $this->hasMany(Groups::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[InstructorCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructorCourses()
    {
        return $this->hasMany(InstructorCourse::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[LiveLectures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLiveLectures()
    {
        return $this->hasMany(LiveLecture::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[ProgramCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramCourses()
    {
        return $this->hasMany(ProgramCourse::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[StudentCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['course_code' => 'course_code']);
    }
}
