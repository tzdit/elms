<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forum_comment".
 *
 * @property int $comment_id
 * @property string $comment_content
 * @property int $comment_type
 * @property string $time_added
 * @property int|null $user_id
 * @property int|null $question_id
 * @property int|null $answer_id
 *
 * @property ForumAnswer $answer
 * @property ForumQuestion $question
 * @property User $user
 */
class ForumComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forum_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_content', 'comment_type', 'time_added'], 'required'],
            [['comment_type', 'user_id', 'question_id', 'answer_id'], 'integer'],
            [['time_added'], 'safe'],
            [['comment_content'], 'string', 'max' => 300],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumAnswer::className(), 'targetAttribute' => ['answer_id' => 'answer_id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => ForumQuestion::className(), 'targetAttribute' => ['question_id' => 'question_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'comment_content' => 'Comment Content',
            'comment_type' => 'Comment Type',
            'time_added' => 'Time Added',
            'user_id' => 'User ID',
            'question_id' => 'Question ID',
            'answer_id' => 'Answer ID',
        ];
    }

    /**
     * Gets query for [[Answer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(ForumAnswer::className(), ['answer_id' => 'answer_id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
