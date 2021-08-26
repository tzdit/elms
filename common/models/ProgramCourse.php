<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "program_course".
 *
 * @property int $PC_ID
 * @property string|null $course_code
 * @property string|null $programCode
 *
 * @property Course $courseCode
 * @property Program $programCode0
 */
class ProgramCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code'], 'string', 'max' => 7],
            [['programCode'], 'string', 'max' => 10],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['programCode'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['programCode' => 'programCode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PC_ID' => 'Pc ID',
            'course_code' => 'Course Code',
            'programCode' => 'Program Code',
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
     * Gets query for [[ProgramCode0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramCode0()
    {
        return $this->hasOne(Program::className(), ['programCode' => 'programCode']);
    }
}
