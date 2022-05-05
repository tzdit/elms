<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "quiz".
 *
 * @property int $quizID
 * @property string $course_code
 * @property int $total_marks
 * @property int $duration
 * @property string $quiz_file
 * @property string|null $date_created
 * @property string $start_time
 * @property string $status
 * @property int $yearID
 *
 * @property Course $courseCode
 * @property StudentQuiz[] $studentQuizzes
 */
class Quiz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz';
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
            [['course_code', 'total_marks', 'duration', 'quiz_file', 'start_time', 'status', 'yearID'], 'required'],
            [['total_marks', 'duration', 'yearID'], 'integer'],
            [['date_created', 'start_time'], 'safe'],
            [['course_code'], 'string', 'max' => 20],
            [['quiz_file'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 10],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quizID' => 'Quiz ID',
            'course_code' => 'Course Code',
            'total_marks' => 'Total Marks',
            'duration' => 'Duration',
            'quiz_file' => 'Quiz File',
            'date_created' => 'Date Created',
            'start_time' => 'Start Time',
            'status' => 'Status',
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
     * Gets query for [[StudentQuizzes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentQuizzes()
    {
        return $this->hasMany(StudentQuiz::className(), ['quizID' => 'quizID']);
    }

    public function isNew()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $time=strtotime($this->date_created);
        $lastlogin=yii::$app->user->identity->last_login;
        $lastlogin=strtotime($lastlogin);

        return $lastlogin<$time;
    }
}
