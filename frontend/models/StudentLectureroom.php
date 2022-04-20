<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\LiveLecture;
use common\models\Lectureroominfo;
use yii\base\Exception;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\BigBlueButton;
use frontend\models\ClassRoomSecurity;
use BigBlueButton\Exceptions\BadResponseException;

/*
A model class for managing academicyear, switching to and from a specific 
academic year, and migrating the whole system to a new academic year
*/

class StudentLectureroom extends Model
{

    
    
    public function rules()
    {
       
    }

    public function findLectureSchedule()
    {
        $course=yii::$app->session->get("ccode");
        $year=yii::$app->session->get("currentAcademicYear")->yearID;

        $lectures=LiveLecture::find()->where(["course_code"=>$course,"yearID"=>$year])->all();

        return $lectures; 

    }
    public function getRoomInfos()
    {
     $meetingID=yii::$app->session->get("ccode");
     $pw=yii::$app->session->get('ccode')."student";
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
      $recordingsparam->setMeetingId(yii::$app->session->get("ccode"));

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

  
    public function joinSession($session)
    {
        //is the room  open
        if($this->getRoomInfos()==null){return null;} //room closed

        $session=ClassRoomSecurity::decrypt($session);
        $pw=yii::$app->session->get('ccode')."student";
        $student_name=yii::$app->user->identity->username;
        $door_open_registar=new JoinMeetingParameters($session,$student_name,$pw);
        $door_open_registar->setRedirect(true);
        return $door_open_registar; 
    
    }

    
  
   
}
