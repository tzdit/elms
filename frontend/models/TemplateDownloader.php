<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Student;
use common\models\StudentCourse;
use common\models\ProgramCourse;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\IOFactory;
class TemplateDownloader extends Model{

    public $courseCode;
 


    private function generateExcelOutputing()
    {
    
     $stringforexcel="<table><tr><td>Registration number</td><td>Score</td></tr>";
       //selecting all students in a given course
     $regno=[];
     $students=[];

     $coursePrograms=ProgramCourse::find()->where(['course_code'=>$this->courseCode])->all();
     foreach($coursePrograms as $program)
     {

      $programStudents=$program->programCode0->students;

      for($s=0;$s<count($programStudents);$s++){array_push($students,$programStudents[$s]);}


     }
     $carryovers=StudentCourse::find()->where(['course_code'=>$this->courseCode])->all(); 

     foreach($carryovers as $carry)
     {
      array_push($students,$carry->regNo);
     }
     
     shuffle($students);
     for($i=0;$i<count($students);$i++)
     {
       array_push($regno,$students[$i]->reg_no);

     }

     //adding more records

     for($r=0;$r<count($regno);$r++)
     {
       $reg=$regno[$r];
       $rec="<tr><td>".$reg."</td><td></td></tr>";
       $stringforexcel.=$rec;

     }

     $stringforexcel.="</table>";

     return $stringforexcel;
    }
    public function excelProduce()
    {
        $content=$this->generateExcelOutputing();

        $reader = new Html();
        $spreadsheet = $reader->loadFromString($content);
        ob_clean();
        $writer=IOFactory::createWriter($spreadsheet, 'Xlsx');
        
        $filename=$this->courseCode."_AssessmentTemplate.Xlsx";
        $filename = str_replace(' ', '', $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');

        ob_end_clean();
        $writer->save('php://output'); 

        exit();

        return true;
    }



}
?>