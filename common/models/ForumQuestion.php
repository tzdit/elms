<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forum_question".
 *
 * @property int $question_id
 * @property string $question_tittle
 * @property string $question_desc
 * @property string $time_add
 * @property int $user_id
 * @property string $code
 * @property string $fileName
 *
 * @property ForumAnswer[] $forumAnswers
 * @property ForumComment[] $forumComments
 * @property ForumQnTag[] $forumQnTags
 * @property User $user
 */
class ForumQuestion extends \yii\db\ActiveRecord
{

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forum_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_tittle', 'question_desc', 'time_add', 'user_id'], 'required'],
            [['question_desc','code'], 'string'],
            [['time_add'], 'safe'],
            [['user_id'], 'integer'],
            [['fileName'], 'string', 'max' => 30],
            [['question_tittle'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'question_tittle' => 'Question Tittle',
            'question_desc' => 'Question Desc',
            'time_add' => 'Time Add',
            'user_id' => 'User ID',
            'code' => 'Code',
            'fileName'  => 'File Name'
        ];
    }

    /**
     * Gets query for [[ForumAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumAnswers()
    {
        return $this->hasMany(ForumAnswer::className(), ['question_id' => 'question_id']);
    }

    /**
     * Gets query for [[ForumComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumComments()
    {
        return $this->hasMany(ForumComment::className(), ['question_id' => 'question_id']);
    }

    /**
     * Gets query for [[ForumQnTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForumQnTags()
    {
        return $this->hasMany(ForumQnTag::className(), ['question_id' => 'question_id']);
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
