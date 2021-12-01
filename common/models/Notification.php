<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $notif_ID
 * @property string|null $course_code
 * @property string $title
 * @property string $content
 * @property string $notif_date
 * @property string $notif_time
 *
 * @property InstructorNotification[] $instructorNotifications
 * @property Course $courseCode
 * @property StudentNotification[] $studentNotifications
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
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
            [['title', 'content', 'notif_date', 'notif_time'], 'required'],
            [['notif_date', 'notif_time'], 'safe'],
            [['course_code'], 'string', 'max' => 7],
            [['title'], 'string', 'max' => 20],
            [['content'], 'string', 'max' => 100],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'notif_ID' => 'Notif ID',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'content' => 'Content',
            'notif_date' => 'Notif Date',
            'notif_time' => 'Notif Time',
        ];
    }

    /**
     * Gets query for [[InstructorNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructorNotifications()
    {
        return $this->hasMany(InstructorNotification::className(), ['notif_ID' => 'notif_ID']);
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
     * Gets query for [[StudentNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNotifications()
    {
        return $this->hasMany(StudentNotification::className(), ['notif_ID' => 'notif_ID']);
    }
}
