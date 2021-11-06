<?php

namespace frontend\controllers;

use Yii;
use common\models\Student;
use common\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\UploadStudentForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use frontend\models\RegisterInstructorForm;
use frontend\models\RegisterHodForm;
use common\models\Instructor;
use common\models\College;
use common\models\Department;
use common\models\Hod;
use common\models\Program;
use common\models\Course;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use yii\helpers\URL;
use common\models\Logs;
use yii\data\ActiveDataProvider;
/**
 * StudentmanageController implements the CRUD actions for Student model.
 */
class StudentmanageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                  
                    [
                        'actions' => [
                            'create-student',
                            'student-list',
                            'view',
                            'update',
                            'delete',
                            'create',
                        ],
                        'allow' => true,
                        'roles' => ['SYS_ADMIN'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */

    /**
     * Displays a single Student model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reg_no]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reg_no]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCreateStudent(){
        $model = new UploadStudentForm;
        $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
        // $departments = Yii::$app->user->identity->hod->department;
       // $departments = ArrayHelper::map(Department::find()->where(['departmentID'=> Yii::$app->user->identity->instructor->department->departmentID])->all(), 'depart_abbrev', 'depart_abbrev');
        try{
        $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
        if($model->load(Yii::$app->request->post())){
           
            if($model->create()){
            Yii::$app->session->setFlash('success', 'Student registered successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                //print_r(Yii::$app->request->post());
                Yii::$app->session->setFlash('error', 'Something went Wrong!');
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
    }
        return $this->render('create_student', ['model'=>$model, 'programs'=>$programs, 'roles'=>$roles]);
    }

    //create students
//  public function actionCreateStudent(){
//     $modeli = new UploadStudentForm;
//     $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
//     try{
//     $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
//     if($modeli->load(Yii::$app->request->post())){
       
//         if($modeli->create()){
            
//        Yii::$app->session->setFlash('success', 'Student registered successfully');
//         }else{
//             Yii::$app->session->setFlash('error', 'Something went Wrong!');
//         }
   
            
//      } 
    
// }catch(\Exception $e){
//     Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
// }
//     return $this->render('create_student', ['modeli'=>$modeli, 'programs'=>$programs, 'roles'=>$roles]);
// }
    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['student-list']);
    }

    //get list of students

  public function actionStudentList(){
    $students = Student::find()->all();
    return $this->render('student_list', ['students'=>$students]);
   }
    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
