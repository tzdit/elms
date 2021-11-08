<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Course;
use common\models\Assignment;
use common\models\Material;
use common\models\Groups;
use common\models\Student;
use common\models\Department;
use common\models\AuthItem;

use common\models\Program;
use common\models\Announcement;
use frontend\models\UploadStudentHodForm;
use common\models\StudentCourse;
use frontend\models\AddGroup;
use frontend\models\AssSubmitForm;
use frontend\models\GroupAssSubmit;
use frontend\models\CarryCourseSearch;
use common\models\StudentGroup;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                        'actions' => ['dashboard','error','classwork','courses',
                            'changePassword','carrycourse','add_carry','delete_carry',
                            'student_groups','delete_group','add_group',
                            'student_in_login_user_course','add_to_group','list_student_in_group',
                            'remove_student_from_group','submit_assignment','view_assignment','download_assignment',
                            'resubmit','videos','announcement','group_assignment_submit',
                            'quiz_answer','quiz_view','group_resubmit','assignment',
                            'group-assignment','labs','tutorial','course-materials','returned',
                            'course-announcement','quiz','student-group'
                        ],
                        

                       'allow' => true,
                        'roles'=>['STUDENT']
                    ],
                     //for students registration
                    [
                        'actions' => ['register'],
                        

                       'allow' => true,
                        'roles'=>['?']
                    ],

                    

            
            ],
        ],
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'changePassword' => ['post'],
                    'delete_carry' => ['post'],
                ],
            ],
       
        ];
    
    }


    public function beforeAction($action) {
        $this->enableCsrfValidation = ($action->id !== "delete_carry"); // <-- here
        return parent::beforeAction($action);
    }
   
    //create students
  public function actionRegister(){
    $model = new UploadStudentHodForm;
    $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
    // $departments = Yii::$app->user->identity->hod->department;
   
    try{
    $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
    if($model->load(Yii::$app->request->post())){
       
        if($model->create()){
        Yii::$app->session->setFlash('success', 'Registration Successfull&nbsp&nbsp<a class="btn btn-primary" href="/auth/login">Login</a>');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Registration failed! try again later or contact administrator');
        }
   
            
     } 
    
}catch(\Exception $e){
    Yii::$app->session->setFlash('error', 'Registration failed! try again later or contact administrator');
}
    $this->layout = 'register';
    return $this->render('student_registration', ['model'=>$model, 'programs'=>$programs, 'roles'=>$roles]);
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

    $courses = Yii::$app->user->identity->student->program->courses;


    return $this->render('classwork', ['cid'=>$cid,'courses'=>$courses,  'reg_no' => $reg_no, 'cid' => $cid]);

}





    public function actionAssignment($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $reg_no = Yii::$app->user->identity->username;
        $assignments = Assignment::find()->where('assNature = :assignment AND course_code = :cid AND (assType = :students OR assType = :allstudent) ',[':assignment' => 'assignment', ':cid' => $cid, ':students' => 'students', ':allstudent' => 'allstudents'])->orderBy([
            'assID' => SORT_DESC ])->all();

             return $this->render('assignment', ['cid'=>$cid, 'assignments' => $assignments,  'reg_no' => $reg_no] );
    }





    /**
     * If save is successful, the browser will be redirected to the 'assignments' page.
     * @param string $assID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSubmit_assignment($assID)
    {

        $model =new AssSubmitForm;

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






    /**
     * Resubmision of an assinment
     * return in the same page after sumit
     */
    public function actionResubmit($assID){
        $model =new AssSubmitForm;

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

                Yii::$app->session->setFlash('success', 'Your Re-Submit successed');


                return $this->refresh();
            }


        }
        catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
        }


        return $this->render('submit_assignment', [
            'model' => $model, 'assID' => $assID],false,true);
    }








    public function actionStudentGroup($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $reg_no = Yii::$app->user->identity->username;
        $studentGroups = Groups::find()->joinWith('studentGroups')->where('student_group.reg_no = :reg_no', [':reg_no' => $reg_no])->orderBy(['SG_ID' => SORT_DESC ])->all();
        return $this->render('student_groups', ['cid'=>$cid, 'reg_no' => $reg_no, 'studentGroupsList' => $studentGroups] );
    }




    public function actionGroupAssignment($cid , $generationType, $groupID){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $reg_no = Yii::$app->user->identity->username;
       return $this->render('group_assignment', ['cid'=>$cid, 'reg_no' => $reg_no, 'generationType' => $generationType, 'groupID' => $groupID] );
    }




    /**
     * If save is successful, the browser will be redirected to the 'group assignments' page.
     * @param string $assID
     * @param string $groupID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGroup_assignment_submit($assID,$groupID)
    {

        $model =new GroupAssSubmit;

        $file = UploadedFile::getInstanceByName('document');
        $model->document = $file;
        $model->assinmentId = $assID;
        $model->groupId = $groupID;


        // echo '<pre>';
        //     var_dump($file);
        // echo '</pre>';
        // exit;

        try{
            if (Yii::$app->request->isPost && $model->save()) {

                Yii::$app->session->setFlash('success', 'Your Submit successed');


                return $this->refresh();
            }


        }
        catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
        }


        return $this->render('group_ass_submit', [
            'model' => $model, 'assID' => $assID,'groupId' => $groupID],false,true);
    }





    /**
     * Resubmision of an assinment
     * return in the same page after sumit
     */
    public function actionGroup_resubmit($assID,$groupID){
        $model =new AssSubmitForm;

        $file = UploadedFile::getInstanceByName('document');
        $model->document = $file;
        $model->assinmentId = $assID;


        // echo '<pre>';
        //     var_dump($file);
        // echo '</pre>';
        // exit;



        try{
            if (Yii::$app->request->isPost && $model->save()) {

                Yii::$app->session->setFlash('success', 'Your Re-Submit successed');


                return $this->refresh();
            }


        }
        catch(\Exception $e){
            Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
        }


        return $this->render('group_ass_submit', [
            'model' => $model, 'assID' => $assID,'groupID' => $groupID],false,true);
    }






    public function actionLabs($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $labs = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->orderBy([
            'assID' => SORT_DESC ])->all();

        $reg_no = Yii::$app->user->identity->username;
        return $this->render('labs', ['cid'=>$cid, 'reg_no' => $reg_no, 'labs'=>$labs] );
    }





    public function actionTutorial($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->orderBy([
            'assID' => SORT_DESC])->all();

        $reg_no = Yii::$app->user->identity->username;
        return $this->render('tutorials', ['cid'=>$cid, 'reg_no' => $reg_no, 'tutorials'=>$tutorials] );
    }





    public function actionCourseMaterials($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $materials = Material::find()->where(['course_code' => $cid])->orderBy([
            'material_ID' => SORT_DESC ])->all();

        $reg_no = Yii::$app->user->identity->username;
        return $this->render('course_materials', ['cid'=>$cid, 'reg_no' => $reg_no, 'materials'=>$materials] );
    }





    public function actionReturned($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $reg_no = Yii::$app->user->identity->username;
        $returned= Assignment::find()->where('submit.reg_no = :reg_no AND assignment.course_code = :course_code', [ ':reg_no' => $reg_no,':course_code' => $cid])->innerJoin('submit','assignment.assID = submit.assID')->orderBy([
            'submit.submitID' => SORT_DESC ])->all();

//        $returnedGroupAss= Assignment::find()->where('submit.reg_no = :reg_no AND assignment.course_code = :course_code', [ ':reg_no' => $reg_no,':course_code' => $cid])->innerJoin('group_assignment_submit','assignment.assID = group_assignment_submit.assID')->innerJoin('')->orderBy([
//            'submit.submitID' => SORT_DESC ])->all();

        return $this->render('returned', ['cid'=>$cid, 'reg_no' => $reg_no, 'returned'=>$returned,] );
    }





    public function actionCourseAnnouncement($cid){
        if(!empty($cid)){
            Yii::$app->session->set('ccode', $cid);
        }

        $reg_no = Yii::$app->user->identity->username;
        $announcement = Announcement::find()->where(['course_code' => $cid])->orderBy([
            'annID' => SORT_DESC ])->all();

        return $this->render('announcement', ['cid'=>$cid, 'reg_no' => $reg_no, 'announcement' => $announcement] );
    }





    public function actionQuiz($cid){

        $reg_no = Yii::$app->user->identity->username;
             return $this->render('quiz', ['cid'=>$cid, 'reg_no' => $reg_no]);
    }





    public function actionAnnouncement($announcement)
    {
        $announcement = Announcement::findOne($announcement);
        return $this->renderAjax('announcement_content', ['announcement'=>$announcement]);
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

        
            return $this->redirect(Yii::$app->request->referrer);
        }

            return $this->renderAjax('carry_courses/add_carry', [
                'model' => $model,
            ],false,true);
    }
    catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'You have already add this course');
        return $this->redirect(Yii::$app->request->referrer);
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

        throw new NotFoundHttpException(Yii::t('app', 'No such course'));
    }





    /**
     * Deletes an existing Carry Course.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete_carry()
    { 
        if(Yii::$app->request->isAjax){
        
            $id = Yii::$app->request->post('carry_id');
           $carry_deleted =  $this->findModel($id)->delete();
           if($carry_deleted){
            return $this->asJson(['message'=>'Carry Deleted']);
          }
        }
       
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

        
        return $this->redirect(Yii::$app->request->referrer);
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

            return $this->redirect(Yii::$app->request->referrer);
       
                
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
            
            Yii::$app->session->setFlash('success', 'Student added successfully');
           return $this->redirect(Yii::$app->request->referrer);
        
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

        throw new NotFoundHttpException(Yii::t('app', 'Group .'));
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


        return $this->redirect(Yii::$app->request->referrer);
    }





    /**
     * download assignment 
     */

    public function actionDownload_assignment($assID) {
        $model = Assignment::findOne($assID);
    
        // This will need to be the path relative to the root of your app.
        $filePath = '/web/storage/temp';
        
        $completePath = Yii::getAlias('@app'.$filePath.'/'.$model->fileName);

        if(\file_exists($completePath)){
            return Yii::$app->response->sendFile($completePath, $model->fileName);
        }
        else {
            # code...
            throw new NotFoundHttpException(Yii::t('app', 'The requested file does not exist.'));
        }
    
        
    }





    /**
     * View uploaded assinment in the browser
     */
    public function actionView_assignment($assID)
    {
        $model = Assignment::findOne($assID);
    
        // This will need to be the path relative to the root of your app.
        $filePath = '/web/storage/temp';
        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('@app'.$filePath.'/'.$model->fileName);

        if(file_exists($completePath))
        {
            // Set up PDF headers
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $completePath . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($completePath));
            header('Accept-Ranges: bytes');

            // Render the file
            readfile($completePath);
        }
        else
        {
            throw new NotFoundHttpException(Yii::t('app', 'The requested file does not exist.'));
        }
    }
    





}
