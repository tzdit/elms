<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_quiz".
 *
 * @property int $SQ_ID
 * @property string|null $reg_no
 * @property int|null $quizID
 * @property float|null $score
 *
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'SQ_ID' => 'Sq ID',
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
}
