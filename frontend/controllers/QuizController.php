<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use common\models\User;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use Yii;
use yii\helpers\Url;
use common\helpers\Security;
use frontend\models\ClassRoomSecurity;
use yii\base\Exception;
use frontend\models\QuizManager;
use yii\web\UploadedFile;
use common\models\Quiz;
use common\models\StudentQuiz;



class QuizController extends \yii\web\Controller
{
    //public $layout = 'instructor';
       /**
     * {@inheritdoc}
     */
//################################# public $layout = 'admin'; #####################################

public $defaultAction = 'dashboard';
  public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                   
                            'class-quizes',
                            'new-quiz',
                            'questions-bank',
                            'questions-bank2',
                            'new-question',
                            'save-question',
                            'delete-question',
                            'create-quiz',
                            'delete-quiz',
                            'quiz-preview',
                            'scores-view',
                            'download-bank',
                            'questions-uploader',
                            'download-quiz-pdf',
                            'update-quiz'

                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR']
                       

                    ],
// ############################### THIS PART FOR 'INSTRUCTOR $ HOD ROLE' ######################################
                    [
                        'actions' => [
                          
                           'class-quizes',
                           'new-quiz',
                           'questions-bank',
                           'questions-bank2',
                           'save-question',
                           'delete-question',
                           'create-quiz',
                           'delete-quiz',
                           'quiz-preview',
                           'scores-view',
                           'download-bank',
                           'questions-uploader',
                           'download-quiz-pdf',
                           'update-quiz'
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR & HOD']
                        

                    ],
                    [
                        'actions' => [
                 
                            'logout',
                            'student-quizes',
                            'quiz-take',
                            'get-quiz-responses',
                            'update-quiz-timer'
                           
                           
                        ],
                        'allow' => true,
                        'roles' => ['STUDENT']
                        

                    ],
                    
                ],
            ],
             'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'dropcourse' => ['post'],
                ],
            ],
        ];
    }
    public function actionClassQuizes()
    {
        $course=yii::$app->session->get('ccode');
        $yearid=yii::$app->session->get('currentAcademicYear')->yearID;
        $quizzes=Quiz::find()->where(['course_code'=>$course,'yearID'=>$yearid])->orderBy(['quizID'=>SORT_DESC])->all();
        return $this->render('index',['quizzes'=>$quizzes]);
    }
    public function actionNewQuiz()
    {
        return $this->render('newquiz.php');
    }
    public function actionQuestionsBank()
    {
      $manager=new QuizManager();
      return $this->render('questionsBank');
    }
    public function actionQuestionsBank2()
    {
      return $this->render('questionsBank2');
    }

    //temporary

    public function actionNewQuestion()
    {
        return $this->render('newQuestion');
    }
    public function actionSaveQuestion()
    {
        $data=yii::$app->request->post();
      
        $data['optionImage']=UploadedFile::getInstancesByName('optionImage');
        $data['questionImage']=UploadedFile::getInstancesByName('questionImage');
        $manager=new QuizManager($data);
       
        try
        {
            if($manager->questionSave())
            {
              yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Question Added Successfully !");
              return $this->redirect(yii::$app->request->referrer); 
            } 
           
        }
        catch(\Exception $q)
        {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Could Not Add Question, Try Again Later !");
            return $this->redirect(yii::$app->request->referrer) ;
           
        }
      
    }
    public function actionDeleteQuestion()
    {
     $question=yii::$app->request->post("question");

     if((new QuizManager)->deleteQuestion($question))
     {
         return $this->asJson(["message"=>"Question Deleted Successfully !"]);
     }
    }

    public function actionCreateQuiz()
    {
        try
        {
         if((new QuizManager)->saveQuiz(yii::$app->request->post()))
         {
             yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Quiz Created And Announced successfully !");
             return $this->redirect(yii::$app->request->referrer);
         }
        }
        catch(Exception $w)
        {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Quiz creation failed! ".$w->getMessage());
            return $this->redirect(yii::$app->request->referrer);
        }
      
    }

    public function actionDeleteQuiz()
    {
     $question=yii::$app->request->post("quiz");
      
     try
     {
     if((new QuizManager)->deleteQuiz($question))
     {
         return $this->asJson(["message"=>"success"]);
     }
    }
    catch(Exception $q)
    {
        return $this->asJson(["message"=>"Quiz Deleting Failed !".$q->getMessage()]);  
    }
}

