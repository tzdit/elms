<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\LiveLecture;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\BigBlueButton;



class LectureRoom extends Model{

  public $meetingId;

  /**
   * @var string
   */
  public $meetingName;

  /**
   * @var string
   */
  public $attendeePassword;

  /**
   * @var string
   */
  public $moderatorPassword;

  /**
   * @var string
   */
  private $dialNumber;

  /**
   * @var int
   */
  private $voiceBridge;

  /**
   * @var string
   */
  private $webVoice;

  /**
   * @var string
   */
  private $logoutUrl;

  /**
   * @var int
   */
  private $maxParticipants;

  /**
   * @var bool
   */
  private $record;

  /**
   * @var bool
   */
  private $autoStartRecording;

  /**
   * @var bool
   */
  private $allowStartStopRecording;

  /**
   * @var int
   */
  private $duration;

  /**
   * @var string
   */
  private $welcomeMessage;

  /**
   * @var string
   */
  private $moderatorOnlyMessage;

  /**
   * @var bool
   */
  private $webcamsOnlyForModerator;

  /**
   * @var string
   */
  private $logo;

  /**
   * @var string
   */
  private $copyright;

  /**
   * @var bool
   */
  private $muteOnStart;

  /**
   * @var bool
   */
  private $lockSettingsDisableCam;

  /**
   * @var bool
   */
  private $lockSettingsDisableMic;

  /**
   * @var bool
   */
  private $lockSettingsDisablePrivateChat;

  /**
   * @var bool
   */
  private $lockSettingsDisablePublicChat;

  /**
   * @var bool
   */
  private $lockSettingsDisableNote;

  /**
   * @var bool
   */
  private $lockSettingsHideUserList;

  /**
   * @var bool
   */
  private $lockSettingsLockedLayout;

  /**
   * @var bool
   */
  private $lockSettingsLockOnJoin = true;

  /**
   * @var bool
   */
  private $lockSettingsLockOnJoinConfigurable;

  /**
   * @var bool
   */
  private $allowModsToUnmuteUsers;

  /**
   * @var array
   */
  private $presentations = [];

  /**
   * @var boolean
   */
  private $isBreakout;

  /**
   * @var string
   */
  private $parentMeetingId;

  /**
   * @var int
   */
  private $sequence;

  /**
   * @var boolean
   */
  private $freeJoin;


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
  
}
?>