<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Material;
use common\models\User;
use common\models\StudentCourse;
use common\models\InstructorCourse;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\CarryCourseSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\Security;
use yii\widgets\ActiveForm;
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
                        'actions' => ['dashboard','error','classwork','courses','changePassword','carrycourse','add_carry','delete'],
                        'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                    
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'changePassword' => ['post'],
                ],
            ],
        ];
    }
   
   /* 
    public function actionDashboard()
    {
        return $this->render('index');
    }

    */
    public function actionDashboard()
    {
   $courses = Yii::$app->user->identity->student->program->courses;
        return $this->render('index', ['courses'=>$courses]);
    }


    public function actionClasswork(){
    
       return $this->render('classwork');
    
    }

    public function actionCourses(){

        $courses = Yii::$app->user->identity->student->program->courses;
    
        return $this->render('courses',['data'=>$courses]);
     
     }

     /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionCarrycourse()
    {
        $id = Yii::$app->user->identity->username;

        
        $model = Course::find()->select(['student_course.SC_ID','course.course_name','course.course_code','course.course_credit','course.course_status'])->where(['student_course.reg_no' => $id])->joinWith('studentCourses')->all();
        

        return $this->render('carry_courses/index', ['data'=> $model]);
    }

     /**
     * Creates a new Course Carry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd_carry()
    {
        $model =new StudentCourse;
    try{
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash('success', 'Carry added successfully');
            $id = Yii::$app->user->identity->username;

        
            $model = Course::find()->select(['student_course.SC_ID','course.course_name','course.course_code','course.course_credit','course.course_status'])->where(['student_course.reg_no' => $id])->joinWith('studentCourses')->all();
            
            return $this->render('carry_courses/index', ['data'=> $model]);
        }else{
            return $this->renderAjax('carry_courses/add_carry', [
                'model' => $model,
            ]);
        }
    }
    catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
    }

    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentCourse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /**
     * Deletes an existing Carry Course.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $id = Yii::$app->user->identity->username;

        
        $model = Course::find()->where(['student_course.reg_no' => $id])->joinWith('studentCourses')->all();
        
        return $this->render('carry_courses/index', ['data'=> $model]);
    }

}