public function actionQuizPreview($quiz)
{
    try
    {
        $quiz=ClassRoomSecurity::decrypt($quiz);
        $quiz=Quiz::findOne($quiz);
        $quiz_title=($quiz!=null)?$quiz->quiz_title:null;
        $quizdata=(new QuizManager)->quizReader($quiz);
        return $this->render('quizPreview',['quizdata'=>$quizdata,'title'=>$quiz_title,'quiz'=>$quiz->quizID]);
    }
    catch(Exception $e)
    {
        yii::$app->session->setFlash('error','<i class="fa fa-exclamation-triangle"></i> Unable to Preview Quiz, Try Again Later!');
        return $this->redirect(yii::$app->request->referrer);
    }
    

   
}

public function actionScoresView($quiz)
{
    $quiz=ClassRoomSecurity::decrypt($quiz);
    $scores=StudentQuiz::find()->where(['quizID'=>$quiz])->all();

    return $this->render('quizScores',['scores'=>$scores]);
}  

public function actionDownloadBank()
{
    (new QuizManager)->downloadPDFbank($this->renderPartial("questionsBank2pdf"));
}

public function actionQuestionsUploader()
{
   try
   {
        $num_added=(new quizManager)->questionsUploader(UploadedFile::getInstancesByName("questionsfile")[0]);
     
         yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> ".$num_added." Question(s) Uploaded To The Bank Successfully !");
         return $this->redirect(yii::$app->request->referrer);

   }
   catch(Exception $b)
   {
    yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Could Not Upload Questions !".$b->getMessage());
    return $this->redirect(yii::$app->request->referrer);
   }
     
    
}

public function actionStudentQuizes()
{
    $course=yii::$app->session->get('ccode');
    $yearid=yii::$app->session->get('currentAcademicYear')->yearID;
    $quizzes=Quiz::find()->where(['course_code'=>$course,'yearID'=>$yearid])->orderBy(['quizID'=>SORT_DESC])->all();
    return $this->render('studentQuizzes',['quizzes'=>$quizzes]);
}
public function actionQuizTake($quiz)
{
  $quiz=ClassRoomSecurity::decrypt($quiz);
  try
  {
    $quizdata=(new QuizManager)->getQuizData($quiz);
    return $this->render('quizBoard',['quizdata'=>$quizdata,'title'=>Quiz::findOne($quiz)->quiz_title,'total_marks'=>Quiz::findOne($quiz)->total_marks,'registered'=>(new QuizManager)->registerStudent($quiz),'quiz'=>$quiz,'inititalTimer'=>(new QuizManager)->timer($quiz)]);
  }
  catch(Exception $q)
  {
     yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Could Not Load Quiz !".$q->getMessage());
     return $this->redirect(yii::$app->request->referrer); 
  }
  
}

public function actionGetQuizResponses()
{
    //print_r(yii::$app->request->post());
    try
    {
    $res=(new Quizmanager)->markQuiz(yii::$app->request->post());

    return $this->asJson(["score"=>json_encode($res)]);
    }
    catch(Exception $s)
    {
        return $this->asJson(["failed"=>$s->getMessage()]);  
    }
}

public function actionUpdateQuizTimer()
{
    $quiz=yii::$app->request->post('quiz');

    return $this->asJson(['time'=>(new QuizManager)->timer($quiz)]);
}
public function actionDownloadQuizPdf($quiz)
{
        $quiz=ClassRoomSecurity::decrypt($quiz);
        $quiz=Quiz::findOne($quiz);
        $quiz_title=($quiz!=null)?$quiz->quiz_title:null;
        $quizdata=(new QuizManager)->quizReader($quiz);
        (new QuizManager)->downloadPDFQuiz($this->renderPartial("quiz2pdf",['quizdata'=>$quizdata,'title'=>$quiz_title]));
}

public function actionUpdateQuiz($quiz)
{

    $quizid=ClassRoomSecurity::decrypt($quiz);
    $quiz=(Quiz::findOne($quizid)!=null)?Quiz::findOne($quizid):new Quiz;

    //print_r($quiz);return false;

    if(Yii::$app->request->isPost)
    {
        
        if($quiz->load(yii::$app->request->post()))
        {
            if($quiz->updateQuiz())
            {
                yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Quiz Updated Successfully !");
                return $this->redirect(yii::$app->request->referrer);
            }
            else
            {
                yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Quiz Updating failed !");
                return $this->redirect(yii::$app->request->referrer);  
            }
        }
        else
        {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Quiz Updating failed !");
            return $this->redirect(yii::$app->request->referrer);  
        }

    }

    return $this->render("updateQuiz",['quiz'=>$quiz]);
}


}
