<?php

namespace frontend\models;

use common\models\User;
use common\models\ForumQnTag;
use common\models\ForumQuestion;
use yii\helpers\HtmlPurifier;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;


class ForumQuestionForm extends Model
{
    public $question_tittle;
    public $question_desc;
    public $coursesTag;
    public $fileImage;
    public $image;
    public $code;
    public $fileName;
    public $imageSave;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_tittle', 'question_desc', 'coursesTag'], 'required'],
            [['question_desc','code'], 'string'],
            ['image','file','extensions'=>['jpg','jpeg','png']],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['question_tittle'], 'string', 'max' => 150]
        ];
    }


    /**
     * {@inheritdoc}
     * @throws NotFoundHttpException
     */
    public function addThread()
    {

        if (!$this->validate()) {
            return false;
        }


        /* save the new thread to the database */
        $transaction = Yii::$app->db->beginTransaction();
        try{

            $question = new ForumQuestion();
            $purifier = new HtmlPurifier();
            if (!is_null($this->imageSave)) {
                // generate a unique file name to prevent duplicate filenames
                $this->fileName = Yii::$app->security->generateRandomString(13).'.'.$this->imageSave->extension;
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/img/';
                $path = Yii::$app->params['uploadPath'] . $this->fileName;
                $this->imageSave->saveAs($path);
            }
            date_default_timezone_set('Africa/Dar_es_Salaam');
            $question->time_add = date('Y-m-d H:i:s');
            $question->question_tittle = $this->question_tittle;
            $question->question_desc = $this->question_desc;
            $question->user_id = Yii::$app->user->identity->getId();
            $question->code = $purifier->process($this->code);
            $question->fileName = $this->fileName;
                if($question->save()){

                    $questionId = $question->question_id;
                    $courseArray = $this->coursesTag;
//                            echo '<pre>';
//                            print_r($courseArray);
//                            die();
//                            echo  '</pre>';
                    $errors=[];
                   foreach ($courseArray as $i => $course_code)
                    {
                        $questionTag = new ForumQnTag();
                        $questionTag->course_code = $course_code;
                        $questionTag->question_id = $questionId;



                        if(!$questionTag->save()){

                            $errors[$course_code]=!empty($questionTag->getErrors()['tag_id'])?$questionTag->getErrors()['tag_id'][0]:" ";
                            continue;

                        }
//                        else {
//                    echo "MODEL NOT SAVED";
//                    print_r($questionTag->getAttributes());
//                    print_r($questionTag->getErrors());
//                    exit;
//                }

                    }

                   $transaction->commit();
                    return $errors;
                }
//                else {
//                    echo "MODEL NOT SAVED";
//                    print_r($question->getAttributes());
//                    print_r($question->getErrors());
//                    exit;
//                }
        }catch(\Throwable $e){

            $transaction->rollBack();
            throw new NotFoundHttpException('Failed to add question');
        }
        return false;
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
