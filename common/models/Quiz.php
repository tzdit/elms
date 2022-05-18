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
 * @property string $attempt_mode
 * @property int $duration
 * @property string|null $quiz_file
 * @property string $viewAnswers
 * @property string|null $date_created
 * @property string $start_time
 * @property string|null $end_time
 * @property int|null $num_questions
 * @property string $quiz_file
 * @property string $status
 * @property int $instructorID
 * @property int $yearID
 * @property Instructor $instructor
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
            [['course_code', 'total_marks', 'duration','viewAnswers', 'start_time', 'status', 'yearID','attempt_mode'], 'required'],
            [['total_marks', 'duration', 'yearID'], 'integer'],
            [['date_created', 'start_time'], 'safe'],
            [['course_code'], 'string', 'max' => 20],
            [['attempt_mode'], 'string', 'max' => 15],
            [['quiz_file'], 'string', 'max' => 25],
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

    public function getInstructor()
    {
        return $this->hasOne(Instructor::className(), ['instructorID' => 'instructorID']);
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
    public function isExpired()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $now=strtotime(date("Y-m-d H:i:s"));
        if($this->attempt_mode=="individual")
        {
        $end=strtotime($this->end_time);
        return $end<$now;
        }
        else
        {
           

            $start=new \DateTime($this->start_time);
            $start->modify ("+{$this->duration} minutes");
            $end=strtotime($start->format('Y-m-d H:i:s'));
           

            return $end<$now; 
        }

       
    }
    public function hasStarted()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');

        $now=strtotime(date("Y-m-d H:i:s"));
        $start=strtotime($this->start_time);

        return $start<$now;
    }
}
