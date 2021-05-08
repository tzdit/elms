<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property int $annID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string $content
 * @property string $ann_date
 * @property string $ann_time
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 */
class Announcement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID'], 'integer'],
            [['content', 'ann_date', 'ann_time'], 'required'],
            [['ann_date', 'ann_time'], 'safe'],
            [['course_code'], 'string', 'max' => 7],
            [['content'], 'string', 'max' => 255],
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
            'annID' => 'Ann ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'content' => 'Content',
            'ann_date' => 'Ann Date',
            'ann_time' => 'Ann Time',
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
