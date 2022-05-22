<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "student_quiz".
 *
 * @property int $SQ_ID
 * @property string $reg_no
 * @property int $quizID
 * @property float|null $score
 * @property string|null $status
 * @property string $attempt_time
 * @property string|null $submit_time
 * @property Quiz $quiz
 * @property Student $regNo
 */
class StudentQuiz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_quiz';
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
            [['reg_no', 'quizID'], 'required'],
            [['quizID'], 'integer'],
            [['score'], 'number'],
            [['reg_no'], 'string', 'max' => 20],
            [['quizID'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quizID' => 'quizID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SQ_ID' => 'Sq  ID',
            'reg_no' => 'Reg No',
            'quizID' => 'Quiz ID',
            'score' => 'Score',
        ];
    }

    /**
     * Gets query for [[Quiz]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quiz::className(), ['quizID' => 'quizID']);
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

    public function isRegistered($student,$quiz)
    {
        $registered=$this->find()->where(["reg_no"=>$student,"quizID"=>$quiz])->one();

        return $registered!=null;
    }

    public function isSubmitted($quiz)
    {
        $student=yii::$app->user->identity->student->reg_no;
        $submitted=$this->find()->where(["reg_no"=>$student,"quizID"=>$quiz])->one();
        
        if($submitted==null){return false;}
        
        return $submitted->status=="submitted";
    }
    public function getStudentScore($quiz)
    {
        $student=yii::$app->user->identity->student->reg_no;
        $submitted=$this->find()->where(["reg_no"=>$student,"quizID"=>$quiz])->one();

        return $submitted->score;
    }
    public function isSubmitTimeOver($quiz,$submit_time)
    {
        $student=yii::$app->user->identity->student->reg_no;
        $registered=$this->find()->where(["reg_no"=>$student,"quizID"=>$quiz])->one();
        $attempt_time=null;
        $duration=$registered->quiz->duration;
        if($registered->quiz->attempt_mode=="massive")
        {
            $attempt_time=$registered->quiz->start_time;
        }
        else
        {
            $attempt_time=$registered->attempt_time;
        }
        $start=new \DateTime($attempt_time);
        $start->modify ("+{$duration} minutes");
        $legal_submitTime=strtotime($start->format('Y-m-d H:i:s'));
        $legal_submitTime=$legal_submitTime+20; // 20 seconds for submitting

        $submit_time=strtotime($submit_time);

        return $submit_time>$legal_submitTime;
    }
}
