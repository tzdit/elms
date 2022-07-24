<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Academicyear;
use yii\base\Exception;
use common\models\Submit;
use common\models\GroupAssignmentSubmit;
use common\models\SystemModules;
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

    public function migrateForwards($options)
    {
      date_default_timezone_set('Africa/Dar_es_Salaam');
      //finding the current academic year

      $current=Academicyear::find()->where(['status'=>'ongoing'])->one();

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
      
      if(isset($options['deletefiles']) && $options['deletefiles']=="on")
      {
          //deleting all submitted files

          $ind_submits=Submit::find()->all();
          $group_submits=GroupAssignmentSubmit::find()->all();

          //deleting individual files
          if(!empty($ind_submits))
          {
            foreach($ind_submits as $submit)
            {
                try
                {
                  $file="storage/submit/".$submit->fileName;

                  if(file_exists($file)){unlink($file);}

                  $submit->delete();
                }
                catch(Exception $f)
                {
                    $submit->delete();
                    continue;
                }
            }
          }

          //deleting group submited files
         
          if(!empty($group_submits))
          {
            foreach($group_submits as $submit)
            {
                try
                {
                  $file="storage/submit/".$submit->fileName;

                  if(file_exists($file)){unlink($file);}

                  $submit->delete();
                }
                catch(Exception $f)
                {
                    $submit->delete();
                    continue;
                }
            }
          }

          
      }

      // open student registration

      if(isset($options['openregistration']) && $options['openregistration']=="on")
      {
          $module=SystemModules::find()->where(['moduleName'=>'Student_registration'])->one();
          $module->status="active";
          $module->save();
      }
      
      if($current->save() && $newYear->save())
      {
          //now migrating all students
      try
      {
      $connection = Yii::$app->getDb();
      $connection->createCommand("update student set YOS=YOS+1")->execute();
      }
      catch(Exception $s)
      {
         return 2;  //probably partial migration
      }
      yii::$app->session->set('currentAcademicYear',$newYear);

          return true;


      }

      return false;

    }

    public function migrateBackwards()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        //finding the current academic year
  
        $current=Academicyear::find()->where(['status'=>'ongoing'])->one();
  
        //building new academic year
  
        $start=($current->starts_in)-1;
        
        $old=Academicyear::find()->where(['starts_in'=>$start])->one();

        $old->status="ongoing";

        if($current->delete() && $old->save())
        {
                try
                {
                $connection = Yii::$app->getDb();
                $connection->createCommand("update student set YOS=YOS-1")->execute();
                }
                catch(Exception $s)
                {
                    return 2;  //probably partial migration
                }
                yii::$app->session->set('currentAcademicYear',$old);

                return true;
        }
        else
        {
            return false;
        }
    }

   

  
   
}
