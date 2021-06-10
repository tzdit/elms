<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Material;
use common\models\InstructorCourse;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\Security;

class InstructorController extends \yii\web\Controller
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
                            'dashboard',
                            'courses',
                            'enroll-course',
                            'dropcourse',
                            'classwork',
                            'upload-assignment',
                            'upload-tutorial',
                            'upload-lab',
                            'upload-material',
                            'assignments',
                            'materials',
                            'stdwork'
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR']

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


    public function actionDashboard()
    {
   $courses = Yii::$app->user->identity->instructor->courses;
        return $this->render('index', ['courses'=>$courses]);
    }



    //#################### function to render instructor courses ##############################

    public function actionCourses(){
        $courses = Course::find()->where(['course_semester'=>1])->all();

        return $this->render('courses', ['courses'=>$courses]);
        
    }
 

 
   


//###################function to enroll courses for instructor #############################

    public function actionEnrollCourse(){
        if(Yii::$app->request->isPost){
        if(Yii::$app->request->post('ccode') !==null){
            $ccode = Yii::$app->request->post('ccode');
            $inc = new InstructorCourse;
            $inc->course_code = $ccode;
            $inc->instructorID = Yii::$app->user->identity->instructor->instructorID;
            if($inc->save()){
                Yii::$app->session->setFlash('success', 'You have successfully enrolled to selected course');
                return $this->redirect(Url::toRoute('/instructor/courses'));
            }
        }

        }
      


  
    }



//########################### fucntion to drop course ############################################

    public function actionDropcourse(){
        if(Yii::$app->request->isAjax){
        $instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ccode = Yii::$app->request->post('ccode');
        $instcourse = InstructorCourse::findOne(['course_code'=>$ccode, 'instructorID'=>$instructorID]);
        if($instcourse->delete()){
            return $this->asJson(['message'=>'Course droped']);
        }
    }
}



//############################### classwork  #######################################################

public function actionClasswork($cid){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }

    $assignments = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->all();
    $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->all();
    $labs = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->all();
    $materials = Material::find()->where(['course_code' => $cid])->all();
    $courses = Yii::$app->user->identity->instructor->courses;
    return $this->render('classwork', ['cid'=>$cid, 'courses'=>$courses, 'assignments'=>$assignments, 'tutorials'=>$tutorials, 'labs'=>$labs, 'materials'=>$materials]);

}

public function actionStdwork($cid){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }

    $courses = Yii::$app->user->identity->instructor->courses;
    return $this->render('stdwork', ['cid'=>$cid, 'courses'=>$courses]);

}



//############################## function to create assignment ######################################

public function actionUploadAssignment(){
    $model = new UploadAssignment();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Assignment created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}



//######################## function to create tutorial ###############################################

public function actionUploadTutorial(){
    $model = new UploadTutorial();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Tutorial created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}

 
//######################## function to create lab ###############################################

public function actionUploadLab(){
    $model = new UploadLab();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Lab created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}


//######################## function to create material ###############################################


public function actionUploadMaterial(){
    $model = new UploadMaterial();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Material created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}

}
