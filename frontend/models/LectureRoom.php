<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\LiveLecture;
use common\models\Lectureroominfo;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Exceptions\BadResponseException;
use yii\db\Connection;
use yii\base\Exception;



class LectureRoom extends Model{

  public $meetingId;

  
  public $meetingName;

  public $attendeePassword;

  public $moderatorPassword;

  public $logoutUrl="http://localhost:8080/auth/login";

  public $maxParticipants;

  public $record=true;

  public $autoStartRecording=false;

 
  public $allowStartStopRecording=true;

 
  public $duration=0;

 
  public $welcomeMessage="Welcome in Our today's lecture, students are required to switch their MIC off";


  public $moderatorOnlyMessage;

 
  public $webcamsOnlyForModerator=true;

  public $logo="/img/logo.png";

  public $copyright="Copyright © 2020 - 2022   The University of Dodoma.      All rights reserved.";

  public $muteOnStart;

  public $lockSettingsDisableCam;

  public $lockSettingsDisableMic;

  public $lockSettingsDisablePrivateChat=true;

  public $lockSettingsDisablePublicChat=false;

  public $lockSettingsDisableNote=true;

  private $lockSettingsLockedLayout;

  
  private $allowModsToUnmuteUsers=true;

  // lecture basic info

  public $title;
  public $lecture;
  public $description;
  public $lectureDate;
  public $lectureTime;
  
///////////////////////////////////////////
public function __construct($config=[])
{
  $yearid=(yii::$app->session->get("currentAcademicYear"))->yearID;
  $mpw=yii::$app->session->get('ccode')."@Instructor".$yearid;
  $attpw=yii::$app->session->get('ccode')."@Student".$yearid;
  $roomid=yii::$app->session->get('ccode')."@LectureRoom".$yearid;

  $this->attendeePassword=$attpw;
  $this->moderatorPassword=$mpw;
  $this->meetingId=$roomid;
  parent::__construct($config);
}
  public function rules()
  {
      return [
          [['duration'], 'integer'],
          [['title', 'lectureDate','lectureTime', 'duration', 'lecture'], 'required'],
          [['lectureDate'], 'safe'],
          [['title'], 'string', 'max' => 200],
          [['description'], 'string', 'max' => 255],
      ];
  }

  public function createLectureRoom()
  {
   $dynamicBuilding=new BigBlueButton();

   //room specs, characteristics, features, etc
   $lecture=LiveLecture::findOne($this->lecture);
   $roomspecs=new CreateMeetingParameters($this->meetingId,$lecture->title);
   $roomspecs=$roomspecs->setModeratorPassword($this->moderatorPassword);
   $roomspecs=$roomspecs->setAttendeePassword($this->attendeePassword);
   $roomspecs=$roomspecs->setDuration($lecture->duration);
   $roomspecs=$roomspecs->setRecord($this->record);
   $roomspecs=$roomspecs->setAutoStartRecording($this->autoStartRecording);
   $roomspecs=$roomspecs->setAllowStartStopRecording($this->allowStartStopRecording);
   $roomspecs=$roomspecs->setWelcomeMessage($this->welcomeMessage);
   $roomspecs=$roomspecs->setLogoutUrl($this->logoutUrl);
   $roomspecs=$roomspecs->setCopyright($this->copyright);
   $roomspecs=$roomspecs->setLogo($this->logo);
   //more specs to be added in the future as per needs

   //now building the classroom
   try{
   $classroom=$dynamicBuilding->createMeeting($roomspecs);

   if($classroom->getReturnCode()=='SUCCESS'){return true;} //the room is ready made
   else{ throw new Exception('Server error, could not create lecture room...');} // any error might have occured
   }
   catch(Exception $e)
   {

    throw new Exception($e->getMessage());

   }

  }

  //saving the classroom state into the database

  public function holdRoomState()
  {
    
    // starting by the basic information 
    
    //$transact=Connection::beginTransaction();

    $lecturebucket=new LiveLecture();
    $lecturebucket->course_code=yii::$app->session->get('ccode');
    $lecturebucket->instructorID=Yii::$app->user->identity->instructor->instructorID;
    $lecturebucket->title=$this->title;
    $lecturebucket->description=$this->description;
    $lecturebucket->lectureDate=$this->lectureDate;
    $lecturebucket->lectureTime=$this->lectureTime;
    $lecturebucket->duration=$this->duration;
    $lecturebucket->yearID=(yii::$app->session->get("currentAcademicYear"))->yearID; 
    $lecturebucket->status='New';

    $connection=yii::$app->db;
    $transact=$connection->beginTransaction();
  
   
    try
    {
     if(!$lecturebucket->save()){
       throw new Exception('An error occured, could not store session basic information.');
      } //filling the bucket
  
     $transact->commit();
     return true;
    
    }
    catch(Exception $e)
    {
      $transact->rollBack();
      return $e->getMessage();
     
    }



  }

  public function findLectureSchedule()
  {
      $course=yii::$app->session->get("ccode");
      $year=yii::$app->session->get("currentAcademicYear")->yearID;

      $lectures=LiveLecture::find()->where(["course_code"=>$course,"yearID"=>$year])->orderBy(['lectureID'=>SORT_DESC])->all();

      return $lectures; 

  }
  public function getRoomInfos()
    {
     $meetingID=$this->meetingId;
     $pw=$this->moderatorPassword;
     $parameters=new GetMeetingInfoParameters($meetingID,$pw);
     try
     {
     $meetingInforesp=(new BigBlueButton())->getMeetingInfo($parameters);
     if($meetingInforesp->getReturnCode()=="FAILED"){return null;}
     $meetingInfo=$meetingInforesp->getMeeting();
     return $meetingInfo;
     }
     catch(\RuntimeException $m)
     {
         return null;
     }
     catch(BadResponseException $bad)
     {
         return null;
     }
     catch(Exception $e)
     {
         return null;
     }
    
     
     
    }
    public function recordings()
    {
      $service=new BigBlueButton();
      $recordingsparam=new GetRecordingsParameters();
      $recordingsparam->setMeetingId($this->meetingId);

      try
      {
      $resp=$service->getRecordings($recordingsparam);
      $records=$resp->getRecords();
    
      return $records;
      }
      catch(\RuntimeException $r)
      {
          return [];
      }
      catch(BadResponseException $bad)
      {
          return [];
      }
      catch(Exception $e)
      {
          return [];
      }
    }
    public function joinSession()
    {
        //is the room  open
        if($this->getRoomInfos()==null){throw new Exception("room closed");} //room closed

        $session=$this->meetingId;
        $pw=$this->moderatorPassword;
        $instructor_name=yii::$app->user->identity->username;
        $door_open_registar=new JoinMeetingParameters($session,$instructor_name,$pw);
        $door_open_registar->setRedirect(true);
        return $door_open_registar; 
    
    }
  
}
?>