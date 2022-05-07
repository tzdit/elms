<?php

namespace frontend\controllers;

use common\models\ForumAnswer;
use common\models\ForumComment;
use common\models\ForumQuestion;
use frontend\models\ForumQuestionForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use frontend\models\ClassRoomSecurity;
use Yii;
use yii\helpers\HtmlPurifier;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use function React\Promise\all;

class ForumController extends \yii\web\Controller
{

    //public $layout = 'student';
    public $defaultAction = '/student/dashboard';


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['dashboard', 'index', 'add-thread','edit-thread','my-thread', 'delete-forum-qn','qn-conversation'
                        ],


                        'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                    [
                        'actions' => ['dashboard', 'index', 'add-thread','edit-thread','my-thread', 'delete-forum-qn','qn-conversation'
                        ],


                        'allow' => true,
                        'roles'=>['INSTRUCTOR']
                    ],
                    [
                        'actions' => ['dashboard', 'index', 'add-thread','edit-thread','my-thread', 'delete-forum-qn','qn-conversation'
                        ],


                        'allow' => true,
                        'roles'=>['INSTRUCTOR & HOD']
                    ],
                    [
                        'actions' => [  'logout' => ['post'],],


                        'allow' => true,
                        'roles'=>['?']
                    ],




                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],

        ];

    }



    public function actionIndex($cid)
    {
        $reg_no = Yii::$app->user->identity->username;
        $forumTopics = ForumQuestion::find()->select('forum_question.*,forum_qn_tag.*')->join('INNER JOIN','forum_qn_tag','forum_question.question_id = forum_qn_tag.question_id')->where('forum_qn_tag.course_code = :cid',[':cid' => ClassRoomSecurity::decrypt($cid)])->orderBy(['forum_question.time_add' => SORT_DESC])->asArray()->all();
        return $this->render('index', ['cid'=>ClassRoomSecurity::decrypt($cid), 'topics' => $forumTopics]);
    }

    public function actionAddThread()
    {
        $model = new ForumQuestionForm();

        if ($model->load(Yii::$app->request->post())) {

            $imageInstance = UploadedFile::getInstance($model,'image');
            $model->imageSave = $imageInstance;

            if (!$model->validate() && $model->addThread() == false){
                Yii::$app->session->setFlash('error', 'Question add failed');
                return $this->redirect(Yii::$app->request->referrer);
            }

            $returned=$model->addThread();

            if(empty($returned))
            {

                Yii::$app->session->setFlash('success', 'Question add successfully');
                return $this->redirect(Yii::$app->request->referrer);
            }
            else{

                $errors="Error(s) detected during assigning:";
                foreach($returned as $courses=>$error)
                {
                    $errors.="<br>".$courses.": ".$error;
                }
                Yii::$app->session->setFlash('success',$errors);
                return $this->redirect(Yii::$app->request->referrer);
            }

        }

        return $this->render('thread_form', [
            'model' => $model,
        ]);
    }



    public function actionEditThread($id)
    {
        $model = ForumQuestion::findOne(ClassRoomSecurity::decrypt($id));

        if ($model->load(Yii::$app->request->post() && $model->update())) {

                Yii::$app->session->setFlash('error', 'Question added failed');
                return $this->redirect(Yii::$app->request->referrer);

        }

        return $this->render('edit_thread_form', [
            'model' => $model,
        ]);
    }




    public function actionMyThread($cid)
    {
        $cid = ClassRoomSecurity::decrypt($cid);
        $reg_no = Yii::$app->user->identity->getId();

        $forumTopics = ForumQuestion::find()->select('forum_question.*,forum_qn_tag.*')->join('INNER JOIN','forum_qn_tag','forum_question.question_id = forum_qn_tag.question_id')->where('forum_qn_tag.course_code = :cid AND forum_question.user_id = :reg_no',[':cid' => $cid, ':reg_no' => $reg_no])->orderBy(['forum_question.time_add' => SORT_DESC])->asArray()->all();
        return $this->render('my_thread', ['cid'=>$cid, 'topics' => $forumTopics]);
    }


    /**
     * @return string
     */
    public function actionQnConversation($question_id, $cid){

        $question_id = ClassRoomSecurity::decrypt($question_id);
        $cid = ClassRoomSecurity::decrypt($cid);

        $model = new ForumAnswer();
        $model1 = new ForumComment();
        $purifier = new HtmlPurifier();
        $question = ForumQuestion::find()->select('forum_question.*,forum_qn_tag.*')->join('INNER JOIN','forum_qn_tag','forum_question.question_id = forum_qn_tag.question_id')->where('forum_question.question_id = :question_id ',[':question_id' => $question_id])->orderBy(['forum_question.time_add' => SORT_ASC])->asArray()->one();
        $answers = ForumAnswer::find()->select('forum_answer.*')->where('forum_answer.question_id = :question_id ',[':question_id' => $question_id])->orderBy(['forum_answer.time_added' => SORT_DESC])->asArray()->all();
        $answer_counts = ForumAnswer::find()->select('forum_answer.*')->where('forum_answer.question_id = :question_id ',[':question_id' => $question_id])->count();


        if ($model->load(Yii::$app->request->post())){

            $imageSave = UploadedFile::getInstance($model,'image');

            if (!is_null($imageSave)) {
                // generate a unique file name to prevent duplicate filenames
                $fileImageName = Yii::$app->security->generateRandomString(13).'.'.$imageSave->extension;
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/img/';
                $path = Yii::$app->params['uploadPath'] . $fileImageName;
                $imageSave->saveAs($path);
            }

           $model->answer_content = $model->answer_content;
           date_default_timezone_set('Africa/Dar_es_Salaam');
           $model->time_added = date('Y-m-d H:i:s');
           $model->user_id = Yii::$app->user->identity->getId();
           $model->question_id = $question_id;
           $model->code = $purifier->process($model->code);

           if (empty($fileImageName)){
               $fileImageName = "";
           }
           $model->fileName = $fileImageName;


           if ($model->save()){
               Yii::$app->session->setFlash('success', 'Answer submitted successfully');
               return $this->refresh();
           }

           else{
               Yii::$app->session->setFlash('error', 'Answer submitted fail');
               return $this->refresh();
           }


        }


        if ($model1->load(Yii::$app->request->post())){
            $model1->comment_content = $model1->comment_content;
            $model1->comment_type = 1;
            date_default_timezone_set('Africa/Dar_es_Salaam');
            $model1->time_added = date('Y-m-d H:i:s');
            $model1->user_id = Yii::$app->user->identity->getId();
            $model1->answer_id = $model1->answer_id;


            if ($model1->save()){
                Yii::$app->session->setFlash('success', 'Comment added successfully');
                return $this->refresh();
            }

            else{
                Yii::$app->session->setFlash('error', 'comment added fail');
                return $this->refresh();
            }


        }

        return $this->render('qn_conversation', ['cid'=>$cid, 'question' => $question,'answers' => $answers, 'answer_counts' => $answer_counts, 'model' => $model, 'model1' => $model1]);
    }




    /**
     * Deletes an existing forum question.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteForumQn()
    {
        if(Yii::$app->request->isAjax){


            $question_id = Yii::$app->request->post('question_id');
            $question_deleted =  $this->findModel($question_id)->delete();

            if($question_deleted){
                return $this->asJson(['message'=>'Question Deleted']);
            }
            else{
                return $this->asJson(['message'=>'Question Delete Failed!']);
            }
        }

    }


    /**
     * Finds the forum question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param $question_id
     * @return ForumQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($question_id)
    {

        if (($model = ForumQuestion::find()->where('question_id = :question_id',[':question_id' => $question_id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'No such question'));
    }



}
