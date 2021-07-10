<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Material;
use common\models\Submit;
use common\models\Instructor;
use common\models\Student;
use common\models\Department;
use common\models\Program;
use yii\helpers\ArrayHelper;
use common\models\InstructorCourse;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\CreateCourse;
use frontend\models\CreateProgram;
use frontend\models\UploadMaterial;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\Security;

class InstructorController extends \yii\web\Controller
{
    //public $layout = 'instructor';
       /**
     * {@inheritdoc}
     */
//################################# public $layout = 'admin'; #####################################

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
                            'courses',
                            'enroll-course',
                            'dropcourse',
                            'classwork',
                            'create-student',
                            'create-course',
                            'create-program',
                            'student-list',
                            'upload-assignment',
                            'upload-tutorial',
                            'upload-lab',
                            'upload-material',
                            'assignments',
                            'delete',
                            'deletelab',
                            'deletetut',
                            'materials',
                            'stdwork',
                            'stdworkmark',
                            'labwork',
                            'stdworklab',
                            'stdlabmark',
                            'update',
                            'updatetut',
                            'updatelab',
                            'add-partner',
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR']
                        

                    ],
// ############################### THIS PART FOR 'INSTRUCTOR $ HOD ROLE' ######################################
                    [
                        'actions' => [
                            'dashboard',
                            'courses',
                            'enroll-course',
                            'dropcourse',
                            'classwork',
                            'create-student',
                            'create-course',
                            'create-program',
                            'student-list',
                            'upload-assignment',
                            'upload-tutorial',
                            'upload-lab',
                            'upload-material',
                            'assignments',
                            'delete',
                            'deletelab',
                            'deletetut',
                            'materials',
                            'stdwork',
                            'stdworkmark',
                            'labwork',
                            'stdworklab',
                            'stdlabmark',
                            'update',
                            'updatetut',
                            'updatelab',
                            'add-partner',
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR & HOD']
                        

                    ],
                    
                ],
            ],
             'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'dropcourse' => ['post'],
                ],
            ],
        ];
    }


    public function actionDashboard()
    {
   $courses = Yii::$app->user->identity->instructor->courses;
        return $this->render('index', ['courses'=>$courses]);
    }



    //#################### function to render instructor courses ##############################

    public function actionCourses(){
        $courses = Course::find()->where(['course_semester'=>1])->all();

        return $this->render('courses', ['courses'=>$courses]);
        
    }
 

 
   


//###################function to enroll courses for instructor #############################

    public function actionEnrollCourse(){
        if(Yii::$app->request->isPost){
        if(Yii::$app->request->post('ccode') !==null){
            $ccode = Yii::$app->request->post('ccode');
            $inc = new InstructorCourse;
            $inc->course_code = $ccode;
            $inc->instructorID = Yii::$app->user->identity->instructor->instructorID;
            if($inc->save()){
                Yii::$app->session->setFlash('success', 'You have successfully enrolled to selected course');
                return $this->redirect(Url::toRoute('/instructor/courses'));
            }
        }

        }
      


  
    }



//########################### function to drop course ############################################

    public function actionDropcourse(){
        if(Yii::$app->request->isAjax){
        $instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ccode = Yii::$app->request->post('ccode');
        $instcourse = InstructorCourse::findOne(['course_code'=>$ccode, 'instructorID'=>$instructorID]);
        if($instcourse->delete()){
          return $this->asJson(['message'=>'Course droped']);
        }
    }
}

    public function actionDelete($id)
    {
        $ass = Assignment::findOne($id)->delete(); 
        if($ass){
           Yii::$app->session->setFlash('success', 'Assignment deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeletelab($id)
    {
        $lab = Assignment::findOne($id)->delete(); 
        if($lab){
           Yii::$app->session->setFlash('success', 'Lab deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeletetut($id)
    {
        $tut = Assignment::findOne($id)->delete(); 
        if($tut){
           Yii::$app->session->setFlash('success', 'Tutorial deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate($id)
    {
        $ass = Assignment::findOne($id);
        if($ass->load(Yii::$app->request->post()) && $ass->save())
        {
            Yii::$app->session->setFlash('success', 'Assignment updated successfully');
            return $this->redirect(['classwork', 'cid'=>$ass->course_code]);
        }else{
        return $this->render('update', ['ass'=>$ass]);
        }
    }

    public function actionUpdatelab($id)
    {
        $lab = Assignment::findOne($id);
        if($lab->load(Yii::$app->request->post()) && $lab->save())
        {
            Yii::$app->session->setFlash('success', 'Lab updated successfully');
            return $this->redirect(['classwork', 'cid'=>$lab->course_code]);
        }else{
        return $this->render('updatelab', ['lab'=>$lab]);
        }
    }

    public function actionUpdatetut($id)
    {
        $tut = Assignment::findOne($id);
        if($tut->load(Yii::$app->request->post()) && $tut->save())
        {
            Yii::$app->session->setFlash('success', 'Tutorial updated successfully');
            return $this->redirect(['classwork', 'cid'=>$tut->course_code]);
        }else{
        return $this->render('updatetut', ['tut'=>$tut]);
        }
    }



//############################### classwork  #######################################################

public function actionClasswork($cid){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }

    $assignments = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC ])->all();
    $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC])->all();
    $labs = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC ])->all();
    $materials = Material::find()->where(['course_code' => $cid])->orderBy([
        'material_ID' => SORT_DESC ])->all();
    $courses = Yii::$app->user->identity->instructor->courses;
    return $this->render('classwork', ['cid'=>$cid, 'courses'=>$courses, 'assignments'=>$assignments, 'tutorials'=>$tutorials, 'labs'=>$labs, 'materials'=>$materials]);

}


//############################## student work assignment ######################################
public function actionStdwork($cid, $id){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }
    
    $submits = Submit::find()->where(['assID'=> $id])->all();
    

    $courses = Yii::$app->user->identity->instructor->courses;

        // echo '<pre>';
        // print_r($cid);
        // echo '<br>';
        // print_r($id);
        // echo '</pre>';
        // exit;
    return $this->render('stdwork', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits, 'assignments']);

}

