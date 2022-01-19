<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forum_qn_tag".
 *
 * @property int $tag_id
 * @property string $course_code
 * @property int $question_id
 *
 * @property Course $courseCode
 * @property ForumQuestion $question
 */
class ForumQnTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forum_qn_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code', 'question_id'], 'required'],
            [['question_id'], 'integer'],
            [['course_code'], 'string', 'max' => 20],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestion::className(), 'targetAttribute' => ['question_id' => 'question_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'course_code' => 'Course Code',
            'question_id' => 'Question ID',
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
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(ForumQuestion::className(), ['question_id' => 'question_id']);
    }
}
