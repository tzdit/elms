<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\ProgramCourse;
use yii\helpers\ArrayHelper;
class StudentAssign extends Model{
    
    public $programs;
    public $level=0;
   
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
  public function removeStudents()
  {
    $programs=$this->programs;
    $errors=[];
    if($this->level==0)
    {
      $all_levels=[1,2,3,4,5];
      for($l=0;$l<count($all_levels);$l++)
      {
       $newlevel=$all_levels[$l];
      for($p=0;$p<count($programs);$p++)
      {
       $progcourse=ProgramCourse::find()->where(['programCode'=>$programs[$p],'level'=>$newlevel, 'course_code'=>yii::$app->session->get('ccode')])->one();
       if($progcourse==null){
        $errors[$programs[$p]." ".$newlevel]="Not assigned to this course";
         continue;
        }
  
       if(!$progcourse->delete()){
  
        $errors[$programs[$p]]=!empty($progcourse->getErrors()['programCode'])?$progcourse->getErrors()['programCode'][0]:$progcourse->getErrors()['course_code'][0];
         continue;
        }
  
      }
    }
    }
    else
    {
    for($p=0;$p<count($programs);$p++)
    {
     $progcourse=ProgramCourse::find()->where(['programCode'=>$programs[$p],'level'=>$this->level, 'course_code'=>yii::$app->session->get('ccode')])->one();
     if($progcourse==null){
      $errors[$programs[$p]." ".$this->level]="Not assigned to this course";
       continue;
      }

     if(!$progcourse->delete()){

      $errors[$programs[$p]]=!empty($progcourse->getErrors()['programCode'])?$progcourse->getErrors()['programCode'][0]:$progcourse->getErrors()['course_code'][0];
       continue;
      }

    }
  }

   return $errors;
  }

  public function getAssignedPrograms()
  {
    $programs=ProgramCourse::find()->joinWith('programCode0')->where(['course_code'=>yii::$app->session->get('ccode')])->all();
    $programs=ArrayHelper::map($programs,'programCode0.programCode','programCode0.prog_name');
    
    return $programs;
  }
}
?>