<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\InstructorCourse;
use Yii;
use yii\helpers\Url;

class InstructorController extends \yii\web\Controller
{
    //public $layout = 'instructor';
       /**
     * {@inheritdoc}
     */
//public $layout = 'admin';
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
                            'enroll-course'
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR']

                    ],
                    
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }


    public function actionDashboard()
    {
   
        return $this->render('index');
    }
    //function to render instructor courses
    public function actionCourses(){
        $courses = Course::find()->where(['course_semester'=>1])->all();

        return $this->render('courses', ['courses'=>$courses]);
    }
    //function to enroll courses for instructor
    public function actionEnrollCourse(){
        if(Yii::$app->request->isPost){
        if(Yii::$app->request->post('ccode') !==null){
            $ccode = Yii::$app->request->post('course_code');
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

}
