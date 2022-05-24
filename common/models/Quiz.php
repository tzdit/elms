<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;
use frontend\models\QuizManager;
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
 * @property int $num_questions
 * @property string $quiz_file
 * @property string $quiz_title
 * @property string $status
 * @property int $instructorID
 * @property int $yearID
 * @property Instructor $instructor
 * @property Course $courseCode
 * @property StudentQuiz[] $studentQuizzes
 */
class Quiz extends \yii\db\ActiveRecord
{
    public $startdate;
    public $starttime;
    public $enddate;
    public $endtime;
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
            [['course_code', 'total_marks', 'duration','viewAnswers','quiz_title', 'start_time', 'status', 'yearID','attempt_mode'], 'required'],
            [['total_marks', 'duration','num_questions', 'yearID'], 'integer'],
            [['date_created', 'start_time','enddate','endtime','startdate','starttime'], 'safe'],
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

    public function isAttemptingTimeOver()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $start=new \DateTime($this->start_time);
        $start->modify ("+20 minutes");
        $latestart=strtotime($start->format('Y-m-d H:i:s'));
        $now=strtotime(date('Y-m-d H:i:s'));

        return $now>$latestart;
    }
    public function hasStarted()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');

        $now=strtotime(date("Y-m-d H:i:s"));
        $start=strtotime($this->start_time);

        return $start<$now;
    }

    public function isReadyTaking()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');

        $now=strtotime(date("Y-m-d H:i:s"));
        $start=strtotime($this->start_time);

        return $start<=$now;
    }
    public function isSubmitted()
    {
        return (new StudentQuiz)->isSubmitted($this->quizID);
    }
    public function getScore()
    {
        if($this->isSubmitted())
        {
            return (new StudentQuiz)->getStudentScore($this->quizID);
        }

        return null;
    }

    public function updateQuiz()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $this->start_time=$this->startdate.' '.$this->starttime;
        $this->end_time=($this->attempt_mode=="individual")?$this->enddate.' '.$this->endtime:null;
        $this->date_created=date("Y-m-d H:i:s");
        $this->viewAnswers="off";
        if($this->attempt_mode=="individual")
        {
            $this->total_marks=$this->num_questions;
        }
       

        return $this->save();
    }
  

}
