<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use common\models\Session;
use common\models\User;
use common\models\Chat;
use yii\helpers\Html;
use common\models\Chatroomsignals;
/*
A model class for managing Chatting,
written by khalidi january/2022, thewinner016@gmail.com, 0755189736
*/

class ClassRoomChatManager extends Model
{
    
    public function getAllOnlineUsers($all=null)
    {
      
       if($all!=null)
       {
           if(yii::$app->user->identity->instructor)
           {
               return $this->getOnlineMatesByCourse();
           }
           return array_merge($this->getOnlineMatesByCollege(),$this->getOnlineMatesByProgram(),$this->getOnlineMatesByCourse());
       }
       else
       {
           $all=Session::find()->all();

           return $this->refineOnlineMates($all);
       }
   


    }

    private function getOnlineMatesByCollege()
    {
        $user=yii::$app->user->identity;
        $college=$user->student->program->department->college->college_abbrev;
        $mates=Session::find()->where(['college'=>$college])->all();
        

        return $this->refineOnlineMates($mates);

    }
    private function getOnlineMatesByProgram()
    {
        $user=yii::$app->user->identity;
        $program=$user->student->programCode;
        $mates=Session::find()->where(['prog_or_dept'=>$program])->all();
        

        return $this->refineOnlineMates($mates);

    }

    private function getOnlineMatesByCourse()
    {
        $mycourses=$this->getMyCourses();
        $courseMates=[];
        $users=Session::find()->all();
        foreach($users as $user=>$data)
        {
            $usercourses=$this->getMateCourses($data->userID);
            if(empty(array_intersect($usercourses,$mycourses)))
            {
              unset($users[$user]);
            }
        }


        return $this->refineOnlineMates($users);


    }

    private function getMyCourses()
    {
        //program courses
        $user=yii::$app->user->identity;
        $courses=null;
        $courseArray=[];
        if($user->instructor)
        {
          $courses=$user->instructor->instructorCourses;
        }
        else
        {
            $program=$user->student->program;
            $courses=$program->programCourses;
        }

        foreach($courses as $course)
        {
          array_push($courseArray,$course->course_code);
        }

        //if student, we also add carried courses
       
        if($user->student)
        {
          $carried=$user->student->studentCourses;

          foreach($carried as $course)
          {
              array_push($courseArray,$course->course_code);
          }
        }

        return $courseArray;
        
    }

    private function getMateCourses($mateid)
    {
        //program courses
        $user=User::findIdentity($mateid);
        $courses=null;
        $courseArray=[];
        if($user->instructor)
        {
          $courses=$user->instructor->instructorCourses;
        }
        else
        {
            $program=$user->student->program;
            $courses=$program->programCourses;
        }

        foreach($courses as $course)
        {
          array_push($courseArray,$course->course_code);
        }

        //if student, we also add carried courses
       
        if($user->student)
        {
          $carried=$user->student->studentCourses;

          foreach($carried as $course)
          {
              array_push($courseArray,$course->course_code);
          }
        }

        return $courseArray; 
    }

    private function refineOnlineMates($mates)
    {
        $refined=[];
        $userdata=[];
        foreach($mates as $mate)
        {
            if($mate->userID==yii::$app->user->id || $this->isSessionExpired($mate->sessiontime)==true){continue;} //removing myself and expired sessions
            $userdata["userid"]=$mate->userID;
            $userdata["username"]=$mate->username;
            $userdata["role"]=$mate->role;
            $userdata["college"]=$mate->college;
            $userdata["prog_dept"]=$mate->prog_or_dept;
            $userdata["year"]=($mate->year!=null)?$mate->year."YR":"";

            $refined[strval($mate->username)]=$userdata;
        
        }

        return $refined;
    }

    private function isSessionExpired($sessiontime)
    {
      date_default_timezone_set('Africa/Dar_es_Salaam');
      $now=(new \DateTime())->getTimeStamp();
      $sessionstamp=(new \DateTime($sessiontime))->getTimeStamp();
      $timediff=$now-$sessionstamp;

      $h = floor(($timediff%86400)/3600);

      if($h>24){return true;}
       
      return false;
    }

    //now the real chatting

