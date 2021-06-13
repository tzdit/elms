<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Submit;
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
class StudentController extends \yii\web\Controller
{
	//public $layout = 'student';
	public $defaultAction = 'dashboard';
	 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['dashboard','error','classwork','courses'],
                        'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                    
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actionDashboard()
    {
   $courses = Yii::$app->user->identity->student->program->courses;
        return $this->render('index', ['courses'=>$courses]);
    }
 ############################## assignments in each course  #######################################################

public function actionClasswork($cid){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }
    $assignments = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->orderBy([
    'assID' => SORT_DESC ])->all(); 
    $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC])->all();
    $labs = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC ])->all();
    $materials = Material::find()->where(['course_code' => $cid])->orderBy([
        'material_ID' => SORT_DESC ])->all();
    $returned= Submit::find()->where(['reg_no' => 'T/UDOM/2020/00001'])->all();
    $courses = Yii::$app->user->identity->student->program->courses;
    return $this->render('classwork', ['cid'=>$cid,'returned'=>$returned, 'courses'=>$courses, 'assignments'=>$assignments,'tutorials'=>$tutorials, 'labs'=>$labs, 'materials'=>$materials]);

}

     

    #################### Student courses lists ##############################

    public function actionCourses(){
        $courses = Yii::$app->user->identity->student->program->courses;
        return $this->render('courses', ['courses'=>$courses]);
        
    }

}
