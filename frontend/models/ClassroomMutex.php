<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use yii\mutex\FileMutex;
use frontend\models\ClassRoomSecurity;

/*
A class to manage process mutual exclusion in this system

written by khalid hassan, thewinner016@gmail.com, 0755189736

25/12/2021, christmas work OMG!!
*/

class ClassroomMutex extends Model
{
   private $timeout=10;
   
   private function getLock($name)
   {
     $mutex=new FileMutex();
     
     if($mutex->acquire($name,$this->timeout))
     {
        return true; 
     }
     else
     {
         throw new Exception("process is already running");
         
     }
   }

   private function freeLock($name)
   {
     $mutex=new FileMutex();

     if($mutex->release($name))
     {
         return true;
     }
     else
     {
         throw new Exception("lock releasing failed");
       
     }

   }
   public function isLockAcquired($name)
   {
       $mutex=new FileMutex();
       return file_exists($mutex->getLockFilePath($name));
   }

   public function getAssignmentMutexLock($name)
   {
     //first we try seeing if a collaboration mode is activated

     $collaborationlock=$name.'collaboration';

     try
     {
        
        if($this->isLockAcquired($collaborationlock))
        {
            //collaboration mode is activated
            //no need of acquiring assingment lock
            yii::$app->session->set("marksessionowner",null); //entered on collaboration, then is not a session owner
            return true;
        }
        else
        {
            //assignment lock acquiring is required
            throw new Exception("assignment lock acquiring required");
        }

     }
     catch(Exception $l)
     {
        //then we can acquire assignment lock;
         try
         {
         if($this->getLock($name))
         {
           return true; //lock acquired for this assignment
         }
         }
        catch(Exception $ass)
        {
           //no collaboration activated, no lock acquired

           return false;

        }
    


     }

     //in any different case, the lock is not acquired

     return false;

   }

   public function freeAssignmentMutexLock($name)
   {
     $collaborationlock=$name."collaboration";
     $sessionowner=ClassRoomSecurity::decrypt(yii::$app->session->get("marksessionowner"));
     $currentuser=Yii::$app->user->identity->id;
     if($sessionowner!=$currentuser){return true;} //no need to continue with releasing lock, only the owner of the lock can

     //if the assignment lock is not acquired, then no need to continue

     if(!$this->isLockAcquired($name))
     {
       return true;
     }

     try
     {
     if($this->isLockAcquired($collaborationlock)){
        
        $collabofree=$this->freeLock($collaborationlock);
     }
        
     return $this->freeLock($name); 
    }
    catch(Exception $f)
    {
      return true;
    }  
   }

   public function getAssignmentQuestionLock($question)
   {
    try
    {
      if($this->getLock($question)){return true;}
      else{return false;}
    }
    catch(Exception $e)
    {
        return false;
    }


   }

   public function freeAssignmentQuestionLock($question)
   {
     try
     {
       if($this->freeLock($question)){return true;}else{return false;}
     }
     catch(Exception $e)
     {
       return false;
     }
          
   }

   //setting the collaboration mode active

   private function setCollaborationActive($name)
   {
     $collaborationlock=$name."collaboration";
     
     //we try setting it up if possible
     try
     {
      
          $this->freeAssignmentMutexLock($name);
          $this->getLock($collaborationlock);
          return true;
      }
      catch(Exception $c)
      {
        $this->getLock($collaborationlock);
        return true;
      }

   }

   //panelist mode activating

   private function setPanelistActive($assignment)
   {
    $panelistmode=$assignment."panelist";
     //we try setting it up if possible
     try
     {
          if($this->getLock($panelistmode))
          {
          if(!$this->isCollaborationActive($assignment))
          {
            $this->setCollaborationActive($assignment);
          }
          }
          yii::$app->session->set("markpanelowner",ClassRoomSecurity::encrypt(yii::$app->user->identity->id)); //and then he becomes the owner of the panelist mode
          yii::$app->session->set('markingmode','presentation');
          return true;
      }
      catch(Exception $c)
      {
        throw new Exception($c->getMessage());
      }

   }
   public function toggleCollaborationMode($assignment)
   {
     try
     {
       $sessionowner=ClassRoomSecurity::decrypt(yii::$app->session->get("marksessionowner"));
       $currentuser=Yii::$app->user->identity->id;
       if($sessionowner!=$currentuser){throw new Exception("Only the owner of the marking session can change collaboration mode");}
       if($this->isCollaborationActive($assignment))
       {
         $res=$this->setCollaborationOff($assignment);
         return true;
       }
      
        $res=$this->setCollaborationActive($assignment);
      

        return true;
     }
     catch(Exception $t)
     {
       return $t->getMessage();
     }
   }
  //toggle panelist mode

  public function togglePanelistMode($assignment)
  {
    try
    {
      if($this->isPanelistActive($assignment))
      {
        $res=$this->setPanelistOff($assignment);
        return "Panelist mode is off";
      }
    
       $res=$this->setPanelistActive($assignment);
     

       return "Panelist mode activated";
    }
    catch(Exception $d)
    {
      throw new Exception($d->getMessage());
    }
  }
  //////////////////////////////////
   private function setCollaborationOff($assignment)
   {
    $collaborationlock=$assignment."collaboration";
    if($this->isLockAcquired($collaborationlock)){
      $this->freeLock($collaborationlock);
      $this->setPanelistOff($assignment);
      $this->getAssignmentMutexLock($assignment);
      return true;
    }
    else
    {
      throw new Exception("collaboration not active, try again");
    }

     return true;
   }
   //panelist set off

   public function setPanelistOff($assignment)
   {
    $panelistmode=$assignment."panelist";

    $sessionowner=ClassRoomSecurity::decrypt(yii::$app->session->get("markpanelowner"));
    $currentuser=Yii::$app->user->identity->id;
    if($sessionowner!=$currentuser){throw new Exception("Only the owner of the marking session can toggle the panelist mode");}

    if($this->isLockAcquired($panelistmode)){
      $this->freeLock($panelistmode);
      yii::$app->session->set("markpanelowner",null); //and he is no longer the owner
      return true;
    }
    return true;
   }
   private function isCollaborationActive($assignment)
   {
    $collaborationlock=$assignment."collaboration";

    if($this->isLockAcquired($collaborationlock)){return true;}

    return false;
   }

   //is panelist mode active

   public function isPanelistActive($assignment)
   {
    $panelist=$assignment."panelist";

    if($this->isLockAcquired($panelist)){return true;}

    return false;
   }

   //files lock aquiring
   
   public function getfilelock($filename)
   {
    try
    {
      if($this->getLock($filename)){return true;}
      else{return false;}
    }
    catch(Exception $e)
    {
        return false;
    } 
   }

   public function freefilelock($filename)
   {

    try
     {
       if($this->freeLock($filename)){return true;}else{return false;}
     }
     catch(Exception $e)
     {
       return false;
     }
   }

   

   
   
}
