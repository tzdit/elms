<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\GroupAssignmentSubmit;
use common\models\Submit;
use common\models\Material;


class StorageManager extends Model
{
   public function deleteFiles($which)
   {
    
     if($which['filetype']=="material")
     {
        $amount=$which['amount'];

        if($amount=="all")
        {
          return $this->deleteMaterialFiles();
          
        }
        else if($amount=="interval")
        {
            $interval=['from'=>$which['from'],'to'=>$which['to']];

            return $this->deleteMaterialFiles($interval);
         

        }
        else
        {
            $interval=['from'=>$which['from'],'to'=>$which['to']];

            return $this->deleteMaterialFiles_out($interval);
          
        }

     }
     else
     {
        $amount=$which['amount'];

        if($amount=="all")
        {
            return $this->deleteSubmitedFiles();
         
        }
        else if($amount=="interval")
        {
            $interval=['from'=>$which['from'],'to'=>$which['to']];

           return $this->deleteSubmitedFiles($interval);
         

        }
        else
        {
            $interval=['from'=>$which['from'],'to'=>$which['to']];

            return $this->deleteSubmitedFiles_out($interval);
         
 
        }

     }
     

   }
   private function deleteMaterialFiles($interval=null)
   {

     $materials=null;

     if($interval==null)
     {
        $materials=Material::findBySql("select * from material")->all();
     }
     else
     {
        $from=$interval['from'];
        $to=$interval['to'];
       $materials=Material::findBySql("select * from material where upload_date between '".$from."' and '".$to."'")->all();
     }

     if($materials==null){throw new \Exception("No Material files found within the specified interval");}
     $count=0;
     foreach($materials as $material)
     {
        
        try
        {
          if(!$material->delete())
          {
            continue;
          }
          else
          {
            $count++;
          }
    
        }
        catch(\Exception $d)
        {
          continue;
        }

     }

     return $count;

   }

   private function deleteMaterialFiles_out($interval=null)
   {

     $materials=null;

     if($interval==null)
     {
        $materials=Material::findBySql("select * from material")->all();
     }
     else
     {
        $from=$interval['from'];
        $to=$interval['to'];
       $materials=Material::findBySql("select * from material where upload_date not between '".$from."' and '".$to."'")->all();
     }

     if($materials==null){throw new \Exception("No Material files found within the specified interval");}
     $count=0;
     foreach($materials as $material)
     {
        
        try
        {
          if(!$material->delete())
          {
            continue;
          }
          else
          {
            $count++;
          }
    
        }
        catch(\Exception $d)
        {
          continue;
        }

     }

     return $count;

   }

   private function deleteSubmitedFiles($interval=null)
   {

     $submitted=null;
     $groupsubmitted=null;
     if($interval==null)
     {
        $submitted=Submit::findBySql("select * from submit")->all();
        $groupsubmitted=GroupAssignmentSubmit::findBySql("select * from group_assignment_submit")->all();
     }
     else
     {
        $from=$interval['from'];
        $to=$interval['to'];
        $submitted=Submit::findBySql("select * from submit where submit_date between '".$from."' and '".$to."'")->all();
        $groupsubmitted=GroupAssignmentSubmit::findBySql("select * from group_assignment_submit where submit_date between '".$from."' and '".$to."'")->all();
    
     }

     if($submitted==null && $groupsubmitted==null){throw new \Exception("No submitted files found within the specified interval");}
      $count=0;
     foreach($submitted as $singlesub)
     {
        
        try
        {
          if(!$singlesub->delete())
          {
            continue;
          }
          else
          {
            $count++;
          }
    
        }
        catch(\Exception $d)
        {
          continue;
        }


     }

     foreach($groupsubmitted as $singlegsub)
     {
        
        try
        {
          if(!$singlegsub->delete())
          {
            continue;
          }
          else
          {
            $count++;
          }
    
        }
        catch(\Exception $d)
        {
          continue;
        }

     }

     return $count;

   }

   private function deleteSubmitedFiles_out($interval=null)
   {

     $submitted=null;
     $groupsubmitted=null;
     if($interval==null)
     {
        $submitted=Submit::findBySql("select * from submit")->all();
        $groupsubmitted=GroupAssignmentSubmit::findBySql("select * from group_assignment_submit")->all();
     }
     else
     {
        $from=$interval['from'];
        $to=$interval['to'];
        $submitted=Submit::findBySql("select * from submit where submit_date not between '".$from."' and '".$to."'")->all();
        $groupsubmitted=GroupAssignmentSubmit::findBySql("select * from group_assignment_submit where submit_date not between '".$from."' and '".$to."'")->all();
    
     }

     if($submitted==null && $groupsubmitted==null){throw new \Exception("No submitted files found within the specified interval");}
      $count=0;
     foreach($submitted as $singlesub)
     {
        
        try
        {
          if(!$singlesub->delete())
          {
            continue;
          }
          else
          {
            $count++;
          }
    
        }
        catch(\Exception $d)
        {
          continue;
        }


     }

     foreach($groupsubmitted as $singlegsub)
     {
        
        try
        {
          if(!$singlegsub->delete())
          {
            continue;
          }
          else
          {
            $count++;
          }
    
        }
        catch(\Exception $d)
        {
          continue;
        }

     }

     return $count;

   }
   
}

?>