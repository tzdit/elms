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
use common\models\StudentCourse;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\AddPartner;
use frontend\models\UploadLab;
use frontend\models\CreateCourse;
use frontend\models\CreateProgram;
use frontend\models\UploadMaterial;
use frontend\models\StudentGroups;
use common\models\Groups;
use common\models\GroupGenerationTypes;
use common\models\Assq;
use common\models\GroupAssignmentSubmit;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\QMarks;
use yii\web\Response;
use yii\web\BadRequestHttpException;
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
                            'generate-groups',
                            'view-groups',
                            'delete-groups',
                            'get-gentypes',
                            'get-groups',
                            'get-students',
                            'add-student-gentype',
                            'mark',
                            'mark-inputing',
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
    $submits=null;
    $asstype=Assignment::findOne($id)->assType;
    if($asstype=="allgroups" || $asstype=="groups")
    {
     $submits =GroupAssignmentSubmit::find()->where(['assID'=> $id])->all();
    }
    else
    {
    $submits = Submit::find()->where(['assID'=> $id])->all();
    }
    

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

   
    return $this->render('stdworklab', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits]);

}

//############################## function to create assignment ######################################

public function actionUploadAssignment(){
    
    $model = new UploadAssignment();
   
    if($model->load(Yii::$app->request->post())){
    
    //loading the external post data into the model
    $model->questions_maxima=Yii::$app->request->post('q_max');
    if($model->assType=="allgroups"){$model->generation_type=Yii::$app->request->post('gentypes');}
    else if($model->assType=="groups"){$model->generation_type=Yii::$app->request->post('gentypes');$model->groups=Yii::$app->request->post('gengroups');}
    else if($model->assType=="students"){$model->students=Yii::$app->request->post('mystudents');}else{}
    if($model->assFormat=='file')
    {
    $model->assFile =UploadedFile::getInstanceByName('assFile');
    }
    else
    {
        $model->the_assignment=Yii::$app->request->post('the_assignment');
    }
 
    
        if($model->create_assignment()){
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
    
    //loading the external post data into the model
    $model->questions_maxima=Yii::$app->request->post('q_max');
    if($model->assType=="allgroups"){$model->generation_type=Yii::$app->request->post('gentypes');}
    else if($model->assType=="groups"){$model->generation_type=Yii::$app->request->post('gentypes');$model->groups=Yii::$app->request->post('gengroups');}
    else if($model->assType=="students"){$model->students=Yii::$app->request->post('mystudents');}else{}
    if($model->assFormat=='file')
    {
    $model->assFile =UploadedFile::getInstanceByName('assFile');
    }
    else
    {
        $model->the_assignment=Yii::$app->request->post('the_assignment');
    }
 
    
        if($model->create_assignment()){
        Yii::$app->session->setFlash('success', 'Lab assignment created successfully');
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
public function actionMark($id)
{
    //loading the current assignment

    $assignment=new Assignment();
    $current_assignment=$assignment::findOne($id);
   
    return $this->render('marking',['assignment'=>$current_assignment]);  
}
public function actionMarkInputing()
{

    if(Yii::$app->request->post()) {
    
    $score=Yii::$app->request->post('score');
    $fid=Yii::$app->request->post('fid');
    $qscores=Yii::$app->request->post('qscores');
    $asstype=Yii::$app->request->post('asstype');
    $comment=Yii::$app->request->post('comment');
    $qids=Yii::$app->request->post('qids');
    $model=null;
    $submit=null;
    if($asstype=="group")
    {
        $model=new GroupAssignmentSubmit();
        
        
    }
    else
    {
        $model=new Submit();
    }
  if($model!=null)
  {
    $submit=$model->findOne($fid);
    $submit->score=$score;
    $submit->comment=$comment;
  }
  $submit->save();
  //preparing the submit
 

//inserting questions marks
  for($sc=0;$sc<count($qscores);$sc++)
  {
    $qmark=new Qmarks();
    $qmark->assq_ID=$qids[$sc];
    $qmark->q_score=$qscores[$sc];

    //the submitids

    if($submit instanceof GroupAssignmentSubmit)
    {
        $qmark->group_submit_id=$submit->submitID; 
    }
    else
    {
        $qmark->submitID=$submit->submitID;  
    }

    $qmark->save();
    

   
  }
 // return $this->redirect(Yii::$app->request->referrer);   
}
}
//##################################### add partner ##################################################################

public function actionAddPartner()
{
  $instructor=(new Instructor())->findOne(Yii::$app->request->post('AddPartner')['partner']);
  $instructorcourse=$instructor->instructorCourses;
  $courseid=array();
  for($i=0;$i<count($instructorcourse);$i++)
  {
    array_push($courseid,$instructorcourse[$i]->course_code);
  }
  if(in_array(Yii::$app->request->post('ccode'),$courseid))
  {
    Yii::$app->session->setFlash('success', 'this instructor already has this course');
    return $this->redirect(Yii::$app->request->referrer);    
  }
  else
  {
  $addpartner=new AddPartner();
  if($addpartner->load(Yii::$app->request->post())){
  if($addpartner->addcoursepartner(Yii::$app->request->post('ccode')))
  {
    Yii::$app->session->setFlash('success', 'Course partner added');
    return $this->redirect(Yii::$app->request->referrer);
  }
  else
  {
    Yii::$app->session->setFlash('success', 'unkown error occured');
    return $this->redirect(Yii::$app->request->referrer);  
  }

  }
}

}

//########################### creating student groups ################################


public function actionGenerateGroups()
{
 
    $model = new StudentGroups();
    if($model->load(Yii::$app->request->post())){
      
     if($model->generateRandomGroups())
     {

        Yii::$app->session->setFlash('success', 'groups generated');
        return $this->redirect(Yii::$app->request->referrer);
     }
     else{

        Yii::$app->session->setFlash('success', 'groups generating failed');
        return $this->redirect(Yii::$app->request->referrer);
     }
 
     }

}
//students group types

public function actionAddStudentGentype()
{
 
    $model = new StudentGroups();
    if($model->load(Yii::$app->request->post()) && $model->validate()){
      
     if($model->addstudenttype())
     {

        Yii::$app->session->setFlash('success', 'successful');
        return $this->redirect(Yii::$app->request->referrer);
     }
     else{

        Yii::$app->session->setFlash('success', 'failed');
        return $this->redirect(Yii::$app->request->referrer);
     }
 
     }

}

 public function actionViewGroups()
 {
   $groupsModel=new GroupGenerationTypes();
   $coursecode=Yii::$app->session->get('ccode');
   $groups=$groupsModel::find()->where(['course_code'=>$coursecode])->orderBy(['typeID'=>SORT_DESC])->all();
   if($groups==null){ Yii::$app->session->setFlash('success', 'No groups found');return $this->render('courseGroups', ['groups'=>$groups,'cid'=>$coursecode]);}
   else{
   return $this->render('courseGroups', ['groups'=>$groups,'cid'=>$coursecode]);
   }

 }

 public function actionDeleteGroups($groupgenerationid)
 {
   $deleted=new GroupGenerationTypes();
   $deleted::findOne($groupgenerationid)->delete();
   return $this->redirect(Yii::$app->request->referrer);

 }

 public function actionGetGentypes()
 {
    if(Yii::$app->request->isAjax) {
    $gentypes=new GroupGenerationTypes();
    $coursecode=Yii::$app->session->get('ccode');
    $generationtypes=$gentypes::find()->where(['course_code'=>$coursecode])->all();
    $gentypes_array=ArrayHelper::map($generationtypes,'typeID','generation_type');

    $response = Yii::$app->response;

    $response->format =Response::FORMAT_JSON;

    $response->data =json_encode($gentypes_array);

    $response->statusCode = 200;

    return $response;

    }
    else
    {
        throw new BadRequestHttpException();
    }


 }

 //getting groups

 public function actionGetGroups($genid)
 {
   
    if(Yii::$app->request->isAjax){
    $grp=new Groups();
    $groupobj=$grp::find()->where(['generation_type'=>$genid])->all();
    $groups_array=ArrayHelper::map($groupobj,'groupID','groupName');

    $response = Yii::$app->response;

    $response->format =Response::FORMAT_JSON;

    $response->data=json_encode($groups_array);

    $response->statusCode = 200;

    return $response;

    }
    else
    {
        throw new BadRequestHttpException();
    }


 }
 public function actionGetStudents()
 {
   
    if(Yii::$app->request->isAjax){
    $std=new StudentCourse();
    $coursecode=Yii::$app->session->get('ccode');
    $studentobj=$std::find()->where(['course_code'=>$coursecode])->all();
    $student_array=ArrayHelper::map($studentobj,'reg_no','reg_no');

    $response = Yii::$app->response;

    $response->format =Response::FORMAT_JSON;

    $response->data=json_encode($student_array);

    $response->statusCode = 200;

    return $response;

    }
    else
    {
        throw new BadRequestHttpException();
    }


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