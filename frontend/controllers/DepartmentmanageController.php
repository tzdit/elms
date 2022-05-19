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
                    'deletedepartment',
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
        $collegeDepartments = Department::find()->where(['collegeID'=>$adminCollege])->all();
        $colleges = ArrayHelper::map(College::find()->all(), 'collegeID', 'college_name');
        $model = new CreateDepartment();

        try{
            if($model->load(Yii::$app->request->post())){
                if($model->create()===true){
                    Yii::$app->session->setFlash('success', 'Department added successfully');
                    return $this->redirect(Yii::$app->request->referrer);
                    //print_r(Yii::$app->request->post());
                }else{
                    Yii::$app->session->setFlash('error','unable to add new department');
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
        $dept = Department::findOne($deptid);
        //$dept = $prog -> departmentID;
        //$dept_id = Department::find('departmentID',$dept);
        //$prog ->departmentID = $dept;
        //$departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
        if($dept->load(Yii::$app->request->post()) && $dept->save())
        {
            
            Yii::$app->session->setFlash('success', 'Department updated successfully');
           return $this->redirect(['index']);
        }else{
        return $this->render('updatedept', ['dept'=>$dept]);
        }
    }

    public function actionDeletedepartment($deptsid)
    {
        // $deptdel = Department::findOne([$id]); 
        $dept_delete = Department::findOne($deptsid)->delete();
        if($dept_delete){
            Yii::$app->session->setFlash('success', 'Department deleted successfully');
            
        }
        return $this->redirect(Yii::$app->request->referrer);
        
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
