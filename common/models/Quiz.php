<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "quiz".
 *
 * @property int $quizID
 * @property int|null $lectureID
 * @property int $total_marks
 * @property int $duration
 * @property string $quiz_file
 * @property string $status
 *
 * @property LiveLecture $lecture
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
            [['lectureID', 'total_marks', 'duration'], 'integer'],
            [['total_marks', 'duration', 'quiz_file', 'status'], 'required'],
            [['quiz_file'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 10],
            [['lectureID'], 'exist', 'skipOnError' => true, 'targetClass' => LiveLecture::className(), 'targetAttribute' => ['lectureID' => 'lectureID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quizID' => 'Quiz ID',
            'lectureID' => 'Lecture ID',
            'total_marks' => 'Total Marks',
            'duration' => 'Duration',
            'quiz_file' => 'Quiz File',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Lecture]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLecture()
    {
        return $this->hasOne(LiveLecture::className(), ['lectureID' => 'lectureID']);
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
}
