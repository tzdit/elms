<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\ProgramCourse;
class StudentAssign extends Model{
    
    public $programs;
    public $level;
   
    public function rules(){
        return [
           
           [['programs','level'], 'required'],
           
           
        ];

    }
  public function assignStudents()
  {
    $programs=$this->programs;
    $errors=[];
    for($p=0;$p<count($programs);$p++)
    {

     $progcourse=new ProgramCourse();
     $progcourse->programCode=$programs[$p];
     $progcourse->course_code=yii::$app->session->get('ccode');
     $progcourse->level=$this->level;

     if(!$progcourse->save()){

      $errors[$programs[$p]]=!empty($progcourse->getErrors()['programCode'])?$progcourse->getErrors()['programCode'][0]:$progcourse->getErrors()['course_code'][0];
       continue;
      }

    }

   return $errors;

  }
}
?>