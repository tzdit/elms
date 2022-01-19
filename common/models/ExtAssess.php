<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "ext_assess".
 *
 * @property int $assessID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string $title
 * @property int $total_marks
 * @property string $date_created
 * @property int $yearID
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property StudentExtAssess[] $studentExtAssesses
 * @property Student[] $regNos
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
    
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'total_marks', 'yearID'], 'integer'],
            [['title', 'total_marks', 'yearID'], 'required'],
            [['date_created'], 'safe'],
            [['course_code'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 20],
            [['instructorID', 'total_marks', 'course_code', 'title'], 'unique', 'targetAttribute' => ['instructorID', 'total_marks', 'course_code', 'title']],
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
            'assessID' => 'Assess ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'total_marks' => 'Total Marks',
            'date_created' => 'Date Created',
            'yearID' => 'Year ID',
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
     * Gets query for [[StudentExtAssesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentExtAssesses()
    {
        return $this->hasMany(StudentExtAssess::className(), ['assessID' => 'assessID']);
    }

    /**
     * Gets query for [[RegNos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNos()
    {
        return $this->hasMany(Student::className(), ['reg_no' => 'reg_no'])->viaTable('student_ext_assess', ['assessID' => 'assessID']);
    }
}
