<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assignment".
 *
 * @property int $assID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string $assName
 * @property string|null $assType
 * @property string $assNature
 * @property string|null $ass_desc
 * @property string|null $submitMode
 * @property string|null $startDate
 * @property string|null $finishDate
 * @property int|null $total_marks
 * @property string|null $fileName
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property Assq[] $assqs
 * @property GroupAssignment[] $groupAssignments
 * @property GroupGenerationAssignment[] $groupGenerationAssignments
 * @property StudentAssignment[] $studentAssignments
 * @property Submit[] $submits
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'total_marks'], 'integer'],
            [['assName', 'assNature'], 'required'],
            [['startDate', 'finishDate'], 'safe'],
            [['course_code'], 'string', 'max' => 7],
            [['assName'], 'string', 'max' => 100],
            [['assType'], 'string', 'max' => 15],
            [['assNature', 'submitMode'], 'string', 'max' => 10],
            [['ass_desc'], 'string', 'max' => 1000],
            [['fileName'], 'string', 'max' => 70],
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
            'assID' => 'Ass ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'assName' => 'Ass Name',
            'assType' => 'Ass Type',
            'assNature' => 'Ass Nature',
            'ass_desc' => 'Ass Desc',
            'submitMode' => 'Submit Mode',
            'startDate' => 'Start Date',
            'finishDate' => 'Finish Date',
            'total_marks' => 'Total Marks',
            'fileName' => 'File Name',
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
     * Gets query for [[Assqs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssqs()
    {
        return $this->hasMany(Assq::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[GroupAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupAssignments()
    {
        return $this->hasMany(GroupAssignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[GroupGenerationAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationAssignments()
    {
        return $this->hasMany(GroupGenerationAssignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[StudentAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentAssignments()
    {
        return $this->hasMany(StudentAssignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[Submits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmits()
    {
        return $this->hasMany(Submit::className(), ['assID' => 'assID']);
    }
}
