<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $course_code
 * @property string $course_name
 * @property float $course_credit
 * @property int $course_semester
 * @property int|null $course_duration
 * @property string|null $course_status
 * @property int $departmentID
 * @property int $YOS
 *
 * @property Announcement[] $announcements
 * @property Assignment[] $assignments
 * @property Department $department
 * @property ExtAssess[] $extAssesses
 * @property GroupGenerationTypes[] $groupGenerationTypes
 * @property GroupGenerationTypes[] $groupGenerationTypes0
 * @property InstructorCourse[] $instructorCourses
 * @property LiveLecture[] $liveLectures
 * @property Material[] $materials
 * @property Module[] $modules
 * @property Notification[] $notifications
 * @property ProgramCourse[] $programCourses
 * @property StudentCourse[] $studentCourses
 * @property Student[] $regNos
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
            [['course_code', 'course_name', 'course_credit', 'course_semester', 'departmentID', 'YOS'], 'required'],
            [['course_credit'], 'number'],
            [['course_semester', 'course_duration', 'departmentID', 'YOS'], 'integer'],
            [['course_code'], 'string', 'max' => 7],
            [['course_name'], 'string', 'max' => 150],
            [['course_status'], 'string', 'max' => 10],
            [['course_code'], 'unique'],
            [['departmentID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departmentID' => 'departmentID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_code' => 'Course Code',
            'course_name' => 'Course Name',
            'course_credit' => 'Course Credit',
            'course_semester' => 'Course Semester',
            'course_duration' => 'Course Duration',
            'course_status' => 'Course Status',
            'departmentID' => 'Department ID',
            'YOS' => 'Yos',
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
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['departmentID' => 'departmentID']);
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
     * Gets query for [[GroupGenerationTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationTypes()
    {
        return $this->hasMany(GroupGenerationTypes::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[GroupGenerationTypes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationTypes0()
    {
        return $this->hasMany(GroupGenerationTypes::className(), ['course_code' => 'course_code']);
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
     * Gets query for [[Modules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(Module::className(), ['course_code' => 'course_code']);
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

    /**
     * Gets query for [[RegNos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNos()
    {
        return $this->hasMany(Student::className(), ['reg_no' => 'reg_no'])->viaTable('student_course', ['course_code' => 'course_code']);
    }
}