    public static function sendText($receiver,$text)
    {
      $sender=yii::$app->user->id;
      
      $chat=new Chat;

      $chat->receiver=$receiver;
      $chat->sender=$sender;
      $chat->chatText=$text;
      $chat->status="new";
      if($chat->save()){return true;}
      else{ return false;}
    }

    public function getThread($threadid)
    {
        $me=yii::$app->user->id;
        $sql='select * from chat where ((sender='.$me.' && receiver='.$threadid.') or (sender='.$threadid.' && receiver='.$me.'))';
        $thread=Chat::findBySql($sql)->all();

        return $this->refineThread($thread);
    }

    public function getThreadsStats()
    {
      $me=yii::$app->user->id;
      $thread=Chat::find()->where(['receiver'=>$me])->all();
      return $this->refineThreadStats($thread);
    }

    public function getSingleThreadStats($threadid)
    {
      $me=yii::$app->user->id;
      $sql='select * from chat where ((sender='.$me.' && receiver='.$threadid.') or (sender='.$threadid.' && receiver='.$me.'))';
      $thread=Chat::findBySql($sql)->all();

      return $this->refineThreadStats($thread);

    }

    private function refineThreadStats($threads)
    {
      $threadsStats=[];
      $totalnew=0;
      if(empty($threads) || $threads==null){return false;}

      //starting with new ones
      foreach($threads as $thread)
      {
        $sender_name=(User::findOne($thread->sender))->username;
   
        if($thread->status=="new"){
          $threadsStats[$thread->sender]["num_msgs"]=isset($threadsStats[$thread->sender]["num_msgs"])?($threadsStats[$thread->sender]["num_msgs"])+1:1;
          $threadsStats[$thread->sender]["sender_name"]=isset($threadsStats[$thread->sender]["sender_name"])?($threadsStats[$thread->sender]["sender_name"]):$sender_name;
          $threadsStats[$thread->sender]["isnew"]=$this->isMessageNew($thread->chatDateTime);
          $totalnew++;
        }
        else
        {
          $threadsStats[$thread->sender]["num_msgs"]=isset($threadsStats[$thread->sender]["num_msgs"])?$threadsStats[$thread->sender]["num_msgs"]:0;
          $threadsStats[$thread->sender]["sender_name"]=isset($threadsStats[$thread->sender]["sender_name"])?($threadsStats[$thread->sender]["sender_name"]):$sender_name;
          $threadsStats[$thread->sender]["isnew"]=$this->isMessageNew($thread->chatDateTime);
        }
      }

      $threadsStats["totalnew"]= $totalnew;

      return $threadsStats;
    }
    private function refineThread($threads)
    {
      $refinedThreads=[];
      $me=yii::$app->user->id;
      $tmpthreads=[];
      if(empty($threads) || $threads==null){return false;}
      $refinedThreads['hasnew']=$this->hasNew($threads);
      foreach($threads as $thread)
      {
        if($thread==null){continue;}
        $owner=($me==$thread->sender)?"me":"other";
        $tmpthreads['owner']=$owner;
        $tmpthreads['sender_name']=substr((User::findOne($thread->sender))->username,0,14);
        $tmpthreads['receiver_name']=(User::findOne($thread->receiver))->username;
        $tmpthreads['chat_text']=Html::encode($thread->chatText);
        $tmpthreads['chat_time']=($this->dateTohuman($thread->chatDateTime)=="now")?"now":$this->dateTohuman($thread->chatDateTime)." ago";
        $tmpthreads['status']=$thread->status;
        
        $refinedThreads[$thread->chatID]=$tmpthreads;
      }

      return $refinedThreads;

    }

    private function hasNew($threads)
    {
      date_default_timezone_set('Africa/Dar_es_Salaam');
      $now=(new \DateTime())->getTimeStamp();
      foreach($threads as $thread)
      {
          $chatdate=(new \DateTime($thread->chatDateTime))->getTimeStamp();
          $timediff=$now-$chatdate;
         if($thread->status!="new" || $timediff>3){continue;}
         return true;
      }

      return false;

    }
   public function setThreadRead($threadid)
   {
     $me=yii::$app->user->id;
     $sql='select * from chat where (sender='.$threadid.' && receiver='.$me.') && status="new"';
     $threads=Chat::findBySql($sql)->all();
     foreach($threads as $thread)
     {

       $thread->status='read';
       if(!$thread->save()){continue;};

     }

     return true;
   }

