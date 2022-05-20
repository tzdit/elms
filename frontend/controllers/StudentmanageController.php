<?php

namespace frontend\controllers;

use Yii;
use common\models\Student;
use common\models\User;
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
                            'reset',
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


    public function actionReset($id)
    {
        $model= new User();
        $model = User::findOne($id);
        $password = 123456;

            $model->password= $password;
            $model->save();

            $students = Student::find()->all();
            return $this->render('student_list', ['students'=>$students]);
    }

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
    $adminCollege = Yii::$app->user->identity->admin->collegeID;
    return $this->render('student_list', ['students'=>$students, 'adminCollege'=>$adminCollege]);
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
