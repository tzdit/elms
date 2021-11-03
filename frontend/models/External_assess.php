<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
use common\models\GroupGenerationAssignment;
use common\models\Assq;
use common\models\GroupAssignment;
use common\models\ExtAssess;
use common\models\StudentExtAssess;
use common\models\StudentCourse;
use common\models\Student;
use common\models\ProgramCourse;
use PhpOffice\PhpSpreadsheet\IOFactory;
class External_assess extends Model{
    public $assTitle;
    public $assFile;
    public $filetmp;
    public $totalMarks;
    public function rules(){
        return [
           ['assTitle','string', 'max'=>40],
           [['totalMarks'], 'required'],
           [['assFile'],'file','skipOnEmpty' => false, 'extensions' => 'xlsx, xls']
        ];

    }
    public function excel_importer(){
      
      if(!$this->validate()){
         return false;
     }
     try{
          $data=$this->excel_to_array($this->filetmp);
          //$status=false;
          $error_rec=[];
          //saving the assessment first

          $assmodel=new ExtAssess();
          $assmodel->instructorID=Yii::$app->user->identity->instructor->instructorID;
          $assmodel->course_code=yii::$app->session->get('ccode');
          $assmodel->title=$this->assTitle;
          $assmodel->yearID=1;
          $assmodel->total_marks=$this->totalMarks;

          if($assmodel->save())
          {
            $assid=$assmodel->assessID;
          for($ass=0;$ass<count($data);$ass++)
          {
            
             if($ass==0){continue;}
             else
             {
             $regno=$data[$ass][0];
             $score=$data[$ass][1];
             $model=new StudentExtAssess();
          
             $model->reg_no=$regno;
             $model->score=$score;
             //does the student take this course

             $student=Student::findOne($regno);

             if($student==null)
             {
              $error_rec[$regno]="Invalid reg. no, might have not registered";
              continue;
             }
             $studentProgram=$student->programCode;
             $programcourse=ProgramCourse::findOne(['programCode'=>$studentProgram,'course_code'=>yii::$app->session->get('ccode')]); //for regular courses;
             $studentcourse=StudentCourse::find()->where(['reg_no'=>$regno,'course_code'=>yii::$app->session->get('ccode')])->one(); //may be a carry over course
             
             if($programcourse==null && $studentcourse==null)
             {
              $error_rec[$regno]="Does not take this course";
              continue;
             }
             //the score
             if($score>$assmodel->total_marks)
             {
              $error_rec[$regno]="score greater than the maximum";
              continue;
             }

             $model->assessID=$assid;
             if(!$model->save())
             {
              
              $error_rec[$regno]=!empty($model->getErrors()['reg_no'])?$model->getErrors()['reg_no'][0]:$model->getErrors()['score'][0];
              
             }
             }
          } 

        return $error_rec;
        }
        else
        {
          return false;
        }
    }catch(\Exception $e){
      print  "oops".$e->getMessage();
        return false;
    }
    }
private function excel_to_array($tmpfile)
{
 $file_type=IOFactory::identify($tmpfile);
 $reader=IOFactory::createReader($file_type);
  $data=$reader->load($tmpfile);
  $data_array=$data->getActiveSheet()->toArray();
  return $data_array;

}
}
?>