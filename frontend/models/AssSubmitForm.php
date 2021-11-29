<?php

namespace frontend\models;

use Yii;
use common\models\Assignment;
use common\models\Student;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "submit".
 *
 * @property int $submitID
 * @property string|null $reg_no
 * @property int|null $assID
 * @property string $fileName
 * @property float|null $score
 * @property string $submit_date
 * @property string $submit_time
 * @property string|null $comment
 *
 * @property QMarks[] $qMarks
 * @property Assignment $ass
 * @property Student $regNo
 */
class AssSubmitForm extends \yii\db\ActiveRecord
{

    /**
     * document variable
     */
    public $document;

    /**
     * document variable
     */
    public $assinmentId;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'submit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assID'], 'integer'],
            [['fileName'], 'required'],
            [['score'], 'number'],
            [['submit_date', 'submit_time'], 'safe'],
            [['fileName'], 'string', 'max' => 225],
            [['reg_no',], 'string', 'max' => 20],
            [['comment'], 'string', 'max' => 200],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
            [['document'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,doc,xls,xlsx,docx,pptx,ppt,rtf,odt,txt,pkt,zip,rar','message' => 'file type not allowed'],
            [['document'], 'file','maxSize' => 1024 * 1024 * 10 ,'message' => 'exceed maximum file size'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'submitID' => 'Submit ID',
            'reg_no' => 'Reg No',
            'assID' => 'Ass ID',
            'fileName' => 'File Name',
            'score' => 'Score',
            'submit_date' => 'Submit Date',
            'submit_time' => 'Submit Time',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[QMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQMarks()
    {
        return $this->hasMany(QMarks::className(), ['submitID' => 'submitID']);
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
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }

    public function save($runValidation = true, $attributeNames = null){

        $this->assID = $this->assinmentId;
        $this->submit_date = date('Y-m-d');
        $this->submit_time = date('H:i:s');
        $this->reg_no = Yii::$app->user->identity->username;
        $this->fileName = Yii::$app->security->generateRandomString(13).'.'.$this->document->extension;


         $saved =  parent::save($runValidation, $attributeNames);

         if(!$saved)
         {

             return false;
         }

             $documentPath = Yii::getAlias('@frontend/web/storage/submit/'.$this->fileName );
//             die($documentPath);

             if(!is_dir(\dirname($documentPath))) {
                 FileHelper::createDirectory(\dirname($documentPath));
             }

             try {
                 $this->document->saveAs($documentPath);
             }
             catch (\Exception $e){
                 throw new NotFoundHttpException("fail to upload, Try to use another browser");
             }



        return true;
    }

    
}
