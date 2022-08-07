<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Course;
use common\models\QuizThread;
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
use frontend\models\CreateShortCourse;
use frontend\models\CreateProgram;
use frontend\models\UploadMaterial;
use frontend\models\PostAnnouncement;
use frontend\models\External_assess;
use frontend\models\AddAssessRecord;
use frontend\models\StudentGroups;
use frontend\models\TemplateDownloader;
use frontend\models\StudentTemplateDownload;
use frontend\models\CA;
use frontend\models\CourseStudents;
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
use yii\helpers\Html;
use yii\web\UploadedFile;
use common\helpers\Security;
use yii\base\Exception;
use frontend\models\ClassRoomSecurity;
use common\models\Academicyear;
use frontend\models\AcademicYearManager;
use yii\grid\GridView;
use frontend\models\ClassroomMutex;
use frontend\models\ClassRoomChatManager;
use frontend\models\ReceiptManager;
use common\models\SubmitSignatures;

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
                            'get-marked-perc',
                            'change-marking-mode',
                            'get-assignment-lock',
                            'release-assignment-lock',
                            'toggle-collaboration',
                            'leave-marking-collaboration',
                            'download-submits',
                            'publish-assignment-results',
                            'get-assignment-stat',
                            'share-link',
                            'toggle-panelist',
                            'set-panelist-off',
                            'get-online-mates',
                            'send-text',
                            'load-thread',
                            'set-thread-read',
                            'get-thread-stats',
                            'clear-thread',
                            'send-signal',
                            'find-signal',
                            'withdraw-signal',
                            'partners',
                            'remove-partner',
                            'ca-save',
                            'ca-save-published',
                            'publish-ca',
                            'delete-ca',
                            'ca-add-new',
                            'receipt-validator'

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
                            'create-short-course',
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
                            'delete-instructor-coz',
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
                            'remove-instructor-course',
                            'updatetut',
                            'updatelab',
                            'updateprog',
                            'updatecoz',
                            'view-coz',
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
                            'view-chats',
                            'material-upload-form',
                            'module-delete',
                            'updatestudent',
                            'mark-secure-redirect',
                            'remove-students',
                            'switch-academicyear',
                            'course-update-data',
                            'get-marked-perc',
                            'change-marking-mode',
                            'get-assignment-lock',
                            'release-assignment-lock',
                            'toggle-collaboration',
                            'leave-marking-collaboration',
                            'download-submits',
                            'publish-assignment-results',
                            'get-assignment-stat',
                            'share-link',
                            'toggle-panelist',
                            'set-panelist-off',
                            'get-online-mates',
                            'send-text',
                            'load-thread',
                            'set-thread-read',
                            'get-thread-stats',
                            'clear-thread',
                            'send-signal',
                            'find-signal',
                            'withdraw-signal',
                            'partners',
                            'remove-partner',
                            'ca-save',
                            'ca-save-published',
                            'publish-ca',
                            'delete-ca',
                            'ca-add-new',
                            'mark',
                            'mark-inputing',
                            'receipt-validator',
                            'shortcoursestudents',
                            'sign-all'
                           
                        ],
                        'allow' => true,
                        'roles' => ['INSTRUCTOR & HOD']
                        

                    ],
                    [
                        'actions' => [
                          
                            'get-online-mates',
                            'send-text',
                            'load-thread',
                            'set-thread-read',
                            'get-thread-stats',
                            'clear-thread',
                            'send-signal',
                            'find-signal',
                            'withdraw-signal'
                           
                        ],
                        'allow' => true,
                        'roles' => ['STUDENT']
                        

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

    //print_r((new ClassRoomChatManager())->getOnlineMatesByCourse()); return true;
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
    //chatting area

    public function actionGetOnlineMates($all=null)
    {
        if($all==null)
        {
            return $this->asJson((new ClassRoomChatManager())->getAllOnlineUsers());
        }
        else
        {
            return $this->asJson((new ClassRoomChatManager())->getAllOnlineUsers(true));
        }
    }

    public function actionSendText($text, $receiver)
    {
        return ClassRoomChatManager::sendText($receiver,$text);
    }
    public function actionGetThreadStats()
    {
        return $this->asJson((new ClassRoomChatManager())->getThreadsStats());
    }
    public function actionLoadThread($other)
    {
        return $this->asJson((new ClassRoomChatManager())->getThread($other));
    }

    public function actionSetThreadRead($thread)
    {
        return (new ClassRoomChatManager())->setThreadRead($thread);
    }
    public function actionClearThread($thread)
    {

       return (new ClassRoomChatManager())->clearThread($thread);

    }

    public function actionSendSignal($receiver,$type,$roomtype)
    {
      return (new ClassRoomChatManager())->signal($receiver,$type,$roomtype);

    }
    public function actionFindSignal($signaler,$roomtype=null)
    {
        return (new ClassRoomChatManager())->findSignal($signaler,$roomtype); 
    }
    public function actionWithdrawSignal($other)
    {

        return (new ClassRoomChatManager())->withdrawSignal($other); 

    }

    public function actionPartners()
    {
        $course=yii::$app->session->get('ccode');
        $partners=InstructorCourse::find()->where(['course_code'=>$course])->all();
        $me=yii::$app->user->id;
        foreach($partners as $p=>$partner)
        {
            if($partners[$p]->instructor->userID==$me)
            {
                unset($partners[$p]);
            }
        }

        return $this->render('partners',['partners'=>$partners]);
    }
    public function actionRemovePartner($partner)
    {
      $partner=InstructorCourse::find()->where(['instructorID'=>$partner,'course_code'=>yii::$app->session->get('ccode')])->one();
      if($partner->delete()){return $this->asJson(["message"=>"deleted"]);}
       return false;
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
        
        //if($model->load(Yii::$app->request->post())){
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if($model->create()){
                
                return $this->redirect(Yii::$app->request->referrer);
            return true;
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

    //view chat
    public function actionViewChats($stdid){
        $model = new CreateChat;
        $sender = Yii::$app->user->identity->instructor->instructorID;
        $username = $stdid;
        
        
        $chats = Chat::find()->where(['instructorID'=>$sender, 'reg_no'=>$username])->all();
       // $programs = Program::find()->all();
   
        return $this->render('chat_index1', ['model'=>$model, 'username'=>$username, 
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
  $record=StudentExtAssess::findOne($recordid);
  return $this->render('editassessrecord',['recordid'=>ClassRoomSecurity::encrypt($recordid),'regno'=>$record->reg_no,'score'=>$record->score]);
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

    public function actionDeleteInstructorCoz($id)
    {
        $cozdel = InstructorCourse::findOne($id)->delete(); 
        if($cozdel){
           Yii::$app->session->setFlash('success', 'Course Removed successfully');
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
            return $this->asJson(['message'=>'Program deleted successfully']);
        }
     
    }

    public function actionDeletestudent()
    {
        $id=yii::$app->request->post('id');
        $std_delete = Student::findOne($id)->delete();
        if($std_delete){
            $stddel = User::find()->where(['username'=> $id])->one();
         $stddel->delete();
            Yii::$app->session->setFlash('success', 'Student deleted successfully');
        }
        return $this->asJson(['message'=>'user deleted successfully']);
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
        $tut = Assignment::findOne(ClassRoomSecurity::decrypt($id));
        if(Yii::$app->request->isPost)
        {
        if($tut->load(Yii::$app->request->post()) && $tut->save())
        {
            Yii::$app->session->setFlash('success', 'Tutorial updated successfully');
            return $this->redirect(['class-tutorials', 'cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get('ccode'))]);
        }else{
            Yii::$app->session->setFlash('error', 'Tutorial updating failed, try again later');
            return $this->redirect(yii::$app->request->referrer);
        }
       }
        return $this->render('updatetut', ['tut'=>$tut,'id'=>$id]);
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

public function actionViewCoz($cid)
{
    $yearID=(yii::$app->session->get('currentAcademicYear'))->yearID;

    // get Assignments
    $assignments = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid,'yearID'=>$yearID])->orderBy([
        'assID' => SORT_DESC ])->all();
    $AssignmentCount = count($assignments);

    // get tutorials
    $tutorials = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid, 'yearID'=>$yearID ])->orderBy([
        'assID' => SORT_DESC ])->all();
    $TutorialCount = count($tutorials);

    // get Labs
    $labs = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid, 'yearID'=>$yearID ])->orderBy([
        'assID' => SORT_DESC ])->all();
    $LabCount = count($labs);

    // get Materials
    $modules = Module::find()->where(['course_code' => $cid,'yearID'=>$yearID])->orderBy([
        'moduleID' => SORT_DESC ])->all();
    $MaterialCount = count($modules);

    // get Announcement
    $announcements=Announcement::find()->where(['course_code'=>$cid])->orderBy([
        'annID' => SORT_DESC ])->all();
    $AnnouncementCount = count($announcements);

    // get Instructors
    $instructors=InstructorCourse::find()->where(['course_code'=>$cid])->all();
    $InstructorCount = count($instructors);

    //get External Assessment
    $assessments =ExtAssess::find()->where(['course_code'=>$cid])->all();
    $ExtAssessmentCount = count($assessments);

    // get Course Student
    $students=CourseStudents::getClassStudents($cid);
    $StudentCount = count($students);

    // GET COZ
    $course = Course::findOne($cid);
    $courseName = $course->course_name;

    

    return $this->render('CourseProfile', ['cid'=>$cid, 'assignments'=>$assignments, 'AssignmentCount'=>$AssignmentCount,
    'labs'=>$labs, 'LabCount'=>$LabCount, 'modules'=>$modules, 'MaterialCount'=>$MaterialCount, 'announcements'=>$announcements,
        'AnnouncementCount'=>$AnnouncementCount, 'assessments'=>$assessments, 'ExtAssessmentCount'=>$ExtAssessmentCount,
        'students'=>$students, 'StudentCount'=>$StudentCount, 'instructors'=>$instructors, 'InstructorCount'=>$InstructorCount, 
    'TutorialCount'=>$TutorialCount, 'courseName'=>$courseName]);
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
    
    $cid=ClassRoomSecurity::decrypt($cid);
    $modules = Module::find()->where(['course_code' => $cid])->orderBy([
        'moduleID' => SORT_DESC ])->all();
    return $this->render('classmaterials', ['cid'=>$cid,'modules'=>$modules]);

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
        $model->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<i class="fa fa-info-circle"></i> Module created successfully');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    //public action share material from an external link

public function actionShareLink($module)
{
  $material=new material();
      if(yii::$app->request->isPost)
      {
      if($material->load(yii::$app->request->post()))
      {
          $material->instructorID=yii::$app->user->identity->instructor->instructorID;
          $material->course_code=yii::$app->session->get('ccode');
          $material->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
          $material->moduleID=ClassRoomSecurity::decrypt($module);
          $material->material_type="link";
          if($material->save()){
              yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Link shared successfully");
              return $this->redirect(yii::$app->request->referrer);
          }
          else
          {
            yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> An error occured while sharing this link, try again later");
            return $this->redirect(yii::$app->request->referrer);  
          }
      }
     
    }
   
        return $this->render("materials/shareExternalLink",['model'=>$material,'module'=>$module]);
    
  
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

//assignment stats

public function actionGetAssignmentStat($assignment,$stat)
{
  $assignment=Assignment::findOne($assignment);

  switch($stat)
  {
    case "submitted":
        return round($assignment->getSubmitsPercent(),2)." %";
        break;
    case "missing":
        return round($assignment->getMissingAssignmentsPerc(),2)." %";
        break;
    case "marked":
        return round($assignment->getMarkedAssignmentsPerc(),2)." %";
        break;
    case "failed":
        return round($assignment->getFailurePerc(),2)." %";
        break;
    default:
        return null;

  }


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
    return $this->render('classExtAssessments',['cid'=>$cid]);

}

//CA generator page

public function actionClassCaGenerator($cid,$ca=null)
{
        $cid=ClassRoomSecurity::decrypt($cid);
        $camodel=null;
        $allCas=(new CA())->findAllCAs();
        if($ca!==null)
        {
          //define the CA from the existing ca file
          $ca=ClassRoomSecurity::decrypt($ca);
          $camodel=new CA();
          $camodel->loadCAdata($ca);

      
        }
        else
        {
            $camodel=new CA(); //the CA is just a new one
        }
        return $this->render('classCAgenerator',['cid'=>$cid,'camodel'=>$camodel,'allcas'=>$allCas]);

}
public function actionPublishCa($ca)
{
    if((new CA)->publishCA($ca))
    {
        Yii::$app->session->removeFlash('success');
        yii::$app->session->setFlash('success',"<i class='fa fa-info-circle'></i> CA published successfully");
    }
    else
    {
        Yii::$app->session->removeFlash('error');
        yii::$app->session->setFlash('error',"<i class='fa fa-info-circle'></i> Could not publish CA, try again"); 
    }

    return $this->redirect(yii::$app->request->referrer);
}
//students page

public function actionClassStudents($cid)
{
    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
    $cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

    return $this->render('class_students',['cid'=>$cid]);

}

//Quizes page



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
   
    $model->the_assignment=Yii::$app->request->post('the_assignment');
        try
        {
        if($model->update($assid)){
            
        Yii::$app->session->setFlash('success', 'Assignment updated successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
        Yii::$app->session->setFlash('error', 'Updating failed, try again later');
       
        return $this->redirect(Yii::$app->request->referrer);
        }
       }
       catch(Exception $u)
       {
        Yii::$app->session->setFlash('error', $u->getMessage());
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
        Yii::$app->session->setFlash('error', 'Importing failed, you may need to download the standard format or change the assessment title'.Html::errorSummary($importmodel));
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
        $flash="Import completed with ".count($act)." error(s)";
        if($act!=null){
           foreach($act as $reg=>$msg)
           {
               $flash=$flash."<br>'".$reg."'=>".$msg;
           }
           Yii::$app->session->setFlash('error', $flash);
        }
        else{Yii::$app->session->setFlash('success', $flash);}
          
        
          return $this->redirect(Yii::$app->request->referrer);
    }
    else
    {
        Yii::$app->session->setFlash('error', 'Importing failed, you may need to download the standard format'.$act);
         return $this->redirect(Yii::$app->request->referrer);
    }
  }
  else
  {
    Yii::$app->session->setFlash('error', 'unknown error occurred, try again later');
    return $this->redirect(Yii::$app->request->referrer);
  }

    
}

//assignment collaboration MUTEX implementation

public function actionGetAssignmentLock($assignment)
{
  $mutexmanager=new ClassroomMutex;

  if(!$mutexmanager->getAssignmentMutexLock($assignment))
  {
      throw new Exception("You cannot mark this assignment while someone else (your partner) is marking the same assignment, unless he/she allows marking collaboration!");
  }
  else
  {
      return true;
  }
  

}

public function actionReleaseAssignmentLock($assignment)
{
    $mutexmanager=new ClassroomMutex;
    if($mutexmanager->freeAssignmentMutexLock($assignment))
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function actionLeaveMarkingCollaboration($assignment)
{
    $mutexmanager=new ClassroomMutex;
    $collaborationlock=$assignment."collaboration";
    if($mutexmanager->isLockAcquired($collaborationlock))
    {
        $mutexmanager->freeLock($collaborationlock);

        return true;
    }

    return true;

}
//toggling between marking collaboration activating mode

public function actionToggleCollaboration($assignment)
{
    $mutex=new ClassroomMutex();
    return $this->asJson($mutex->toggleCollaborationMode($assignment));
}

//toggle between panelist mode

public function actionTogglePanelist($assignment)
{
    $mutex=new ClassroomMutex();

    try
    {
      $resp=$mutex->togglePanelistMode(ClassRoomSecurity::decrypt($assignment));
      if($resp==true)
      {
        yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> ".$resp);
        return $this->redirect(yii::$app->request->referrer);
      }
    }
    catch(Exception $p)
    {
        yii::$app->session->setFlash("error","<i class='fa fa-exclamation-triangle'></i> ".$p->getMessage());
        return $this->redirect(yii::$app->request->referrer);
    }
}
public function actionViewAssessment($assid)
{
    $records=StudentExtAssess::find()->where(['assessID'=>ClassRoomSecurity::decrypt($assid)])->all();
    return $this->render('assessmentview',['records'=>$records,'assid'=>$assid]);  

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
//downloading all assignment submits
public function actionDownloadSubmits($assignment)
{
   $assignment=ClassRoomSecurity::decrypt($assignment);
   $course=yii::$app->session->get('ccode');
   $current_assignment=Assignment::findOne($assignment);

   try
   {
   $dir="storage/tmpfiles/";

   if(!file_exists(realPath($dir))){ mkdir($dir);}

   $ziptmp=$dir."submits_tmp.zip";
   
   $zipper=new \ZipArchive();

   if(!$zipper->open($ziptmp,\ZipArchive::CREATE | \ZipArchive::OVERWRITE))
   {
         throw new Exception("could not create archive"); 
   }
   //building download information

   $readme="Assignment submits download information \n------------------------------------------";
   $assignment_title=$current_assignment->assName;
   $assignment_type=($current_assignment->assType=="groups" || $current_assignment->assType=="allgroups")?"Group":"Individual";
   $expire=$current_assignment->finishDate;
   $coursetitle=$current_assignment->courseCode->course_name;
   $coursecode=$current_assignment->courseCode->course_code;
   $downloadinstructor=((new Instructor)::find()->where(['userID'=>yii::$app->user->identity->id])->one())->full_name;
   $no_submits=0;
   $no_files=0;
   $no_missing=0;
   $missing_files="";
   $readme.="\nAssignment Title: ".$assignment_title."\nAssignment type: ".$assignment_type."\nExpiring/Expired on: ".$expire."\n";
   $readme.="Course Name: ".$coursetitle."\nCourse Code: ".$coursecode."\n";
   $readme.="Download Instructor: ".$downloadinstructor."\n";
   $submits=null;

   if($current_assignment->assType=="allstudents" || $current_assignment->assType=="students")
   {
       $submits=$current_assignment->submits;
   }
   else
   {
       $submits=$current_assignment->groupAssignmentSubmits; 
   }
    $no_submits=count($submits);
   if(empty($submits) || $submits==null){throw new Exception("No submits found");}
   
   foreach($submits as $submit)
   {
       $file=$submit->fileName;
       $regno=str_replace('/', '-', $submit->reg_no);
       if(file_exists("storage/submit/".$file))
       {
        $no_files++;
        $localfile=$regno.".".pathinfo($file,PATHINFO_EXTENSION);
        $zipper->addFile("storage/submit/".$file,$localfile);
        continue;
       }

       $missing_files.=$regno.","; 
       $no_missing++;
   }
   
   $ending="Copyright 2020 - ".date('Y')." The University of Dodoma,  All Rights Reserved.\n\n UDOM-CLASSROOM V2.0";
   $readme.="Total Number of Submits: ".$no_submits."\nNumber Of Downloaded Files: ".$no_files."\nNumber Of Missing Files: ".$no_missing."\n";
   $readme.="Missing Files: ".$missing_files."\n\n\n\n\n\n";
   $college=((new Instructor)::find()->where(['userID'=>yii::$app->user->identity->id])->one())->department->college->college_name;
   $department=((new Instructor)::find()->where(['userID'=>yii::$app->user->identity->id])->one())->department->department_name;
   $readme.=str_pad($department.", ".$college."\n\n\n\n\n\n\n".$ending,100,"++++++++",STR_PAD_BOTH);
   $zipper->addFromString('Readme.txt',$readme);

   $zipper->close();
  
   Yii::$app->response->sendFile($ziptmp,$course."_Assignment_".$current_assignment->finishDate."_Submits.zip")->on(\yii\web\Response::EVENT_AFTER_SEND, function($event) {
        unlink($event->data);
   },$ziptmp);
    if(connection_aborted()){unlink($ziptmp);}
    //register_shutdown_function(unlink($ziptmp));
}
catch(Exception $dn)
{
    yii::$app->session->setFlash('error',$dn->getMessage());
    $this->redirect(yii::$app->request->referrer);
}

}




//######################## function to create tutorial ###############################################

public function actionUploadTutorial(){
    $model = new UploadTutorial();
    if($model->load(Yii::$app->request->post())){
        $model->assFile = UploadedFile::getInstance($model, 'assFile');
        $upload=$model->upload();
        
        if($upload==true){
        Yii::$app->session->setFlash('success', 'Tutorial created successfully');
        return $this->redirect(Yii::$app->request->referrer);
        }else{
        Yii::$app->session->setFlash('error', 'Unable to upload tutorial now, try again later'.$upload);
       
       // return $this->redirect(Yii::$app->request->referrer);
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
    //setting up the session starter

     $starter=Yii::$app->user->identity->id;
     yii::$app->session->set("marksessionowner",ClassRoomSecurity::encrypt($starter));
     //loading the current assignment
     $id=ClassRoomSecurity::decrypt($id);
     $subid=ClassRoomSecurity::decrypt($subid);
     $submit=[];
     $current_assignment=Assignment::findOne($id);

     //if panelist mode is set up, the marking view is automatically "presentation view"
    
     if((new ClassroomMutex())->isPanelistActive($id))
     {
        yii::$app->session->set('markingmode','presentation');
        yii::$app->session->setFlash("success","<i class='fa fa-info-circle'></i> Panelist Mode is activated"); 
     }
     
    //marking before the deadline is no longer allowed

    try
    {
      if(!($current_assignment->isExpired()) && ($current_assignment->submitMode=="resubmit"))
      {
          throw new Exception("Marking before deadline is not allowed in \"resubmit\" assignment type");
      }
    }
    catch(Exception $m)
    {
        yii::$app->session->setFlash("error",$m->getMessage());
        return $this->redirect(yii::$app->request->referrer); 
    }

    //try acquiring mutex
     try
     {
        //$this->actionGetAssignmentLock($id);
        $user=true; //as a placeholder
     }
     catch(Exception $q)
     {
        yii::$app->session->setFlash("error",$q->getMessage());
        return $this->redirect(yii::$app->request->referrer);
     }

   //for connection exceptions, release lock
  
    if(connection_status()==1 || connection_status()==2 || connection_status()==3)
    {
      $this->actionReleaseAssignmentLock($id);
      yii::$app->session->set("marksessionowner",null); //he is no longer the owner
      yii::$app->session->set("markpanelowner",null); // and no longer the owner of any marking panel
      $this->actionSetPanelistOff($id);
    }
   
 

    //setting up the marking mode
    try
    {
        if(yii::$app->session->get('markingmode')===null)
        {
         yii::$app->session->set('markingmode','ordinary');
        }  
    }
    catch(Exception $m)
    {
        yii::$app->session->setFlash("error",$m->getMessage());
        yii::$app->session->set('markingmode','ordinary');
    }
    
   
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
public function actionChangeMarkingMode($mode)
{
  try
  {
      yii::$app->session->set('markingmode',$mode);
      return $this->redirect(yii::$app->request->referrer);
  }
  catch(Exception $e)
  {
    yii::$app->session->setFlash("error","could not change marking mode");
    return $this->redirect(yii::$app->request->referrer);
  }
}
public function actionPublishAssignmentResults($assignment)
{
    $currentassignment=Assignment::findOne(ClassRoomSecurity::decrypt($assignment));
    $currentassignment->status="published";

    if($currentassignment->save()){
        yii::$app->session->setFlash("success","Assignment results published successfully");
        return $this->redirect(yii::$app->request->referrer);
    }
    else
    {
        yii::$app->session->setFlash("error","unknown error occurred while publishing results, try again");
        return $this->redirect(yii::$app->request->referrer);  
    }
}

public function actionSetPanelistOff($assignment)
{
    $mutexmanager=new ClassroomMutex();
    try
    {
     return $mutexmanager->setPanelistOff($assignment); //clearing panelist mode
    }
    catch(Exception $f)
    {
      return false;
    }
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
 
   return $this->render('courseGroups', ['groups'=>$groups,'cid'=>$coursecode]);
   

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
   if($res!==true){Yii::$app->session->setFlash('error','<i class="fa fa-info-circle"></i> '.$res);}

   return $this->redirect(Yii::$app->request->referrer); 
  
    

 

 }
 public function actionCaSave()
 {
    $ca=yii::$app->request->post();
    if($ca['CA']['Assignments']==null && $ca['CA']['LabAssignments']==null && $ca['CA']['otherAssessments']==null){
        Yii::$app->session->setFlash('error','<i class="fa fa-info-circle"></i> No content'); 
        return $this->redirect(yii::$app->request->referrer); 
    }

    (new CA)->CAsaver($ca);

    return $this->redirect(yii::$app->request->referrer);
  
 }
 public function actionDeleteCa($ca)
 {
     if((new CA)->deleteCA($ca))
     {
        Yii::$app->session->setFlash('success','<i class="fa fa-info-circle"></i> CA deleted successfully'); 
        return $this->redirect(yii::$app->request->referrer);
     }

     Yii::$app->session->setFlash('error','<i class="fa fa-info-circle"></i> Could not delete CA, try again later'); 
     return $this->redirect(yii::$app->request->referrer);
 }
 public function actionCaSavePublished()
 {
    $ca=yii::$app->request->post();
    if($ca['CA']['Assignments']==null && $ca['CA']['LabAssignments']==null && $ca['CA']['otherAssessments']==null){
        Yii::$app->session->setFlash('error','<i class="fa fa-info-circle"></i> No content'); 
        return $this->redirect(yii::$app->request->referrer); 
    }
    (new CA)->CAsavePublished($ca);

    return $this->redirect(yii::$app->request->referrer);
  
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
    if($res!=null){Yii::$app->session->setFlash('error','<i class="fa fa-info-circle"></i> '.$res);}
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
 public function actionCaAddNew($ca)
 {
     $cadata=(new CA)->getCaData(ClassRoomSecurity::decrypt($ca));
     $title=basename(ClassRoomSecurity::decrypt($ca),'.ca');
     if($cadata==null){
        Yii::$app->session->setFlash('error','<i class="fa fa-info-circle"></i>An error occured while loading CA');
        return $this->redirect(Yii::$app->request->referrer); 
     }
     $cadata['CA']['title']=$title;
     return $this->render('caAddRecord',['cadata'=>$cadata['CA']]);
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
    Yii::$app->session->setFlash('error', 'Something went wrong '.$e->getMessage());
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
        if($programs[$p]->programCode=="DITSH"){continue;}
        $program_students=$programs[$p]->students;
        array_push($students,$program_students);
    }
    return $this->render('student_list', ['students'=>$students]);
}

public function actionShortcoursestudents(){
    $instructorid = Yii::$app->user->identity->instructor->instructorID;
    $myinstructor=Instructor::findOne($instructorid);
    $instructor_department= $myinstructor->department;
    $courses=Course::find()->where(['departmentID'=>$instructor_department,'type'=>'short_course'])->all();
    $students=[];
    for($p=0;$p<count($courses);$p++)
    {
        $studentshortcourses=$courses[$p]->studentshortcourses;

        foreach($studentshortcourses as $studentshortcourse)
        {
            array_push($students,$studentshortcourse->regNo);
        }
        
    }
    return $this->render('shortcourse_student_list', ['students'=>$students]);
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
        $userdepat=yii::$app->user->identity->instructor->departmentID;
        $coz = ArrayHelper::map(Course::find()->all(), 'course_code', 'course_code');
        $courses = Course::find()->where(['type'=>'normal','departmentID'=>$userdepat])->all();
        $departments = ArrayHelper::map(Department::find()->where(['departmentID'=>$userdepat])->all(), 'departmentID', 'department_name','collegename');
        $programs = ArrayHelper::map(Program::find()->all(), 'programCode', 'programCode');
        try{
        //$departments = ArrayHelper::map(Department::find()->all(), 'departmentID', 'department_name');
       
        if($model->load(Yii::$app->request->post())){


            if($model->create()===true){
            Yii::$app->session->setFlash('success', 'Course added successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error','unable to add new course'.Html::errorSummary($model));
                return $this->redirect(Yii::$app->request->referrer);
            }    
         } 
    
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'Something went wrong: '.$e->getMessage());
        return $this->redirect(Yii::$app->request->referrer);
       
    }
        return $this->render('create-course', ['model'=>$model, 'coz'=>$coz, 'courses'=>$courses, 'programs'=>$programs, 'departments'=>$departments]);
    }

    //creating and manage short courses

    public function actionCreateShortCourse(){
        //print_r(Yii::$app->request->post());
        $model = new CreateShortCourse;
        $userdepat=yii::$app->user->identity->instructor->departmentID;
        $courses = Course::find()->where(['type'=>'short_course','departmentID'=>$userdepat])->all();
        $departments = ArrayHelper::map(Department::find()->where(['departmentID'=>$userdepat])->all(), 'departmentID', 'department_name','collegename');

        try{
        if($model->load(Yii::$app->request->post())){


            if($model->create()===true){
            Yii::$app->session->setFlash('success', 'Course added successfully');
            return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('error','unable to add new course'.Html::errorSummary($model));
                return $this->redirect(Yii::$app->request->referrer);
            }    
         } 
    
    }catch(\Exception $e){
        Yii::$app->session->setFlash('error', 'An unknown error occurred'.$e->getMessage());
        return $this->redirect(Yii::$app->request->referrer);
       
    }
        return $this->render('create-short-course', ['model'=>$model,'courses'=>$courses,'departments'=>$departments]);
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

    public function actionRemoveInstructorCourse($instructorID)
    {
        $instructorCoz=InstructorCourse::find()->where(['instructorID'=>$instructorID])->all();
       return $this->render('remove-instructor-course', [ 'instructorCoz'=>$instructorCoz]);
    }
    //will in the future add parameter
    public function actionReceiptValidator()
    {
      
    }

    //temporary
    /*
    public function actionSignAll()
    {
        $submits=GroupAssignmentSubmit::find()->all();
        $totalwork=0;
        $signed=0;
        foreach($submits as $submit)
        {
            $submitID=$submit->submitID;
            $groupmembers=$submit->group->studentGroups;
            $report=[];
            foreach($groupmembers as $member)
            {
              $totalwork++;
              $reg_no=$member->reg_no;
              try
              {
                $signpad=new SubmitSignatures;
                if($signpad->isSigned($submitID,$reg_no))
                {
                    continue;
                }
                date_default_timezone_set('Africa/Dar_es_Salaam');
                $signpad->sigtime=date('Y-m-d H:i:s');
                $signpad->reg_no=$reg_no;
                $signpad->submitID=$submitID;

              
                  if($signpad->save())
                  {
                      $signed++;
                      continue;
                  }
                  else
                  {
                      $report[$reg_no]="not signed";
                      continue;
                  }
              }
              catch(\Exception $d)
              {
                  $report[$reg_no]="not signed";
                  continue;
              }


            }
        }

        $perc=$totalwork!=0?($signed*100)/$totalwork:0;

        return $this->render('index',['report'=>$report,'perc'=>$perc]);
    }
    */
}