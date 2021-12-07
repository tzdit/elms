<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forum_answer".
 *
 * @property int $answer_id
 * @property string $answer_content
 * @property string $time_added
 * @property int|null $user_id
 * @property int|null $question_id
 *
 * @property ForumQuestion $question
 * @property User $user
 * @property ForumComment[] $forumComments
 */
class ForumAnswer extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forum_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer_content', 'time_added'], 'required'],
            [['answer_content'], 'string'],
            [['time_added'], 'safe'],
            [['user_id', 'question_id'], 'integer'],
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
            'answer_id' => 'Answer ID',
            'answer_content' => 'Answer Content',
            'time_added' => 'Time Added',
            'user_id' => 'User ID',
            'question_id' => 'Question ID',
        ];
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

    /**
     * Gets query for [[ForumComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumComments()
    {
        return $this->hasMany(ForumComment::className(), ['answer_id' => 'answer_id']);
    }
}