public function actionStdworkmark($cid, $id){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }
    
    $submits = Submit::find()->where(['assID'=> $id])->all();


    $courses = Yii::$app->user->identity->instructor->courses;

        // echo '<pre>';
        // print_r($cid);
        // echo '<br>';
        // print_r($id);
        // echo '</pre>';
        // exit;
    return $this->render('stdworkmark', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits]);

}

public function actionStdlabmark($cid, $id){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }
    
    $submits = Submit::find()->where(['assID'=> $id])->all();


    $courses = Yii::$app->user->identity->instructor->courses;

        // echo '<pre>';
        // print_r($cid);
        // echo '<br>';
        // print_r($id);
        // echo '</pre>';
        // exit;
    return $this->render('stdlabmark', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits]);

}


//############################## student work lab ######################################
public function actionLabwork($cid){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }

    $courses = Yii::$app->user->identity->instructor->courses;
    return $this->render('labwork', ['cid'=>$cid, 'courses'=>$courses]);

}


public function actionStdworklab($cid, $id){
    if(!empty($cid)){
   Yii::$app->session->set('ccode', $cid);
    }
    
    $submits = Submit::find()->where(['assID'=> $id])->all();
    

    $courses = Yii::$app->user->identity->instructor->courses;

        // echo '<pre>';
        // print_r($cid);
        // echo '<br>';
        // print_r($id);
        // echo '</pre>';
        // exit;
    return $this->render('stdworklab', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits]);

}

//############################## function to create assignment ######################################

public function actionUploadAssignment(){
    $model = new UploadAssignment();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Assignment created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}



//######################## function to create tutorial ###############################################

public function actionUploadTutorial(){
    $model = new UploadTutorial();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Tutorial created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}

 
//######################## function to create lab ###############################################

public function actionUploadLab(){
    $model = new UploadLab();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Lab created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}


//######################## function to create material ###############################################


public function actionUploadMaterial(){
    $model = new UploadMaterial();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        // echo '<pre>';
        // print_r($model);
        // echo '</pre>';
        // exit;
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Material uploaded successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
          
        Yii::$app->session->setFlash('error', 'Something went wrong');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}
//##################################### add partner ##################################################################

public function actionAddPartner()
{
  
  

print "adding partner";


}



//#################################### HOD HERE ########################################################################

  //create students
  public function actionCreateStudent(){
    $model = new UploadStudentHodForm;
    $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
    // $departments = Yii::$app->user->identity->hod->department;
    $departments = ArrayHelper::map(Department::find()->where(['departmentID'=> Yii::$app->user->identity->hod->department->departmentID])->all(), 'depart_abbrev', 'depart_abbrev');
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
    Yii::$app->session->setFlash('error', 'Something wente wrong'.$e->getMessage());
}
    return $this->render('create_student', ['model'=>$model, 'programs'=>$programs, 'departments'=>$departments, 'roles'=>$roles]);
}

//get list of students for particular department

public function actionStudentList(){
    $myinstructor=Instructor::findOne('instructorID');
    $instructor_department= $myinstructor->department;
    $programs=$instructor_department->programs;
    $students=[];
    for($p=0;$p<count($programs);$p++)
    {
        $program_students=$program[$p]->students;
        array_push($students,$program_students);
    }
    return $this->render('student_list', ['students'=>$students, 'program_students'=>$program_students]);
}


     //Create program
     public function actionCreateProgram(){
        $model = new CreateProgram;
        $programs = Program::find()->all();
        try{
        $departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
        if($model->load(Yii::$app->request->post())){
            if($model->upload()){
            Yii::$app->session->setFlash('success', 'Program added successfully');
            }else{
                Yii::$app->session->setFlash('error', 'Something went Wrong!');
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
    }
        return $this->render('prog_modal', ['model'=>$model, 'departments'=>$departments, 'programs'=>$programs]);
    }


     //Create Course
     public function actionCreateCourse(){
        $model = new CreateCourse;
        $courses = Course::find()->all();
        try{
        // $departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
        if($model->load(Yii::$app->request->post())){
            if($model->create()){
            Yii::$app->session->setFlash('success', 'Course added successfully');
            }else{
                Yii::$app->session->setFlash('error', 'Something went Wrong!');
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
    }
        return $this->render('create-course', ['model'=>$model, 'courses'=>$courses]);
    }
}