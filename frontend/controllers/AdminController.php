<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\RegisterInstructorForm;
use frontend\models\RegisterHodForm;
use frontend\models\UploadStudentForm;
use common\models\Instructor;
use common\models\Student;
use common\models\College;
use common\models\Department;
use common\models\Hod;
use common\models\Program;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use yii\helpers\URL;

/**
 * Site controller
 */
class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    //apply admin layout to this controller
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
                            'instructor-list',
                            'hod-list',
                            'create-instructor',
                            'create-hod',
                            'create-student',
                            'student-list',
                        ],
                        'allow' => true,
                        'roles' => ['SYS_ADMIN'],
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
    /**
     * {@inheritdoc}
     */

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDashboard()
    {
        return $this->render('index');
    }
    //Create instructor
    public function actionCreateInstructor(){
        $model = new RegisterInstructorForm;
        $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'INSTRUCTOR & HOD'])->orwhere(['name'=>'INSTRUCTOR'])->all(), 'name', 'name');
        try{
        $departments = ArrayHelper::map(Department::find()->where(['collegeID'=>Yii::$app->user->identity->admin->college->collegeID])->all(), 'departmentID', 'department_name');
        if($model->load(Yii::$app->request->post())){
            if($model->createi()){
            Yii::$app->session->setFlash('success', 'Instructor registered successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
            Yii::$app->session->setFlash('error', 'Somethibg went Wrong!');
        }
         } 
        
    }catch(\Exception $e){
          Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
    }
        return $this->render('create_instructor', ['model'=>$model, 'departments'=>$departments, 'roles'=>$roles]);
    }


        //Create hod
        public function actionCreateHod(){
            $model = new RegisterHodForm;
            $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'HOD'])->all(), 'name', 'name');
            try{
            $departments = ArrayHelper::map(Department::find()->where(['collegeID'=>Yii::$app->user->identity->admin->college->collegeID])->all(), 'departmentID', 'department_name');
            if($model->load(Yii::$app->request->post())){
                if($model->create()){
                Yii::$app->session->setFlash('success', 'Hod registered successfully');
                }else{
                    Yii::$app->session->setFlash('error', 'Somethibg went Wrong!');
                }
           
                    
             } 
            
        }catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
        }
            return $this->render('create_hod', ['model'=>$model, 'departments'=>$departments, 'roles'=>$roles]);
        }
    
    

    //get instructor list
    public function actionInstructorList(){
        $instructors = Instructor::find()->all();
        return $this->render('instructor_list', ['instructors'=>$instructors]);
    }

    //get Hod list
    public function actionHodList(){
        $hods = Hod::find()->all();
        return $this->render('hod_list', ['hods'=>$hods]);
    }
//create students
 public function actionCreateStudent(){
    $model = new UploadStudentForm;
    $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
    try{
    $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
    if($model->load(Yii::$app->request->post())){
       
        if($model->create()){
        Yii::$app->session->setFlash('success', 'Student registered successfully');
        }else{
            Yii::$app->session->setFlash('error', 'Somethibg went Wrong!');
        }
   
            
     } 
    
}catch(\Exception $e){
    Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
}
    return $this->render('create_student', ['model'=>$model, 'programs'=>$programs, 'roles'=>$roles]);
}
//get list of students

  public function actionStudentList(){
    $students = Student::find()->all();
    return $this->render('student_list', ['students'=>$students]);
}

}
