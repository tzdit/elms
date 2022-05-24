<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Academicyear;
use yii\base\Exception;

/*
A model class for managing academicyear, switching to and from a specific 
academic year, and migrating the whole system to a new academic year
*/

class AcademicYearManager extends Model
{
    public $duration=12;
    public $yearid;
    
    
    public function rules()
    {
        return [
            [['duration', 'yearid'], 'required']
          
        ];
    }

    public function switchAcademicYear()
    {
        //setting up the new selected academic year
        try
        {
        yii::$app->session->set('currentAcademicYear', Academicyear::find()->where(['yearID'=>$this->yearid])->one());
        return true;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }

        
    }

    public function migrateForward($storageClean=false)
    {
      date_default_timezone_set('Africa/Dar_es_Salaam');
      //finding the current academic year

      $current=Academicyear::find(['status'=>'ongoing'])->one();

      //building new academic year

      $start=($current->starts_in)+1;
      $end=($current->ends_in)+1;

      $newTitle=$start." - ".$end;

      $newYear=new Academicyear();
      $newYear->starts_in=$start;
      $newYear->ends_in=$end;
      $newYear->title=$newTitle;
      $newYear->duration=$this->duration;
      $newYear->date_launched=date("Y-m-d H:i:s");
      $newYear->status="ongoing";

      // if true, delete all submits

      //increment all student's YOS;
      $current->status="finished";

      if($current->save() && $newYear->save())
      {
          return true;
      }

      return false;

    }

    public function migrateBackward()
    {
        
    }

  
   
}
