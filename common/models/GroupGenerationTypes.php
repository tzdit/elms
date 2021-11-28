<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_generation_types".
 *
 * @property int $typeID
 * @property string $generation_type
 * @property int $max_groups_members
 * @property string $course_code
 * @property string $creator_type
 * @property int|null $instructorID
 * @property string|null $reg_no
 * @property string|null $created_date
 * @property string|null $created_time
 * @property int $yearID
 *
 * @property GroupGenerationAssignment[] $groupGenerationAssignments
 * @property Course $courseCode
 * @property Course $courseCode0
 * @property Student $regNo
 * @property Instructor $instructor
 * @property Groups[] $groups
 */
class GroupGenerationTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_generation_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['generation_type', 'max_groups_members', 'course_code', 'creator_type', 'yearID'], 'required'],
            [['max_groups_members', 'instructorID', 'yearID'], 'integer'],
            [['created_date', 'created_time'], 'safe'],
            [['generation_type'], 'string', 'max' => 100],
            [['course_code'], 'string', 'max' => 10],
            [['creator_type'], 'string', 'max' => 20],
            [['reg_no'], 'string', 'max' => 30],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'typeID' => 'Type ID',
            'generation_type' => 'Generation Type',
            'max_groups_members' => 'Max Groups Members',
            'course_code' => 'Course Code',
            'creator_type' => 'Creator Type',
            'instructorID' => 'Instructor',
            'reg_no' => 'Reg No',
            'created_date' => 'Created Date',
            'created_time' => 'Created Time',
            'yearID' => 'Academic Year',
        ];
    }

    /**
     * Gets query for [[GroupGenerationAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationAssignments()
    {
        return $this->hasMany(GroupGenerationAssignment::className(), ['gentypeID' => 'typeID']);
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
     * Gets query for [[CourseCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode0()
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
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['generation_type' => 'typeID']);
    }
}
