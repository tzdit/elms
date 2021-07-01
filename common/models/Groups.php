<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $groupID
 * @property string $groupName
 * @property string|null $course_code
 * @property string|null $reg_no
 * @property int|null $instructorID
 * @property string|null $generation_type
 * @property string $creator_type
 * @property string $created_date
 * @property string $created_time
 *
 * @property GroupAssignment[] $groupAssignments
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property Student $regNo
 * @property StudentGroup[] $studentGroups
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupName', 'creator_type'], 'required'],
            [['instructorID'], 'integer'],
            [['created_date', 'created_time'], 'safe'],
            [['groupName', 'creator_type'], 'string', 'max' => 10],
            [['course_code'], 'string', 'max' => 7],
            [['reg_no'], 'string', 'max' => 20],
            [['generation_type'], 'string', 'max' => 100],
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
            'groupID' => 'Group ID',
            'groupName' => 'Group Name',
            'course_code' => 'Course Code',
            'reg_no' => 'Reg No',
            'instructorID' => 'Instructor ID',
            'generation_type' => 'Generation Type',
            'creator_type' => 'Creator Type',
            'created_date' => 'Created Date',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * Gets query for [[GroupAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupAssignments()
    {
        return $this->hasMany(GroupAssignment::className(), ['groupID' => 'groupID']);
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

    /**
     * Gets query for [[StudentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroups()
    {
        return $this->hasMany(StudentGroup::className(), ['groupID' => 'groupID']);
    }
}
