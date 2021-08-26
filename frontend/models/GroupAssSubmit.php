<?php

namespace frontend\models;

use Yii;
use common\models\Assignment;
use common\models\Groups;

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
class GroupAssSubmit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_assignment_submit';
    }

      /**
     * document variable
     */
    public $document;


    /**
     * document variable
     */
    public $assinmentId;

    /**
     * document variable
     */
    public $groupId;

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


    public function save($runValidation = true, $attributeNames = null){

        $isInsert = $this->isNewRecord;

        $this->assID = $this->assinmentId;
        $this->groupID = $this->groupId;
        $this->submit_date = date('Y-m-d');
        $this->submit_time = date('H:i:s');
        $this->fileName = Yii::$app->security->generateRandomString(6).$this->document->name;

        if($isInsert){
            
        }
         $saved =  parent::save($runValidation, $attributeNames);

         if(!$saved)
         {
             return false;
         }

         if($isInsert){
             $documentPath = Yii::getAlias('@frontend/web/storage/submit/'.$this->fileName );

             if(!is_dir(\dirname($documentPath))) {
                 FileHelper::createDirectory(\dirname($documentPath));
             }  

             $this->document->saveAs($documentPath);
        }


        return true;
    }

  
}
