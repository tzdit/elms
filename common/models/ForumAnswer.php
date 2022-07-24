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
 * @property string $code
 * @property string $fileName
 *
 * @property ForumQuestion $question
 * @property User $user
 * @property ForumComment[] $forumComments
 */
class ForumAnswer extends \yii\db\ActiveRecord
{

    public $image;
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
            [['answer_content','code'], 'string'],
            [['time_added'], 'safe'],
            [['user_id', 'question_id'], 'integer'],
            [['fileName'], 'string', 'max' => 30],
            ['image','file','extensions'=>['jpg','jpeg','png']],
            [['image'], 'file', 'maxSize'=>'100000'],
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
            'code' => 'Code',
            'fileName'  => 'File Name'
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

    public function isNew()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $time=strtotime($this->time_added);
        $lastlogin=yii::$app->user->identity->last_login;
        $lastlogin=strtotime($lastlogin);

        return $lastlogin<$time;
    }

    
    public function newComments()
    {
        $comments=$this->forumComments;

        foreach($comments as $key=>$comment)
        {
            if(!$comment->isNew())
            {
              unset($comments[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($comments);
    }

  
}
