<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "q_marks".
 *
 * @property int $qmarks_id
 * @property int $quiz_id
 * @property string $regno
 * @property float|null $q_score
 * @property string|null $comment
 */
class QMarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'q_marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'regno'], 'required'],
            [['quiz_id'], 'integer'],
            [['q_score'], 'number'],
            [['regno'], 'string', 'max' => 15],
            [['comment'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qmarks_id' => 'Qmarks ID',
            'quiz_id' => 'Quiz ID',
            'regno' => 'Regno',
            'q_score' => 'Q Score',
            'comment' => 'Comment',
        ];
    }
}
