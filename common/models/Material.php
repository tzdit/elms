<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $material_ID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string $title
 * @property string $material_type
 * @property string $upload_date
 * @property string $upload_time
 * @property string $fileName
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID'], 'integer'],
            [['title', 'material_type', 'upload_date', 'upload_time', 'fileName'], 'required'],
            [['upload_date', 'upload_time'], 'safe'],
            [['course_code'], 'string', 'max' => 7],
            [['title'], 'string', 'max' => 100],
            [['material_type'], 'string', 'max' => 15],
            [['fileName'], 'string', 'max' => 20],
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
            'material_ID' => 'Material ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'material_type' => 'Material Type',
            'upload_date' => 'Upload Date',
            'upload_time' => 'Upload Time',
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
}
