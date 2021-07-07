<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Program;
use common\models\Submit;
use common\models\Material;
use common\models\User;
use common\models\Groups;
use common\models\Student;
use common\models\StudentCourse;
use common\models\InstructorCourse;
use frontend\models\UploadAssignment;
use frontend\models\AddGroup;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\CarryCourseSearch;
use frontend\models\StudentGroup;
use yii\helpers\ArrayHelper;
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
                        'actions' => ['dashboard','error','classwork','courses','changePassword','carrycourse','add_carry','delete','student_groups','delete_group','add_group','student_in_login_user_course','add_to_group','list_student_in_group','remove_student_from_group','submit_assignment'],
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

    $reg_no = Yii::$app->user->identity->username;

    $assignments = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->orderBy([
    'assID' => SORT_DESC ])->all(); 


    $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC])->all();


    $labs = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC ])->all();


    $materials = Material::find()->where(['course_code' => $cid])->orderBy([
        'material_ID' => SORT_DESC ])->all();


    $returned= Assignment::find()->where('submit.reg_no = :reg_no AND assignment.course_code = :course_code', [ ':reg_no' => $reg_no,':course_code' => $cid])->leftJoin('submit','assignment.assID = submit.assID')->with('submits')->all();


    $courses = Yii::$app->user->identity->student->program->courses;


    return $this->render('classwork', ['cid'=>$cid,'returned'=>$returned, 'courses'=>$courses, 'assignments'=>$assignments,'tutorials'=>$tutorials, 'labs'=>$labs, 'materials'=>$materials]);

}

    public function actionCourses(){

         #################### Student courses lists ##############################

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

        
        $model = Course::find()->select(['student_course.SC_ID','course.course_name','course.course_code','course.course_credit','course.course_status'])->where('student_course.reg_no = :reg_no',[ 'reg_no' => $id])->joinWith('studentCourses')->all();
        

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

        
            $model = Course::find()->where('student_course.reg_no = :reg_no', [ 'reg_no' => $id])->joinWith('studentCourses')->all();
            
            return $this->render('carry_courses/index', ['data'=> $model]);
        }
        else{
            return $this->renderAjax('carry_courses/add_carry', [
                'model' => $model,
            ],false,true);
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

        
        $model = Course::find()->where('student_course.reg_no = :reg_no', [ ':reg_no' => $id])->joinWith('studentCourses')->all();
        
        return $this->render('carry_courses/index', ['data'=> $model]);
    }

     /**
     * Lists all groups created by student student.
     * @return mixed
     */
    public function actionStudent_groups()
    {
        $id = Yii::$app->user->identity->username;

        
        $model = Course::find()->where('groups.reg_no = :reg_no',[ ':reg_no' => $id])
        ->joinWith('studentCreatedGroups')
        ->all();
        

        return $this->render('groups/index', ['data'=> $model]);
    }


    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findGroupModel($id)
    {
        if (($model = Groups::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


     /**
     * Deletes an existing Group.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete_group($id)
    {
        $this->findGroupModel($id)->delete();

        $id = Yii::$app->user->identity->username;

        
        $model = Course::find()->where('groups.reg_no = :reg_no',[':reg_no' => $id])
        ->joinWith('studentCreatedGroups')
        ->all();
        

        return $this->render('groups/index', ['data'=> $model]);
    }
    

     /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd_group()
    {
        $model = new AddGroup();

        $user_name = Yii::$app->user->identity->username;
        
    
        $student_details = Student::findOne(['reg_no'=>$user_name]);

        $student_programme = $student_details->programCode;


        $courses = ArrayHelper::map(Course::find()->select(['course.course_name','course.course_code'])->where('program_course.programCode = :programCode', [':programCode' => $student_programme])->joinWith('programCourses')->all(),'course_code','course_name');

        try{
        if($model->load(Yii::$app->request->post())&& $model->save()){
       
            
            Yii::$app->session->setFlash('success', 'group added successfully');
       
                
         }
          
        }
        catch(\Exception $e){
    Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());

        }

        
        return $this->render('groups/add_group', [
            'model' => $model,'student_programme' => $student_programme
        ]);
    }


     /**
     * Lists all students belong to the program of login user.
     * @return mixed
     */
    public function actionStudent_in_login_user_course($id)
    {

        $model = new StudentGroup;

        $group_id = $id;

        $group_name =Groups::find()->where('groupID = :groupID', [':groupID' => $group_id])->one(); 

        $user_name = Yii::$app->user->identity->username;

        $student_details = Student::findOne(['reg_no'=>$user_name]);
        $student_programme = $student_details->programCode;

        $student_group_details = Groups::findOne(['groupID'=>$group_id]);
        // print_r($student_group_details);
        // die();

        $student_group_id = $student_group_details->groupID;

        
     
        $model_student = Student::find()->select('student.reg_no,student.fname,mname,student.lname,student.gender')->where('student.programCode = :programCode AND (student_group.groupID <> :groupID OR student_group.groupID IS NULL)', [':programCode' => $student_programme,':groupID' => $student_group_id])->leftJoin('student_group','student.reg_no = student_group.reg_no')->with('studentGroups')->orderBy('lname')
        ->all();


        try{
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash('success', 'Carry added successfully');
            $id = Yii::$app->user->identity->username;

        
           
            return $this->render('groups/student_list_in_course_group', ['data'=> $model_student, 'group_name' => $group_name, 'model' => $model]);
        
        }
        }
        catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
         
        }

        return $this->render('groups/student_list_in_course_group', ['data'=> $model_student, 'group_name' => $group_name, 'model' => $model]);
            
    }


       /**
     * Lists all students in a group.
     * @return mixed
     */
    public function actionList_student_in_group($id)
    {

        $model = new StudentGroup;

        $group_id = $id;

        $group_name =Groups::find()->where('groupID = :groupID', [':groupID' => $group_id])->one(); 

      

        $student_group_details = Groups::findOne(['groupID'=>$group_id]);
        // print_r($student_group_details);
        // die();

        $student_group_id = $student_group_details->groupID;

        
     
        $model_student_list = Student::find()->select('student_group.SG_ID,student.reg_no,student.fname,mname,student.lname,student.gender')->where('student_group.groupID = :groupID', [':groupID' => $student_group_id])->leftJoin('student_group','student.reg_no = student_group.reg_no')->with('studentGroups')->orderBy('lname')
        ->all();


        

        return $this->render('groups/student_list_in_group', ['data'=> $model_student_list, 'group_name' => $group_name]);
            
    }




    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findStudentGroupModel($id)
    {
        if (($model = StudentGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


     /**
     * Deletes an existing Group.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRemove_student_from_group($id)
    {
        $this->findStudentGroupModel($id)->delete();


        return $this->refresh();
    }
    


    public function actionSubmit_assignment($assID)
    {

        $model =new Submit; 

        $file = UploadedFile::getInstanceByName('document');
        $model->document = $file;
        $model->assinmentId = $assID;


        // echo '<pre>';
        //     var_dump($file);
        // echo '</pre>';
        // exit;

        $reg_no = Yii::$app->user->identity->username;

        try{
            if (Yii::$app->request->isPost && $model->save()) {
                
                Yii::$app->session->setFlash('success', 'Your Submit successed');
             
                
                return $this->refresh();
            }
            
            
        }
        catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
        }

            return $this->render('submit_assignment', [
                'model' => $model, 'assID' => $assID],false,true);
    }




}
