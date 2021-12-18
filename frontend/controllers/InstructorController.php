<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\Assignment;
use common\models\Material;
use common\models\Submit;
use common\models\Chat;
use common\models\Instructor;
use common\models\Module;
use common\models\Student;
use common\models\Department;
use common\models\Program;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use common\models\InstructorCourse;
use common\models\StudentCourse;
use common\models\ProgramCourse;
use frontend\models\UploadAssignment;
use frontend\models\AssignCourse;
use frontend\models\UploadTutorial;
use frontend\models\AddPartner;
use frontend\models\UploadLab;
use frontend\models\UploadStudentHodForm;
use frontend\models\UploadStudentForm;
use frontend\models\CreateCourse;
use frontend\models\CreateProgram;
use frontend\models\UploadMaterial;
use frontend\models\PostAnnouncement;
use frontend\models\External_assess;
use frontend\models\AddAssessRecord;
use frontend\models\StudentGroups;
use frontend\models\TemplateDownloader;
use frontend\models\StudentTemplateDownload;
use frontend\models\CA;
use frontend\models\CreateChat;
use frontend\models\CA_previewer;
use frontend\models\UpdateCourse;
use frontend\models\StudentAssign;
use common\models\Groups;
use common\models\GroupGenerationTypes;
use common\models\Announcement;
use common\models\Assq;
use common\models\GroupAssignmentSubmit;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\StudentExtAssess;
use common\models\ExtAssess;
use common\models\User;
use common\models\QMarks;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\Security;
use yii\base\Exception;
use frontend\models\ClassRoomSecurity;
use common\models\Academicyear;
use frontend\models\AcademicYearManager;

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
                            'assign-course',
                            'courses',
                            'class-quizes',
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
                            'chat-index',
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
                            'instructor-course',
                            'delete-groups',
                            'get-gentypes',
                            'get-groups',
                            'get-students',
                            'add-student-gentype',
                            'mark',
                            'mark-inputing',
                            'import-external-assessment',
                            'view-assessment',
                            'add-assess-record',
                            'delete-ext-assrecord',
                            'edit-ext-assrecord-view',
                            'edit-ext-assrecord',
                            'download-extassess-template',
                            'download-stdexcell-template',
                            'delete-assessment',
                            'post-announcement',
                            'delete-announcement',
                            'generate-ca',
                            'ca-preview',
                            'get-incomplete-perc',
                            'get-student-count',
                            'get-carries-perc',
                            'get-pdf-ca',
                            'add-students',
                            'failed-assignments',
                            'missed-workmark',
                            'delete-material',
                            'update-assignment',
                            'class-dashboard',
                            'class-announcements',
                            'class-materials',
                            'class-assignments',
                            'class-labs',
                            'create-chat',
                            'class-tutorials',
                            'class-ext-assessments',
                            'class-ca-generator',
                            'class-students',
                            'create-module',
                            'material-upload-form',
                            'module-delete',
                            'mark-secure-redirect',
                            'remove-students',
                            'switch-academicyear',
                            'course-update-data',
                            'get-marked-perc'

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
                            'assign-course',
                            'dropcourse',
                            'classwork',
                            'create-student',
                            'create-course',
                            'create-program',
                            'student-list',
                            'view-groups',
                            'create-chat',
                            'class-quizes',
                            'upload-assignment',
                            'upload-tutorial',
                            'upload-lab',
                            'generate-groups',
                            'upload-material',
                            'assignments',
                            'delete',
                            'deletelab',
                            'deletetut',
                            'deletecoz',
                            'deleteprogcoz',
                            'deletestudent',
                            'deleteprog',
                            'materials',
                            'stdwork',
                            'stdworkmark',
                            'import-students',
                            'labwork',
                            'stdworklab',
                            'stdlabmark',
                            'update',
                            'instructor-course',
                            'updatetut',
                            'updatelab',
                            'updateprog',
                            'updatecoz',
                            'add-partner',
                            'view-assessment',
                            'add-assess-record',
                            'delete-ext-assrecord',
                            'edit-ext-assrecord-view',
                            'edit-ext-assrecord',
                            'download-extassess-template',
                            'download-stdexcell-template',
                            'delete-assessment',
                            'post-announcement',
                            'delete-announcement',
                            'generate-ca',
                            'ca-preview',
                            'get-incomplete-perc',
                            'get-student-count',
                            'get-carries-perc',
                            'get-pdf-ca',
                            'delete-groups',
                            'add-students',
                            'failed-assignments',
                            'missed-workmark',
                            'delete-material',
                            'update-assignment',
                            'class-dashboard',
                            'class-announcements',
                            'class-materials',
                            'class-assignments',
                            'class-labs',
                            'class-tutorials',
                            'chat-index',
                            'class-ext-assessments',
                            'class-ca-generator',
                            'class-students',
                            'create-module',
                            'material-upload-form',
                            'module-delete',
                            'updatestudent',
                            'mark-secure-redirect',
                            'remove-students',
                            'switch-academicyear',
                            'course-update-data',
                            'get-marked-perc'
                           
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
   
    //getting the courses
    $courses = Yii::$app->user->identity->instructor->courses;
    
    //traveling with all shit
    return $this->render('index', ['courses'=>$courses]);
    }


    //switching academic year

    public function actionSwitchAcademicyear()
    {
      $model=new AcademicYearManager;
      if($model->load(yii::$app->request->post()))
      {
          $res=$model->switchAcademicYear();
          if($res===true)
          {
              return $this->redirect(yii::$app->request->referrer);
          }
          else
          {
            Yii::$app->session->setFlash('error', 'Can\'t Switch academic year now');
            return $this->redirect(yii::$app->request->referrer);
          }
      }

    }
    //#################### function to render instructor courses ##############################

    public function actionCourses(){
        $courses = Course::find()->all();

        return $this->render('courses', ['courses'=>$courses]);
        
    }
 

  public function actionAddAssessRecord($assessid)
  {
    $record=new AddAssessRecord();
    $record->assessid=$assessid;
    
    if($record->load(yii::$app->request->post()))
    {
       $recres=$record->add_new_record();
     
      if($recres===false)
      {
        Yii::$app->session->setFlash('error', 'Record adding failed');
        return $this->redirect(Yii::$app->request->referrer); 
      }
      else
      {
        if(empty($recres))
        {
            Yii::$app->session->setFlash('success', 'New record added successfully');
            return $this->redirect(Yii::$app->request->referrer);  
        }
        else
        {
          $resp="New record adding failed ";
          foreach($recres as $p=>$v)
          {
            $resp.=$p." ".$v;
          }
          Yii::$app->session->setFlash('error',$resp);
          return $this->redirect(Yii::$app->request->referrer);  

        } 
      }
    }
  }

  public function actionDownloadExtassessTemplate($coursecode)
  {
    $downloader=new TemplateDownloader();
    $downloader->courseCode=$coursecode;
    if($downloader->excelProduce()){ return $this->redirect(Yii::$app->request->referrer); }
    else{
        Yii::$app->session->setFlash('error', 'downloading failed');
        return $this->redirect(Yii::$app->request->referrer); 
    }

  }

  public function actionChatIndex($stdid)
  {
    $model = new CreateChat;
    $sender = Yii::$app->user->identity->instructor->instructorID;
    $username = $stdid;
    return $this->render('chat_index',['username'=>$username,'sender'=>$sender, 'model'=>$model]);
  }

  public function actionViewChat()
  {
    $chats = Chat::find()->all();
    $sender = Yii::$app->user->identity->instructor->instructorID;
    $username = $stdid;
    return $this->render('chat_index',['username'=>$username,'sender'=>$sender, 'model'=>$model]);
  }


     //Create chat
     public function actionCreateChat($stdid){
        $model = new CreateChat;
        $sender = Yii::$app->user->identity->instructor->instructorID;
        $username = $stdid;
        
        $chats = Chat::find()->where(['instructorID'=>$sender, 'reg_no'=>$username])->all();
       // $programs = Program::find()->all();
        try{
        
        if($model->load(Yii::$app->request->post())){
            if($model->create()){
                //print_r(Yii::$app->request->post());
            Yii::$app->session->setFlash('success', 'Chat added successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
               Yii::$app->session->setFlash('error','something went wrong.');
               return $this->redirect(Yii::$app->request->referrer);
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
        return $this->redirect(Yii::$app->request->referrer);
    }
        return $this->render('chat_index', ['model'=>$model, 'username'=>$username, 
        'sender'=>$sender, 'chats'=>$chats]);
    }

    


  public function actionDownloadStdexcellTemplate()
  {
    $downloader=new StudentTemplateDownload();
    
    if($downloader->excelProduce()){ return $this->redirect(Yii::$app->request->referrer); }
    else{
        Yii::$app->session->setFlash('error', 'downloading failed');
        return $this->redirect(Yii::$app->request->referrer); 
    }

  }

  public function actionDeleteAssessment($assessid)
  {
    $assess=ExtAssess::findOne($assessid);
    if($assess->delete())
    {
        return $this->asJson(['message'=>'Assessment deleted']);

    }
    else
    {
        return $this->asJson(['message'=>'deleting failed']); 
    }

  }
   
public function actionEditExtAssrecordView($recordid)
{
$secretKey=Yii::$app->params['app.dataEncryptionKey'];
$recordid=Yii::$app->getSecurity()->decryptByPassword($recordid, $secretKey);
  $record=StudentExtAssess::findOne($recordid);

  $secretKey=Yii::$app->params['app.dataEncryptionKey'];
  $recordid=Yii::$app->getSecurity()->encryptByPassword($recordid, $secretKey); 

  return $this->render('editassessrecord',['recordid'=>$recordid,'regno'=>$record->reg_no,'score'=>$record->score]);
}
public function actionEditExtAssrecord($recordid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    //$recordid=Yii::$app->getSecurity()->decryptByPassword($recordid, $secretKey);
    $record=new AddAssessRecord();
    $assid=StudentExtAssess::findOne($recordid)->assessID;
    
    $record->assessid=$assid;
    $assid=Yii::$app->getSecurity()->encryptByPassword($assid, $secretKey);
    if($record->load(yii::$app->request->post()))
    {
       $recres=$record->editrecord($recordid);
     
      if($recres===false)
      {
        Yii::$app->session->setFlash('error', 'Record updating failed');
        return $this->redirect(Yii::$app->request->referrer); 
      }
      else
      {
        if(empty($recres))
        {
            Yii::$app->session->setFlash('success', 'Record updated successfully');
            return $this->redirect(['view-assessment','assid'=>$assid]);  
        }
        else
        {
          $resp="Record updating failed ";
          foreach($recres as $p=>$v)
          {
            $resp.=$v;
          }
          Yii::$app->session->setFlash('error',$resp);
          return $this->redirect(Yii::$app->request->referrer);  

        }
        
        
      }




    }
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
                Yii::$app->session->setFlash('success', 'Course assigned successfully');
                return $this->redirect(Url::toRoute('/instructor/courses'));
            }
        }

        }
    }


    //announcement

    public function actionPostAnnouncement()
    {
      $model=new PostAnnouncement();

      if($model->load(yii::$app->request->post()))
      {

         if($model->announce()){Yii::$app->session->setFlash('success', 'Announcement posted');return $this->redirect(Yii::$app->request->referrer);}
         else{Yii::$app->session->setFlash('error', 'Announcement failed');return $this->redirect(Yii::$app->request->referrer);}



      }
      else
      {
        Yii::$app->session->setFlash('error', 'Announcement failed'); 
        return $this->redirect(Yii::$app->request->referrer); 
      }



    }

    public function actionDeleteAnnouncement($annid)
    {
       $ann=Announcement::findOne($annid);
       if($ann->delete()){

        return $this->asJson(['message'=>'announcement deleted']);
       }
       else{
        return $this->asJson(['message'=>'deleting failed']);

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
            return $this->asJson(['message'=>'Assignment deleted']);
        }
        else
        {
            return $this->asJson(['message'=>'deleting failed']);  
        }
       
    }

    public function actionDeletelab($id)
    {
        $lab = Assignment::findOne($id)->delete(); 
        if($lab){
           Yii::$app->session->setFlash('success', 'Lab deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeletecoz($id)
    {
        $cozdel = Course::findOne($id)->delete(); 
        if($cozdel){
           Yii::$app->session->setFlash('success', 'Course deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    } 

    public function actionDeleteprogcoz($id)
    {
        $progcozdel = ProgramCourse::findOne($id)->delete(); 
        if($progcozdel){
           Yii::$app->session->setFlash('success', 'Program removed from course successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    } 

    public function actionDeleteprog($id)
    {
        $progdel = Program::findOne($id)->delete(); 
        if($progdel){
           Yii::$app->session->setFlash('success', 'Program deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeletestudent($id)
    {
        $stddel = User::findOne(['username'=>$id]);
        $std_id = $stddel->id; 
        $std_delete = User::findOne($std_id)->delete();
        if($std_delete){
            $std_tbl = Student::findOne($id)->delete();
            Yii::$app->session->setFlash('success', 'Student deleted successfully');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeletetut($id)
    {
        $tut = Assignment::findOne($id)->delete(); 
        if($tut){
            return $this->asJson(['message'=>'tutorial deleted']);
        }

    }

    public function actionUpdate($id)
    {
        $ass = Assignment::findOne(ClassRoomSecurity::decrypt($id));
        $assmodel = new UploadAssignment();
     
        return $this->render('assignments/update_assignment', ['ass'=>$ass,'assmodel'=>$assmodel]);
       
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


    public function actionUpdateprog($progid)
    {
        $prog = Program::findOne($progid);
        $dept = $prog -> departmentID;
        $dept_id = Department::find('departmentID',$dept);
        $prog ->departmentID = $dept;
        $departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
        if($prog->load(Yii::$app->request->post()) && $prog->save())
        {
            
            Yii::$app->session->setFlash('success', 'Program updated successfully');
           return $this->redirect(['create-program']);
        }else{
        return $this->render('updateprog', ['prog'=>$prog, 'departments'=>$departments]);
        }
    }


public function actionUpdatecoz($cozzid)
{
    
    $coz = Course::findOne($cozzid);
    $dep= $coz ->departmentID;
   
    $depts = Department::find()->all();
   
    $departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
    $programs =ArrayHelper::map(ProgramCourse::find()->where(['course_code'=>$cozzid])->all(), 'programCode', 'programCode');

    return $this->render('updatecoz', ['coz'=>$coz, 'programs'=>$programs, 
    'depts'=>$depts, 'departments'=>$departments]);
}

public function actionCourseUpdateData($cozzid)
{
    
    try
    {
    $coz =Course::findOne($cozzid);
    if($coz->load(Yii::$app->request->post()) && $coz->save())
    {
        
        Yii::$app->session->setFlash('success', 'course updated successfully');
        return $this->redirect(['create-course']);
    }
    else
    {
        throw new Exception("could not update course");
    }
}
catch(Exception $d)
{
    Yii::$app->session->setFlash('error',$d->getMessage()); 
    return $this->redirect(yii::$app->request->referrer);
}
}

    public function actionUpdatestudent($id)
    {
        
        $model = Student::findOne($id);
        $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
        // $departments = Yii::$app->user->identity->hod->department;
        $departments = ArrayHelper::map(Department::find()->where(['departmentID'=> Yii::$app->user->identity->instructor->department->departmentID])->all(), 'depart_abbrev', 'depart_abbrev');
        $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
        if($model->load(Yii::$app->request->post()) && $model->save())
        {
           Yii::$app->session->setFlash('success', 'Student updated successfully');
           return $this->redirect(['student-list']);
        }else{
        return $this->render('updatestudent', ['model'=>$model, 'programs'=>$programs, 'departments'=>$departments, 'roles'=>$roles ]);
        }
    }



//############################### classwork  #######################################################
public function actionClassDashboard($cid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    Yii::$app->session->set('ccode', $cid);

    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->encryptByPassword($cid, $secretKey);

    return $this->render('classdashboard', ['cid'=>$cid]);

}
//announcement page

public function actionClassAnnouncements($cid)
{
   
    return $this->render('announcements', ['cid'=>$cid]);

}
//material page

public function actionClassMaterials($cid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);
    $materials = Module::find()->where(['course_code' => $cid])->orderBy([
        'moduleID' => SORT_DESC ])->all();


    return $this->render('classmaterials', ['cid'=>$cid,'modules'=>$materials]);

}
//material upload form

public function actionMaterialUploadForm($moduleID)
{
 
    return $this->render('materials/create_material',['moduleID'=>$moduleID]);


}

//create module

public function actionCreateModule()
    {
        $model = new Module();
        $model->course_code=yii::$app->session->get('ccode');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'module created successfully');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    //deleting a module

    public function actionModuleDelete($moduleid)
    {

        $module=Module::findOne($moduleid);

        if($module->delete()){ 
            return $this->asJson(['message'=>'Module deleted successfully']);
           
        }
        else{
            Yii::$app->session->setFlash('error', 'module deleting failed');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
//assignments page
public function actionClassAssignments($cid)
{
  
    $yearid=(yii::$app->session->get('currentAcademicYear'))->yearID;
    $assignments = Assignment::find()->where(['assNature' => 'assignment', 'course_code' =>ClassRoomSecurity::decrypt($cid),'yearID'=>$yearid])->orderBy([
        'assID' => SORT_DESC ])->all();
    return $this->render('classAssignments', ['cid'=>$cid,'assignments'=>$assignments]);

}

//lab assignments page

public function actionClassLabs($cid)
{
    $assignments = Assignment::find()->where(['assNature' => 'lab', 'course_code' =>ClassRoomSecurity::decrypt($cid)])->orderBy([
        'assID' => SORT_DESC ])->all();
    return $this->render('classLabAssignments', ['cid'=>$cid,'assignments'=>$assignments]);

}

//tutorial page

public function actionClassTutorials($cid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->orderBy([
        'assID' => SORT_DESC])->all();
    return $this->render('tutorials', ['cid'=>$cid,'tutorials'=>$tutorials]);

}

//external assessments page

public function actionClassExtAssessments($cid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    return $this->render('classExtAssessments',['cid'=>$cid]);

}

//CA generator page

public function actionClassCaGenerator($cid)
{
        $secretKey=Yii::$app->params['app.dataEncryptionKey'];
        $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);
    
        return $this->render('classCAgenerator',['cid'=>$cid]);

}

//students page

public function actionClassStudents($cid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    return $this->render('class_students',['cid'=>$cid]);

}

//Quizes page

public function actionClassQuizes()
{
    return $this->render('quiz/quiz_view');

}

//live lecturing page

public function actionClassLecturing($cid)
{
    $materials = Material::find()->where(['course_code' => $cid])->orderBy([
        'material_ID' => SORT_DESC ])->all();
    return $this->render('classmaterials', ['cid'=>$cid,'materials'=>$materials]);

}

//class forum page

public function actionClassForum($cid)
{
    $materials = Material::find()->where(['course_code' => $cid])->orderBy([
        'material_ID' => SORT_DESC ])->all();
    return $this->render('classmaterials', ['cid'=>$cid,'materials'=>$materials]);

}

////////////////////////////////////////////////////

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
   Yii::$app->session->set('ccode', ClassRoomSecurity::decrypt($cid));
    }
    $submits=null;
    $asstype=Assignment::findOne(ClassRoomSecurity::decrypt($id))->assType;
    if($asstype=="allgroups" || $asstype=="groups")
    {
     $submits =GroupAssignmentSubmit::find()->where(['assID'=>ClassRoomSecurity::decrypt($id)])->all();
    }
    else
    {
    $submits = Submit::find()->where(['assID'=>ClassRoomSecurity::decrypt($id)])->all();
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

    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    if(!empty($cid)){
      Yii::$app->session->set('ccode', $cid);
    }
    
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $id=Yii::$app->getSecurity()->decryptByPassword($id, $secretKey);

    $model=null;
    $asstype=Assignment::findOne($id)->assType;
    if($asstype=="groups" || $asstype=="allgroups"){$model=new GroupAssignmentSubmit();}
    else{$model=new Submit();}
    $submits =$model->find()->where(['assID'=> $id])->all();


    $courses = Yii::$app->user->identity->instructor->courses;

    return $this->render('stdworkmark', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits]);

}
public function actionMissedWorkmark($cid, $id){

    
    if(!empty($cid)){
      Yii::$app->session->set('ccode', ClassRoomSecurity::decrypt($cid));
    }
    
    $assign=Assignment::findOne(ClassRoomSecurity::decrypt($id));
            $submits=[];
            $assigned=[];

            $submitted=[];
            $assignass=[];
            if($assign->assType=="groups"){
                $submits=$assign->groupAssignmentSubmits;

                foreach($submits as $single)
                {
                    $submitted[$single->group->groupName]=$single->group->groupName;
                }
                $assigned=$assign->groupAssignments;

                foreach($assigned as $single)
                {
                    $assignass[$single->group->groupName]=$single->group->groupName;
                }
            
            }
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              foreach($submits as $single)
              {
                  $submitted[$single->group->groupName]=$single->group->groupName;
              }
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){
                  $assigned=$gentypes[$gen]->gentype->groups;

                  foreach($assigned as $single)
                  {
                    $assignass[$single->groupName]=$single->groupName;  
                  }
                }
            }
            else if($assign->assType=="allstudents"){
			  $submits=$assign->submits;
              $assigned=$assign->courseCode->studentCourses;
              $assignass=ArrayHelper::map($assigned,'reg_no','reg_no');
              $submitted=ArrayHelper::map($submits,'reg_no','reg_no');
              $assignedprog=$assign->courseCode->programCourses;
              
      
              for($p=0;$p<count($assignedprog);$p++)
              {
                foreach($assignedprog[$p]->programCode0->students as $stud)
                {
                $assignass[$stud->reg_no]=$stud->reg_no;
                }
              }}
            else{
                $submits=$assign->submits;
                $submitted=ArrayHelper::map($submits,'reg_no','reg_no');
                $assigned=$assign->studentAssignments;
                $assignass=ArrayHelper::map($assigned,'reg_no','reg_no');
            } 
            
            $missing=array_diff_assoc($assignass,$submitted);
         
    return $this->render('missingassview', ['cid'=>$cid, 'id'=>$id,'missing' => $missing]);

}

public function actionDeleteMaterial($matid)
{
    $material=Material::findOne($matid);
    if($material->delete()){
       
            return $this->asJson(['message'=>'Material deleted']);
         
    }else{
        Yii::$app->session->setFlash('error', 'deleting failed');
        return $this->redirect(Yii::$app->request->referrer);
    }
}
public function actionFailedAssignments($cid, $id){

    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    if(!empty($cid)){
      Yii::$app->session->set('ccode', $cid);
    }
    
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $id=Yii::$app->getSecurity()->decryptByPassword($id, $secretKey);


    $model=null;
    $asstype=Assignment::findOne($id)->assType;
    if($asstype=="groups" || $asstype=="allgroups"){$model=new GroupAssignmentSubmit();}
    else{$model=new Submit();}
    $submits =$model->find()->where(['assID'=> $id])->all();


    $courses = Yii::$app->user->identity->instructor->courses;

    return $this->render('failedassignments', ['cid'=>$cid, 'id'=>$id, 'courses'=>$courses, 'submits' => $submits]);

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
          
        Yii::$app->session->setFlash('error',"Assignment creating failed unexpectedly, please try again");
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}
///update assignment

public function actionUpdateAssignment($assid){
    
    $model = new UploadAssignment();
    
    if($model->load(Yii::$app->request->post())){
    
    //loading the external post data into the model
    $model->questions_maxima=Yii::$app->request->post('q_max');
    if($model->assType=="allgroups"){$model->generation_type=Yii::$app->request->post('gentypes');}
    else if($model->assType=="groups"){$model->generation_type=Yii::$app->request->post('gentypes');$model->groups=Yii::$app->request->post('gengroups');}
    else if($model->assType=="students"){$model->students=Yii::$app->request->post('mystudents');}else{}
  
        $model->the_assignment=Yii::$app->request->post('the_assignment');
       
 
    
        if($model->update($assid)){
        Yii::$app->session->setFlash('success', 'Assignment updated successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
            print_r($model->getErrors());
        Yii::$app->session->setFlash('error', 'Something went wrong during updating');
       
        return $this->redirect(Yii::$app->request->referrer);
    }
}
}
public function actionImportExternalAssessment()
{
  $importmodel=new External_assess();
  if($importmodel->load(Yii::$app->request->post())){

    $importmodel->assFile=UploadedFile::getInstance($importmodel, 'assFile');
    $importmodel->filetmp=UploadedFile::getInstance($importmodel, 'assFile')->tempName;
    $act=$importmodel->excel_importer();
    if($act!==false)
    {
        $flash="Import successful with ".count($act)." error(s)";
        if($act!=null){
           foreach($act as $reg=>$msg)
           {
               $flash=$flash."<br>'".$reg."'=>".$msg;
           }
        }
        Yii::$app->session->setFlash('success', $flash);
        
        return $this->redirect(Yii::$app->request->referrer);
    }
    else
    {
        Yii::$app->session->setFlash('error', 'Importing failed, you may need to download the standard format or change the assessment title');
        return $this->redirect(Yii::$app->request->referrer);
    }
  }
  else
  {
    Yii::$app->session->setFlash('error', 'unknown error occurred, try again later');
   return $this->redirect(Yii::$app->request->referrer);
  }

    
}


public function actionImportStudents()
{
  $importmodel=new UploadStudentForm();
  if($importmodel->load(Yii::$app->request->post())){

    $importmodel->assFile=UploadedFile::getInstance($importmodel, 'assFile');
    $importmodel->filetmp=UploadedFile::getInstance($importmodel, 'assFile')->tempName;
    $act=$importmodel->excelstd_importer();
    if($act!==false)
    {
        $flash="Import successful with ".count($act)." error(s)";
        if($act!=null){
           foreach($act as $reg=>$msg)
           {
               $flash=$flash."<br>'".$reg."'=>".$msg;
           }
        }
        Yii::$app->session->setFlash('success', $flash);
        
          return $this->redirect(Yii::$app->request->referrer);
    }
    else
    {
        Yii::$app->session->setFlash('error', 'Importing failed, you may need to download the standard format');
          return $this->redirect(Yii::$app->request->referrer);
    }
  }
  else
  {
    Yii::$app->session->setFlash('error', 'unknown error occurred, try again later');
    return $this->redirect(Yii::$app->request->referrer);
  }

    
}

public function actionViewAssessment($assid)
{

    return $this->render('assessmentview',['assid'=>$assid]);  

}
public function actionDeleteExtAssrecord($recordid)
{
  $record=StudentExtAssess::findOne($recordid);
  if($record->delete())
  {
    Yii::$app->session->setFlash('success', 'deleted successfully');
    return $this->redirect(Yii::$app->request->referrer);
  }
  else
  {
    Yii::$app->session->setFlash('error', 'record not deleted');
    return $this->redirect(Yii::$app->request->referrer);
  }

}
//######################## function to create tutorial ###############################################

public function actionUploadTutorial(){
    $model = new UploadTutorial();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        if($model->upload()){
        Yii::$app->session->setFlash('success', 'Tutorial created successfully');
        //print_r($model->getErrors());
        return $this->redirect(Yii::$app->request->referrer);
        }else{
            print_r($model->getErrors());
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

        try{

       
       $res=$model->upload();
        if($res===true){
            
            $secretKey=Yii::$app->params['app.dataEncryptionKey'];
            $cid=Yii::$app->getSecurity()->encryptByPassword(yii::$app->session->get('ccode'),$secretKey);
            Yii::$app->session->setFlash('success', 'Material uploaded successfully');
            return $this->redirect(['class-materials','cid'=>$cid]);
        }
}
catch(Exception $d)
{
    Yii::$app->session->setFlash('error',$d->getMessage());
        
         
    return $this->redirect(Yii::$app->request->referrer); 
}
}
}
public function actionMarkSecureRedirect($id,$subid=null)
{
  return $this->redirect(['mark','id'=>ClassRoomSecurity::encrypt($id),'subid'=>ClassRoomSecurity::encrypt($subid)]);
}
public function actionMark($id,$subid=null)
{
    //loading the current assignment
    $id=ClassRoomSecurity::decrypt($id);
    $subid=ClassRoomSecurity::decrypt($subid);
    $submit=[];
    $assignment=new Assignment();
    $current_assignment=$assignment::findOne($id);
    $model=null;
    $asstype=$current_assignment->assType;
    if($asstype=="group" || $asstype=="allgroups")
    {
        $model=new GroupAssignmentSubmit();
        
        
    }
    else
    {
        $model=new Submit();
    }

    if($model!==null){$submit=$model->find()->where(['submitID'=>$subid])->all();}
   
    return $this->render('marking',['assignment'=>$current_assignment,'singlesub'=>$submit]);  
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
    if($asstype=="group" || $asstype=="allgroups")
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
    $qmark=Qmarks::find()->where(['submitID'=>$submit->submitID,'assq_ID'=>$qids[$sc]])->one();
    if($qmark===null || empty($qmark)){$qmark=new Qmarks();}
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

public function actionGetMarkedPerc($ass)
{
    $assignment=Assignment::findOne(intval($ass));
    $markedperc=round($assignment->getMarkedAssignmentsPerc(),2);

    return $this->asJson($markedperc);
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
    Yii::$app->session->setFlash('error', 'unkown error occured');
    return $this->redirect(Yii::$app->request->referrer);  
  }

  }
}

}

//########################### creating student groups ################################


public function actionGenerateGroups()
{
    ini_set('max_execution_time', 200);
    $model = new StudentGroups();
    if($model->load(Yii::$app->request->post())){
      try
      {
     if($model->generateRandomGroups()===true)
     {

        Yii::$app->session->setFlash('success', 'Groups generated successfully');
        return $this->redirect(Yii::$app->request->referrer);
     }
      }
      catch(Exception $d)
      {
        Yii::$app->session->setFlash('error', $d->getMessage());
        return $this->redirect(Yii::$app->request->referrer); 
      }
 
     }

}
//students group types

public function actionAddStudentGentype()
{
 
    $model = new StudentGroups();
    if($model->load(Yii::$app->request->post()) && $model->validate()){
     $res=$model->addstudenttype();
     if($res===true)
     {

        Yii::$app->session->setFlash('success', 'Student-groups type added successfully');
        return $this->redirect(Yii::$app->request->referrer);
     }
     else{

        $resp="";
        foreach($res as $key)
        {
            for($c=0;$c<count($key);$c++)
            {
                $resp.=$key[$c];
            }
        }
        Yii::$app->session->setFlash('error', 'Student-groups type adding failed...<br>'.$resp);
        return $this->redirect(Yii::$app->request->referrer);
     }
 
     }

}

 public function actionViewGroups()
 {
    ini_set('max_execution_time', 200);
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
   $deleted=GroupGenerationTypes::findOne($groupgenerationid);
   if($deleted->delete()){

    return $this->asJson(['message'=>'Deleted']);
    return $this->redirect(Yii::$app->request->referrer);
   }
   else
   {
    Yii::$app->session->setFlash('error','Deleting failed');
    return $this->redirect(Yii::$app->request->referrer); 
   }
   

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
  

    $students=[];

    $coursePrograms=ProgramCourse::find()->where(['course_code'=>$coursecode])->all();
    foreach($coursePrograms as $program)
    {

    $programStudents=$program->programCode0->students;

    for($s=0;$s<count($programStudents);$s++){array_push($students,$programStudents[$s]);}


    }
    $carryovers=StudentCourse::find()->where(['course_code'=>$coursecode])->all(); 
    foreach($carryovers as $carry)
    {
    array_push($students,$carry->regNo);
    }

    $student_array=ArrayHelper::map($students,'reg_no','reg_no');

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
 ////////////////////////// the CA //////////////////////////////

 public function actionGenerateCa()
 {
   $model=new CA();
   
   $model->Assignments=yii::$app->request->post("CA")["Assignments"];
   $model->LabAssignments=yii::$app->request->post("CA")["LabAssignments"];
   $model->otherAssessments=yii::$app->request->post("CA")["otherAssessments"];
   $model->assreduce=yii::$app->request->post("CA")["assreduce"];
   $model->labreduce=yii::$app->request->post("CA")["labreduce"];
   $model->otherassessreduce=yii::$app->request->post("CA")["otherassessreduce"];
  
   $res=$model->generateExcelCA();
   if($res!==true){Yii::$app->session->setFlash('error',$res);}

   return $this->redirect(Yii::$app->request->referrer); 
  
    

 

 }
 public function actionGetPdfCa()
 {
    $model=new CA();
   
    $model->Assignments=yii::$app->request->post("CA")["Assignments"];
    $model->LabAssignments=yii::$app->request->post("CA")["LabAssignments"];
    $model->otherAssessments=yii::$app->request->post("CA")["otherAssessments"];
    $model->assreduce=yii::$app->request->post("CA")["assreduce"];
    $model->labreduce=yii::$app->request->post("CA")["labreduce"];
    $model->otherassessreduce=yii::$app->request->post("CA")["otherassessreduce"];
   
    $res=$model->generatePdfCA();
    if($res!=null){Yii::$app->session->setFlash('error',$res);}
    return $this->redirect(Yii::$app->request->referrer); 
    
 }
 public function actionCaPreview()
 {
    $model=new CA_previewer();
    if(Yii::$app->request->isAjax){
    $model->Assignments=yii::$app->request->post("CA")["Assignments"];
    $model->LabAssignments=yii::$app->request->post("CA")["LabAssignments"];
    $model->otherAssessments=yii::$app->request->post("CA")["otherAssessments"];
    $model->assreduce=yii::$app->request->post("CA")["assreduce"];
    $model->labreduce=yii::$app->request->post("CA")["labreduce"];
    $model->otherassessreduce=yii::$app->request->post("CA")["otherassessreduce"];
   
    $data=$model->previewCA();
    print $data;
    }
 }
 public function actionGetIncompletePerc()
 {
    $model=new CA();
    if(Yii::$app->request->isAjax){
    $model->Assignments=yii::$app->request->post("CA")["Assignments"];
    $model->LabAssignments=yii::$app->request->post("CA")["LabAssignments"];
    $model->otherAssessments=yii::$app->request->post("CA")["otherAssessments"];
    $model->assreduce=yii::$app->request->post("CA")["assreduce"];
    $model->labreduce=yii::$app->request->post("CA")["labreduce"];
    $model->otherassessreduce=yii::$app->request->post("CA")["otherassessreduce"];
   
    $data=$model->getincompleteperc();
    print $data;
    }

 }
 public function actionGetStudentCount()
 {
    $model=new CA();
    if(Yii::$app->request->isAjax){
    $model->Assignments=yii::$app->request->post("CA")["Assignments"];
    $model->LabAssignments=yii::$app->request->post("CA")["LabAssignments"];
    $model->otherAssessments=yii::$app->request->post("CA")["otherAssessments"];
    $model->assreduce=yii::$app->request->post("CA")["assreduce"];
    $model->labreduce=yii::$app->request->post("CA")["labreduce"];
    $model->otherassessreduce=yii::$app->request->post("CA")["otherassessreduce"];
   
    $data=$model->get_no_of_student();
    print $data;
    }  
 }
 public function actionGetCarriesPerc()
 {
    $model=new CA();
    if(Yii::$app->request->isAjax){
    $model->Assignments=yii::$app->request->post("CA")["Assignments"];
    $model->LabAssignments=yii::$app->request->post("CA")["LabAssignments"];
    $model->otherAssessments=yii::$app->request->post("CA")["otherAssessments"];
    $model->assreduce=yii::$app->request->post("CA")["assreduce"];
    $model->labreduce=yii::$app->request->post("CA")["labreduce"];
    $model->otherassessreduce=yii::$app->request->post("CA")["otherassessreduce"];
   
    $data=$model->getCarriedPercent();
    print $data;
    }  
 }
 public function actionAddStudents()
 {
   
    $model = new StudentAssign();
    if($model->load(Yii::$app->request->post()) && $model->validate()){
    $returned=$model->assignStudents();
     if(empty($returned))
     {

        Yii::$app->session->setFlash('success', 'Program added successfully');
        return $this->redirect(Yii::$app->request->referrer);
     }
     else{
        
        $errors="Error(s) detected during assigning:";
        foreach($returned as $prog=>$error)
        {
            $errors.="<br>".$prog.": ".$error;
        }
        Yii::$app->session->setFlash('success',$errors);
        return $this->redirect(Yii::$app->request->referrer);
     }
 
     }


 }

 public function actionRemoveStudents()
 {
   
    $model = new StudentAssign();
    if($model->load(Yii::$app->request->post()) && $model->validate()){
    $returned=$model->removeStudents();
     if(empty($returned))
     {

        Yii::$app->session->setFlash('success', 'Programs removed successfully');
        return $this->redirect(Yii::$app->request->referrer);
     }
     else{
        
        $errors="Error(s) detected during removing:";
        foreach($returned as $prog=>$error)
        {
            $errors.="<br>".$prog.": ".$error;
        }
        Yii::$app->session->setFlash('success',$errors);
        return $this->redirect(Yii::$app->request->referrer);
     }
 
     }


 }

//#################################### HOD HERE ########################################################################

  //create students
  public function actionCreateStudent(){
    $model = new UploadStudentHodForm;
    $roles = ArrayHelper::map(AuthItem::find()->where(['name'=>'STUDENT'])->all(), 'name', 'name');
    // $departments = Yii::$app->user->identity->hod->department;
    $departments = ArrayHelper::map(Department::find()->where(['departmentID'=> Yii::$app->user->identity->instructor->department->departmentID])->all(), 'depart_abbrev', 'depart_abbrev');
    try{
    $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
    if($model->load(Yii::$app->request->post())){
       
        if($model->create()){
        Yii::$app->session->setFlash('success', 'Student registered successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
            Yii::$app->session->setFlash('error', 'Something went Wrong!');
        }
   
            
     } 
    
}catch(\Exception $e){
    Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
}
    return $this->render('create_student', ['model'=>$model, 'programs'=>$programs, 'departments'=>$departments, 'roles'=>$roles]);
}

//get list of students for particular department

public function actionStudentList(){
    $instructorid = Yii::$app->user->identity->instructor->instructorID;
    $myinstructor=Instructor::findOne($instructorid);
    $instructor_department= $myinstructor->department;
    $programs=$instructor_department->programs;
    $students=[];
    for($p=0;$p<count($programs);$p++)
    {
        $program_students=$programs[$p]->students;
        array_push($students,$program_students);
    }
    return $this->render('student_list', ['students'=>$students]);
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
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error','something went wrong. This program may already exists.');
            }
       
                
         } 
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
    }
        return $this->render('prog_modal', ['model'=>$model, 'departments'=>$departments, 'programs'=>$programs]);
    }


     //Create Course
     public function actionCreateCourse(){
        //print_r(Yii::$app->request->post());
        $model = new CreateCourse;
        $coz = ArrayHelper::map(Course::find()->all(), 'course_code', 'course_code');
        $courses = Course::find()->all();
        $departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
        $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
        try{
        //$departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
       
        if($model->load(Yii::$app->request->post())){

            if($model->create()){
            Yii::$app->session->setFlash('success', 'Course added successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error','something went wrong. This course may exists');
                
               // return $this->redirect(Yii::$app->request->referrer);
            }    
         } 
         else
         {
              
            
         }
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
        return $this->redirect(Yii::$app->request->referrer);
    }
        return $this->render('create-course', ['model'=>$model, 'coz'=>$coz, 'courses'=>$courses, 'programs'=>$programs, 'departments'=>$departments]);
    }

    public function actionAssignCourse(){
        //print_r(Yii::$app->request->post());
        $model = new AssignCourse;
        $cozz = Course::find()->all();
        $progcozz = ProgramCourse::find()->all();
        $courses = ArrayHelper::map(Course::find()->all(), 'course_code', 'course_code');
        
        $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
        try{
        //$departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
        if($model->load(Yii::$app->request->post())){
            if($model->create()){
            Yii::$app->session->setFlash('success', 'Course assigned successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
               print_r($model->getErrors());
                // Yii::$app->session->setFlash('error', 'no no no');
                // return $this->redirect(Yii::$app->request->referrer);
            }
       
                
         } 
         else
         {
             
             
         }
        
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong'.$e->getMessage());
         return $this->redirect(Yii::$app->request->referrer);
    }
        return $this->render('assign-course', ['model'=>$model, 'courses'=>$courses, 'programs'=>$programs, 
                            'cozz'=>$cozz, 'progcozz'=>$progcozz]);
    }

    public function actionInstructorCourse()
    {
         $instructorid = Yii::$app->user->identity->instructor->instructorID;
         $myinstructor=Instructor::findOne($instructorid);
         $instructor_department= $myinstructor->department->departmentID;
  /*     $instructors = ArrayHelper::map(Instructor::find()->where(['departmentID'=>])->all(), 'name', 'name'); */
         $instructors = Instructor::findAll(array('departmentID'=> $instructor_department));
      

       return $this->render('instructor-course', [ 'instructors'=>$instructors]);
    }
}