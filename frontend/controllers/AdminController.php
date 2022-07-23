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
use common\models\Course;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use yii\helpers\URL;
use common\models\TblAuditEntry;
use common\models\TblAuditEntrySearch;
use yii\data\ActiveDataProvider;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Academicyear;
use frontend\models\AcademicYearManager;
use common\models\SystemModules;
use frontend\models\ClassRoomSecurity;
use frontend\models\ReceiptManager;
use frontend\models\StorageManager;
use frontend\models\ClassroomConfig;
use common\models\Admin;
use common\models\Session;
use common\models\User;
use common\models\Material;
use common\models\Quiz;

//use yii\filters\VerbFilter;

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
                            'activity-logs',
                            'activity-logs-extended',
                            'receipts',
                            'validate-receipt',
                            'courses',
                            'programs',
                            'delete' => ['POST'],
                        ],
                        'allow' => true,
                        'roles' => ['SYS_ADMIN','SUPER_ADMIN'],
                    ],
                    [
                        'actions' => [
                            'academic-year',
                            'migrate-forwards',
                            'migrate-backwards',
                            'system-modules',
                            'activate-module',
                            'deactivate-module',
                            'add-module',
                            'delete-module',
                            'storage',
                            'clear-logs',
                            'boost-storage',
                            'config'
                         
                           
                        ],
                        'allow' => true,
                        'roles' => ['SUPER_ADMIN'],
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
        $instructors=count(Instructor::find()->all());
        $students=count(Student::find()->all());
        $opensessions=count(Session::find()->all());
        $users=count(User::find()->all());
        $courses=count(Course::find()->all());
        $materials=count(Material::find()->all());
        $tests=count(Quiz::find()->all());
        $programs=count(Program::find()->all());

        $topactivities=TblAuditEntry::findBySql("select audit_entry_user_id,audit_entry_model_name,audit_entry_operation,COUNT(audit_entry_operation) AS frequency
   from tbl_audit_entry group by audit_entry_model_name,audit_entry_operation order by frequency DESC limit 5")->all();
   $topusers=TblAuditEntry::findBySql("select audit_entry_user_id,COUNT(audit_entry_user_id) AS frequency
   from tbl_audit_entry group by audit_entry_user_id order by frequency DESC limit 5")->all();
        return $this->render('index',[
            'instructors'=>$instructors,
            'students'=>$students,
            'opensessions'=>$opensessions,
            'users'=>$users,
            'courses'=>$courses,
            'materials'=>$materials,
            'tests'=>$tests,
            'topusers'=>$topusers,
            'topactivities'=>$topactivities,
            'programs'=>$programs
        ]);
    }
    public function actionCourses()
    {
        $courses=Course::find()->all();

        return $this->render('courses',['courses'=>$courses]);
    }
    public function actionPrograms()
    {
        $programs=Program::find()->all();

        return $this->render('programs',['programs'=>$programs]);
    }
    //Create instructor
    public function actionCreateInstructor(){
        $model = new RegisterInstructorForm;
        $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'INSTRUCTOR & HOD'])->orwhere(['name'=>'INSTRUCTOR'])->all(), 'name', 'name');
        $departments = ArrayHelper::map(Department::find()->where(['collegeID'=>Yii::$app->user->identity->admin->college->collegeID])->all(), 'departmentID', 'department_name');
        
        try{
        
        if($model->load(Yii::$app->request->post())){
            if($model->createi()){
            Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Instructor registered successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Something went Wrong!'.Html::errorSummary($model));
        }
         } 
        
    }catch(\Exception $e){
          Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Something went wrong'.$e->getMessage());
    }
        return $this->render('create_instructor', ['model'=>$model, 'departments'=>$departments, 'roles'=>$roles]);
    }


        //Create hod
        public function actionCreateHod(){
            $model = new RegisterHodForm;
            $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'HOD'])->all(), 'name', 'name');
            $departments = ArrayHelper::map(Department::find()->where(['collegeID'=>Yii::$app->user->identity->admin->college->collegeID])->all(), 'departmentID', 'department_name');
            try{
            
            if($model->load(Yii::$app->request->post())){
                if($model->create()){
                Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Hod registered successfully');
                }else{
                    Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Something went Wrong!'.Html::errorSummary($model));
                }
           
                    
             } 
            
        }catch(\Exception $e){
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Something went wrong '.$e->getMessage());
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

//get list of students

  public function actionStudentList(){
    $students = Student::find()->all();
    return $this->render('student_list', ['students'=>$students]);
}

// get Activity Logs
    public function actionActivityLogs(){
        $searchModel = new TblAuditEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('activity_logs', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);
    }

    public function actionActivityLogsExtended(){
        $searchModel = new TblAuditEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('activity_logs_extended', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);
    }
    public function actionClearLogs()
    {
        try
        {
        $connection = Yii::$app->getDb();
        $connection->createCommand("delete from tbl_audit_entry")->execute();
        Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Logs Cleared Successfully');
        }
        catch(\Exception $l)
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Could not delete Logs '.$e->getMessage());
        }

        return $this->redirect(yii::$app->request->referrer);
    }







    //////////////////////////////////////////////////////////////////////
    //               SUPER ADMIN
    //////////////////////////////////////////////////////////////////////

    public function actionAcademicYear()
    {
        $academicyears=Academicyear::find()->orderBy(["yearID"=>SORT_DESC])->all();
        return $this->render("academicyear",['academicyears'=>$academicyears]);
    }
    public function actionMigrateForwards()
    {
       if((new AcademicYearManager)->migrateForwards(yii::$app->request->post()))
       {
           return $this->asJson(['forwarded'=>"Academic Year Forwarded Successfully"]);
       }
       else
       {
        return $this->asJson(['Failure'=>"An error occured while forwarding this academic year, please try again later !"]);
       }
    }

    public function actionMigrateBackwards()
    {
        if((new AcademicYearManager)->migrateBackwards())
       {
        return $this->asJson(['backward'=>"Academic Year Migrated backward Successfully"]);
       }
       else
       {
        return $this->asJson(['Failure'=>"An error occured while migrating this academic year, please try again later !"]);
       }

  
    }
    public function actionSystemModules()
    {
        $modules=SystemModules::find()->all();

        return $this->render("system_modules",['modules'=>$modules]);
    }
    public function actionActivateModule($module)
    {
        $module=ClassRoomSecurity::decrypt($module);
        if(SystemModules::findOne($module)->activate())
        {
          yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Module Activated !");
        }
        else
        {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Module Activation failed!");
        }

        return $this->redirect(yii::$app->request->referrer);
    }
    public function actionDeactivateModule($module)
    {
        $module=ClassRoomSecurity::decrypt($module);
        if(SystemModules::findOne($module)->deactivate())
        {
          yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Module Deactivated !");
        }
        else
        {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Module Deactivation failed!");
        }

        return $this->redirect(yii::$app->request->referrer);
    }

    public function actionAddModule()
    {
      $module=new SystemModules;
      if($module->load(yii::$app->request->post()) && $module->save())
      {
        yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Module Added Successfully !");
      }
      else
      {
        yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> Module Adding Failed !");
      }

      return $this->redirect(yii::$app->request->referrer);
    }

    public function actionDeleteModule()
    {
      $module=yii::$app->request->post('module');

      if(SystemModules::findOne($module)->delete())
      {
        return $this->asJson(['deleted'=>"Module Deleted successfully !"]);
      }
      else
      {
        return $this->asJson(['failure'=>"An error occured while deleting module !"]);
      }
       
    }
    public function actionStorage()
    {
        $storageinfo=shell_exec("df -h");
        return $this->render("storage",['info'=>$storageinfo]);
    }
    public function actionValidateReceipt()
    {
        if(yii::$app->request->isPost)
        {
            try
            {

             
                $cont=trim(yii::$app->request->post("content"));
                (new ReceiptManager)->receiptValidator($cont);
            }
            catch(\Exception $r)
            {
                yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> ".$r->getMessage());
                return $this->redirect(yii::$app->request->referrer);
            }
        }
        
    }
    public function actionReceipts()
    {
        return $this->render('receipts');
    }
    public function actionConfig()
    {
        try
        {
            $configs=new ClassroomConfig();
        
            if(yii::$app->request->isPost)
            {
                if($configs->load(yii::$app->request->post()) &&  $configs->updateConfig())
                {
                    yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Configuration file updated Successfully !");
                    return $this->redirect(yii::$app->request->referrer);  
                }
            }
        }
        catch(\Exception $c)
        {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> ".$c->getMessage());
            return $this->redirect(yii::$app->request->referrer);  
        }
        return $this->render('config',['configs'=>$configs]);
    }
    public function actionBoostStorage()
    {
         try
         {
            $model=new StorageManager;
            $deleted=$model->deleteFiles(yii::$app->request->post());
            
            return $this->asJson(['deleted'=>$deleted." file(s) deleted successfully!"]);
            
          
         }
         catch(\Exception $d)
         {
            return $this->asJson(['failure'=>"an error occured while deleting files! ".$d->getMessage()]);
         }
       
    }
  
}
