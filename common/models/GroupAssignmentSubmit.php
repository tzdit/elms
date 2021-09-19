<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_assignment_submit".
 *
 * @property int $submitID
 * @property int|null $groupID
 * @property int|null $assID
 * @property string $fileName
 * @property float|null $score
 * @property string $submit_date
 * @property string $submit_time
 * @property string|null $comment
 *
 * @property Groups $group
 * @property Assignment $ass
 * @property QMarks[] $qMarks
 */
class GroupAssignmentSubmit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_assignment_submit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupID', 'assID'], 'integer'],
            [['fileName'], 'required'],
            [['score'], 'number'],
            [['submit_date', 'submit_time'], 'safe'],
            [['fileName'], 'string', 'max' => 70],
            [['comment'], 'string', 'max' => 200],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupID' => 'groupID']],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'submitID' => 'Submit ID',
            'groupID' => 'Group ID',
            'assID' => 'Ass ID',
            'fileName' => 'File Name',
            'score' => 'Score',
            'submit_date' => 'Submit Date',
            'submit_time' => 'Submit Time',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID']);
    }

    /**
     * Gets query for [[Ass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAss()
    {
        return $this->hasOne(Assignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[QMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQMarks()
    {
        return $this->hasMany(QMarks::className(), ['group_submit_id' => 'submitID']);
    }
    public function isMarked()
    {
        if($this->score!="" || $this->score!=null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function isFailed()
    {
        if($this->score!="" || $this->score!=null)
        {
          
          $scoreoverfourty=($this->score*40)/$this->ass->total_marks;
          if($scoreoverfourty<15.5)
          {
              return true;
          }
          else
          {
              return false;
          }
            
        }
       
    }
}
