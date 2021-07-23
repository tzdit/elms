<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
use common\models\StudentExtAssess;
use common\models\ExtAssess;
class AddAssessRecord extends Model{

    public $regno;
    public $score;
    public $assessid;
    public function rules(){
        return [
           ['score','double'],
           ['score','required'],
           ['regno','string'],
           ['regno','required']
        ];

    }
    public function add_new_record(){

      if(!$this->validate()){
         return false;
     }
     $error_rec=[];
     $assmark=ExtAssess::findOne($this->assessid)->total_marks;
     
     if($this->score>$assmark){$error_rec[$this->regno]="score greater than the maximum"; return $error_rec;}

     $assessmodel=new StudentExtAssess();
     $assessmodel->reg_no=$this->regno;
     $assessmodel->score=$this->score;
     $assessmodel->assessID=$this->assessid;

     if($assessmodel->save()){
       return $error_rec;
      }
     else{ 
       $error_rec[$this->regno]=$assessmodel->getErrors()['reg_no'][0];
       return $error_rec;
      }

   }

   public function editrecord($recid)
   {
    if(!$this->validate()){
      return false;
  }
  $error_rec=[];
  $assmark=ExtAssess::findOne($this->assessid)->total_marks;
  
  if($this->score>$assmark){$error_rec[$this->regno]="score greater than the maximum"; return $error_rec;}

  $assessmodel=StudentExtAssess::findOne($recid);
  $assessmodel->reg_no=$this->regno;
  $assessmodel->score=$this->score;
  $assessmodel->assessID=$this->assessid;

  if($assessmodel->save()){
    return $error_rec;
   }
  else{ 
    $error_rec[$this->regno]=$assessmodel->getErrors()['reg_no'][0];
    return $error_rec;
   }




   }


}
        
?>