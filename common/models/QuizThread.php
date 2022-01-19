<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quiz_thread".
 *
 * @property int $quizID
 * @property string $quiz_name
 * @property int $numberQns
 * @property int $total_marks
 * @property int $duration
 * @property string $status
 * @property string|null $deadline
 */
class QuizThread extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_thread';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_name', 'numberQns', 'total_marks', 'duration', 'status'], 'required'],
            [['numberQns', 'total_marks', 'duration'], 'integer'],
            [['deadline'], 'safe'],
            [['quiz_name'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quizID' => 'Quiz ID',
            'quiz_name' => 'Quiz Name',
            'numberQns' => 'Number Qns',
            'total_marks' => 'Total Marks',
            'duration' => 'Duration',
            'status' => 'Status',
            'deadline' => 'Deadline',
        ];
    }
}
