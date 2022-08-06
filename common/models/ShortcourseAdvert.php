<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shortcourse_advert".
 *
 * @property int $advID
 * @property string $course_code
 * @property string $title
 * @property string $description
 * @property string $deadlinedate
 * @property string $deadlinetime
 *
 * @property Course $courseCode
 */
class ShortcourseAdvert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shortcourse_advert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code', 'title', 'description', 'deadlinedate', 'deadlinetime'], 'required'],
            [['deadlinedate', 'deadlinetime'], 'safe'],
            [['course_code'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 100],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'advID' => 'Adv ID',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'description' => 'Description',
            'deadlinedate' => 'Deadline Date',
            'deadlinetime' => 'Deadline Time',
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
}
