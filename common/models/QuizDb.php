<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quiz_db".
 *
 * @property string $courseID
 * @property int $question_id
 * @property string $question
 * @property string $answer
 * @property string $option_one
 * @property string $option_two
 * @property string $option_three
 * @property string $option_four
 *
 * @property Course $course
 */
class QuizDb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_db';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseID', 'question', 'answer', 'option_one', 'option_two', 'option_three', 'option_four'], 'required'],
            [['courseID'], 'string', 'max' => 10],
            [['question'], 'string', 'max' => 50],
            [['answer', 'option_one', 'option_two', 'option_three', 'option_four'], 'string', 'max' => 15],
            [['courseID'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['courseID' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'courseID' => 'Course ID',
            'question_id' => 'Question ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'option_one' => 'a',
            'option_two' => 'b',
            'option_three' => 'c',
            'option_four' => 'd',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['course_code' => 'courseID']);
    }
}
