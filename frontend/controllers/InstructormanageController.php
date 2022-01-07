<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Instructor;
use common\models\InsructorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use frontend\models\RegisterInstructorForm;
use frontend\models\RegisterHodsForm;
use frontend\models\UploadStudentForm;
use common\models\Student;
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
//use yii\web\Controller;
//use yii\filters\VerbFilter;
/**
 * InstructormanageController implements the CRUD actions for Instructor model.
 */
class InstructormanageController extends Controller
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
                            'instructor-list',
                            'hod-list',
                            'create-instructor',
                            'create-hods',
                            'view',
                            'update',
                            'reset',
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
     * Lists all Instructor models.
     * @return mixed
     */

     // password resseting
     public function actionReset($id)
    {
        $model= new User();
        $model = User::findOne($id);
        $password = 123456;

            $model->password= $password;
            $model->save();
            
            $instructors = Instructor::find()->all();
            return $this->render('instructor_list', ['instructors'=>$instructors]);
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
            Yii::$app->session->setFlash('error', 'Something went Wrong!');
        }
         } 
        
    }catch(\Exception $e){
          Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
    }
        return $this->render('create_instructor', ['model'=>$model, 'departments'=>$departments, 'roles'=>$roles]);
    }


       //Create Hods
    public function actionCreateHods(){
        $model = new RegisterHodsForm;
        $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'INSTRUCTOR & HOD'])->orwhere(['name'=>'INSTRUCTOR'])->all(), 'name', 'name');
        $departments = ArrayHelper::map(Department::find()->where(['collegeID'=>Yii::$app->user->identity->admin->college->collegeID])->all(), 'departmentID', 'department_name');
        if(yii::$app->request->isPost)
        {
        try{
        if($model->load(Yii::$app->request->post())){
            if($model->create()){
            Yii::$app->session->setFlash('success', 'Hod registered successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
            Yii::$app->session->setFlash('error', 'Something went Wrong!');
            return $this->redirect(Yii::$app->request->referrer);
        }
         } 
        
    }catch(\Exception $e){
          Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
          return $this->redirect(Yii::$app->request->referrer);
    }
}
else
{
    return $this->render('create_hods', ['model'=>$model, 'departments'=>$departments, 'roles'=>$roles]);
}
       
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
    /**
     * Displays a single Instructor model.
     * @param integer $id
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
     * Creates a new Instructor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Instructor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->instructorID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Instructor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->instructorID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Instructor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['instructor-list']);
    }

    /**
     * Finds the Instructor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Instructor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instructor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
