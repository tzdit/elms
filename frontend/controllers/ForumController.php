<?php

namespace frontend\controllers;

use common\models\ForumAnswer;
use common\models\ForumComment;
use common\models\ForumQuestion;
use frontend\models\ForumQuestionForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\web\NotFoundHttpException;
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

        $forumTopics = ForumQuestion::find()->select('forum_question.*,forum_qn_tag.*')->join('INNER JOIN','forum_qn_tag','forum_question.question_id = forum_qn_tag.question_id')->where('forum_qn_tag.course_code = :cid',[':cid' => $cid])->orderBy(['forum_question.time_add' => SORT_ASC])->asArray()->all();
        return $this->render('index', ['cid'=>$cid, 'topics' => $forumTopics]);
    }

    public function actionAddThread()
    {
        $model = new ForumQuestionForm();

        if ($model->load(Yii::$app->request->post())) {


            if (!$model->validate() && $model->addThread() == false){
                Yii::$app->session->setFlash('error', 'Question added failed');
                return $this->redirect(Yii::$app->request->referrer);
            }

            $returned=$model->addThread();

            if(empty($returned))
            {

                Yii::$app->session->setFlash('success', 'Question added successfully');
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
        $model = ForumQuestion::findOne($id);

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
        $reg_no = Yii::$app->user->identity->getId();

        $forumTopics = ForumQuestion::find()->select('forum_question.*,forum_qn_tag.*')->join('INNER JOIN','forum_qn_tag','forum_question.question_id = forum_qn_tag.question_id')->where('forum_qn_tag.course_code = :cid AND forum_question.user_id = :reg_no',[':cid' => $cid, ':reg_no' => $reg_no])->orderBy(['forum_question.time_add' => SORT_ASC])->asArray()->all();
        return $this->render('my_thread', ['cid'=>$cid, 'topics' => $forumTopics]);
    }


    /**
     * @return string
     */
    public function actionQnConversation($question_id, $cid){

        $model = new ForumAnswer();
        $model1 = new ForumComment();
        $question = ForumQuestion::find()->select('forum_question.*,forum_qn_tag.*')->join('INNER JOIN','forum_qn_tag','forum_question.question_id = forum_qn_tag.question_id')->where('forum_question.question_id = :question_id ',[':question_id' => $question_id])->orderBy(['forum_question.time_add' => SORT_ASC])->asArray()->one();
        $answers = ForumAnswer::find()->select('forum_answer.*')->where('forum_answer.question_id = :question_id ',[':question_id' => $question_id])->orderBy(['forum_answer.time_added' => SORT_DESC])->asArray()->all();


        if ($model->load(Yii::$app->request->post())){
           $model->answer_content = $model->answer_content;
           $model->time_added = date('Y-m-d H:i:s');
           $model->user_id = Yii::$app->user->identity->getId();
           $model->question_id = $question_id;


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

        return $this->render('qn_conversation', ['cid'=>$cid, 'question' => $question,'answers' => $answers, 'model' => $model, 'model1' => $model1]);
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
                return $this->asJson(['message'=>'Question Deleted Fail!!!!']);
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
