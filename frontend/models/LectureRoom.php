<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\LiveLecture;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\BigBlueButton;
use yii\db\Connection;



class LectureRoom extends Model{

  public $meetingId;

  
  public $meetingName;

  public $attendeePassword;

  public $moderatorPassword;

  public $logoutUrl="http://localhost:8080/";

  public $maxParticipants;

  public $record;

  public $autoStartRecording=false;

 
  public $allowStartStopRecording=true;

 
  public $duration;

 
  public $welcomeMessage="Welcome in Our today's lecture, students are required to switch their MIC off";


  public $moderatorOnlyMessage;

 
  public $webcamsOnlyForModerator=true;

  public $logo;

  public $copyright;

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
  public $description;
  public $lectureDate;
  
///////////////////////////////////////////
  public function rules()
  {
      return [
          [['duration'], 'integer'],
          [['title', 'description', 'lectureDate', 'duration'], 'required'],
          [['lectureDate'], 'safe'],
          [['title'], 'string', 'max' => 200],
          [['description'], 'string', 'max' => 255],
      ];
  }

  public function createLectureRoom()
  {
   $dynamicBuilding=new BigBlueButton();

   //room specs, characteristics, features, etc

   $roomspecs=new CreateMeetingParameters($this->meetingId,$this->meetingName);
   $roomspecs=$roomspecs->setModeratorPassword($this->moderatorPassword);
   $roomspecs=$roomspecs->setAttendeePassword($this->attendeePassword);
   //more specs to be added in the future as per needs

   //now building the classroom
   try{
   $classroom=$dynamicBuilding->createMeeting($roomspecs);

   if($classroom->getReturnCode()=='SUCCESS'){return true;} //the room is ready made
   else{return false;} // any error might have occured
   }
   catch(Exception $e)
   {

     return $e->getMessage();

   }

  }

  //saving the classroom state into the database

  public function holdRoomState()
  {
    
    // starting by the basic information 
    
    $transact=Connection::beginTransaction();

    $lecturebucket=new LiveLecture();
    $lecturebucket->course_code=yii::$app->session->get('ccode');
    $lecturebucket->instructorID=Yii::$app->user->identity->instructor->instructorID;
    $lecturebucket->title=$this->title;
    $lecturebucket->description=$this->description;
    $lecturebucket->lectureDate=$this->lectureDate;
    $lecturebucket->duration=$this->duration;


    $lecturebucket->save(); //filling the bucket

    $switch=$this->createLectureRoom();  //creating the live lecture room

    if($switch)
    {
       // we get the room information and store them
     $classroomBuilding=new BigBlueButton();
     $roomparams=new GetMeetingInfoParameters($this->meetingId,$this->moderatorPassword);
     $roominfo=$classroomBuilding->getMeetingInfo();


     if($roominfo->getReturnCode()=="SUCCESS")
     {
        print $roominfo->getRawXml();
     }
    



    }


  }
  
}
?>