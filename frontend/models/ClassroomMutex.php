<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use yii\mutex\FileMutex;

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
       return $mutex->isAcquired($name);
   }

   public function getAssingmentMutexLock($name)
   {
     //first we try seeing if a collaboration mode is activated

     $collaborationlock=$name.'collaboration';

     try
     {
        
        if($this->isLockAcquired($collaborationlock))
        {
            //collaboration mode is activated
            //no need of acquiring assingment lock

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
