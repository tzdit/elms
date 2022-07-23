<?php

namespace frontend\controllers;

use app\models\CreateDepartment;
use common\models\College;
use Yii;
use common\models\Department;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;

/**
 * DepartmentmanageController implements the CRUD actions for Department model.
 */
class DepartmentmanageController extends Controller
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
                    'update-department',
                    'index',
                    'update-dept',
                    'deletedepartment'=> ['POST'],
                ],
            ],
            
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                  
                    [
                        'actions' => [
                            'index',
                            'view',
                            'update-dept',
                            'delete',
                            'deletedepartment',
                            'create',
                        ],
                        'allow' => true,
                        'roles' => ['SYS_ADMIN','SUPER_ADMIN'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        $adminCollege = Yii::$app->user->identity->admin->collegeID;
        $collegeDepartments=[];
        if(yii::$app->user->can('SYS_ADMIN'))
        {
        $collegeDepartments = Department::find()->where(['collegeID'=>$adminCollege])->all();
        }
        else
        {
            $collegeDepartments = Department::find()->all(); 
        }
        $colleges=[];

        if(yii::$app->user->can('SUPER_ADMIN'))
        {
            $colleges=ArrayHelper::map(College::find()->all(),'collegeID','college_name');
        }
        else
        {
            $colleges=ArrayHelper::map(College::find()->where(["collegeID"=>Yii::$app->user->identity->admin->collegeID])->all(),'collegeID','college_name');
        }
        $model = new CreateDepartment();
        try{
            if($model->load(Yii::$app->request->post())){
                if($model->create()===true){
                    Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Department added successfully');
                    return $this->redirect(Yii::$app->request->referrer);
                    //print_r(Yii::$app->request->post());
                }else{
                    Yii::$app->session->setFlash('error','<i class="fa fa-exclamation-triangle"></i> unable to add new department'.Html::errorSummary($model));
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something went wrong: '.$e->getMessage());
            return $this->redirect(Yii::$app->request->referrer);

        }
 

        return $this->render('index', ['collegeDepartments'=>$collegeDepartments, 'colleges'=>$colleges, 'model'=>$model]);
    }

    /**
     * Displays a single Department model.
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
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Department();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->departmentID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//     public function actionUpdateDepartment($id)
//     {
        
//         $department = Department::find()->where(['departmentID'=>$id])->one();
//         if(Yii::$app->request->isPost)
//         {

//             if($department->load(Yii::$app->request->post()) && $department->save())
//             {
//                 Yii::$app->session->setFlash('success', 'Department updated successfully');
//                 return $this->redirect(yii::$app->request->referrer);
//             }else{
// //                Yii::$app->session->setFlash('error', 'Department updating failed, try again later');
//                 print_r(Yii::$app->request->post());
//                // return $this->redirect(yii::$app->request->referrer);
//             }
//         }


//     }

    public function actionUpdateDept($deptid)
    {
        $deptid=base64_decode(urldecode($deptid));
        $dept = Department::findOne($deptid);
   
        $colleges=[];

        if(yii::$app->user->can('SUPER_ADMIN'))
        {
            $colleges=ArrayHelper::map(College::find()->all(),'collegeID','college_name');
        }
        else
        {
            $colleges=ArrayHelper::map(College::find()->where(["collegeID"=>Yii::$app->user->identity->admin->collegeID])->all(),'collegeID','college_name');
        }
        if(Yii::$app->request->isPost)
        {
        if($dept->load(Yii::$app->request->post()) && $dept->save())
        {
            
            Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Department updated successfully');
           return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Department updating failed'.Html::errorSummary($dept));
            return $this->redirect(yii::$app->request->referrer);
        }
    }
        return $this->render('updatedept', ['dept'=>$dept,'colleges'=>$colleges]);
    }

    public function actionDeletedepartment()
    {
        // $deptdel = Department::findOne([$id]); 
        $deptsid=yii::$app->request->post('deptsid');
        $dept_delete = Department::findOne($deptsid)->delete();
        if($dept_delete){

            return $this->asJson(['success'=>'Department deleted successfully']);
            
        }
        else
        {
            return $this->asJson(['failure'=>'Department deleting failed']);
        }

        
    }

    /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
