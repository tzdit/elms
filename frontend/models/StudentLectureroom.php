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
use BigBlueButton\BigBlueButton;

/*
A model class for managing academicyear, switching to and from a specific 
academic year, and migrating the whole system to a new academic year
*/

class StudentLectureroom extends Model
{

    
    
    public function rules()
    {
       
    }

    public function findAllLectures()
    {
        $course=yii::$app->session->get("ccode");
        $year=yii::$app->session->get("currentAcademicYear")->yearID;

        $lectures=LiveLecture::find()->where(["course_code"=>$course,"yearID"=>$year])->all();

        $lectureinfos=[];

        foreach($lectures as $lecture)
        {
          $dblectureinfo=$lecture->lectureroominfos;
          if($dblectureinfo==null){continue;}
          $roomID=$dblectureinfo->meetingID;
          $pw=$dblectureinfo->attpw;

          $lectureinfo=$this->getLectureInfos($roomID,$pw);

          if($lectureinfo==null){continue;}
          $datetime=new \DateTime($lecture->lectureDate." ".$lecture->lectureTime);
          $lectureinfo->setStartTime($datetime->getTimestamp());
          $lectureinfo->setDescription($lecture->description);
          array_push($lectureinfos,$lectureinfo);
        }
        
        return $lectureinfos; 

    }
    public function getLectureInfos($meetingID,$pass)
    {
     $parameters=new GetMeetingInfoParameters($meetingID,$pass);
     try
     {
     $meetingInforesp=(new BigBlueButton())->getMeetingInfo($parameters);
     if($meetingInforesp->getReturnCode()=="FAILED"){return null;}
     $meetingInfo=$meetingInforesp->getMeeting();
     return $meetingInfo;
     }
     catch(Exception $m)
     {
         return null;
     }
    
     
     
    }

  
    public function joinSession($session,$pw)
    {
      
        $student_name=yii::$app->user->identity->username;
        $door_open_registar=new JoinMeetingParameters($session,$student_name,$pw);
        $door_open_registar->setRedirect(true);
        return $door_open_registar; 
    
    }

    
  
   
}