   private function seconds2human($seconds) {
    $s = $seconds%60;
    $m = floor(($seconds%3600)/60);
    $h = floor(($seconds%86400)/3600);
    $d = floor(($seconds%2592000)/86400);
    $M = floor($seconds/2592000);
    $Y=floor($seconds/31556926);
     
    if($Y>0){return ($Y==1)?$Y." year":$Y." years";}
    if($M>0){return ($M==1)?$M." month":$M." months";}
    if($d>0){return ($d==1)?$d." day":$d." days";}
    if($h>0){return ($h==1)?$h." hour":$h." hours";}
    if($m>0){return ($m==1)?$m." minute":$m." minutes";}
    if($s>0){return ($s==1)?$s." second":$s." seconds";}

    return "now";
    }

    private function dateTohuman($datetime)
    {
      $now=(new \DateTime())->getTimeStamp();
      $datestamp=$chatdate=(new \DateTime($datetime))->getTimeStamp();
      $elapsed_seconds=$now-$datestamp;

      return $this->seconds2human($elapsed_seconds);
    }

    public function clearThread($chatid)
    {
      $me=yii::$app->user->id;
      $sql='select * from chat where ((sender='.$me.' && receiver='.$chatid.') or (sender='.$chatid.' && receiver='.$me.'))';
      $threads=Chat::findBySql($sql)->all();

      //deleting all

      foreach($threads as $thread)
      {
        
        if(!$thread->delete()){continue;}

      }

      return true;
    }

    public function signal($receiver,$type,$roomtype="individual")
    {
      $me=yii::$app->user->id;
      $signal=Chatroomsignals::find()->where(['signaler'=>$me,'receiver'=>$receiver,'signal_type'=>$type])->all();
      try
      {
        if(empty($signal) || $signal==null)
        {
          //no exist, we insert new
          $newsignal=new Chatroomsignals();
          $newsignal->signaler=$me;
          $newsignal->receiver=$receiver;
          $newsignal->signal_type=$type;
          $newsignal->room_type=$roomtype;
          if($newsignal->save()){return true;}else{return false;}

        }

        throw new Exception("signal type exists");
      }
      catch(Exception $w)
      {

        //need to delete it first
         foreach($signal as $single)
         {
           if(!$single->delete()){continue;}
         }

         $newsignal=new Chatroomsignals();
         $newsignal->signaler=$me;
         $newsignal->receiver=$receiver;
         $newsignal->signal_type=$type;
         $newsignal->room_type=$roomtype;
         if($newsignal->save()){return true;}else{return false;}

      }
    }

    public function findSignal($signaler,$roomtype="individual")
    {
      $me=yii::$app->user->id;
      $signals=Chatroomsignals::find()->where(['signaler'=>$signaler,'receiver'=>$me,'room_type'=>$roomtype])->all();
      if(empty($signals) || $signals==null){return false;}
      date_default_timezone_set('Africa/Dar_es_Salaam');
      $now=(new \DateTime())->getTimeStamp();
      foreach($signals as $signal)
      {
          if($signal==null){return false;}
          $signalstamp=(new \DateTime($signal->time))->getTimeStamp();
          $timediff=$now-$signalstamp;
          if($timediff>60){continue;}
          return $signal->signal_type;
      }
       return false;
    }

    public function withdrawSignal($other,$roomtype="individual")
    {
      $signaler=yii::$app->user->id;
      $signals=Chatroomsignals::find()->where(['signaler'=>$signaler,'receiver'=>$other,'room_type'=>$roomtype])->all();

      foreach($signals as $signal)
      {

        if(!$signal->delete()){continue;}

      }

      return true;
    }

    private function isMessageNew($messagetime)
    {
      date_default_timezone_set('Africa/Dar_es_Salaam');
      $now=(new \DateTime())->getTimeStamp();
      $messagestamp=(new \DateTime($messagetime))->getTimeStamp();
      $timediff=$now-$messagestamp;
      if($timediff<3){return true;}

      return false;
    }
}
