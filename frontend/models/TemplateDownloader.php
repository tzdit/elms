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

     $levels=[1,2,3,4,5];
        for($l=0;$l<count($levels);$l++)
        {
        $level=$levels[$l];
        $coursePrograms=ProgramCourse::find()->where(['course_code'=>yii::$app->session->get('ccode'),'level'=>$level])->all();
        foreach($coursePrograms as $program)
        {
   
         $programStudents=$program->programCode0->students;
   
         for($s=0;$s<count($programStudents);$s++){
   
           if($programStudents[$s]->YOS===$level)
           {
           array_push($students,$programStudents[$s]);
           }
         }
   
   
        }
       }
     $carryovers=StudentCourse::find()->where(['course_code'=>$this->courseCode])->all(); 

     foreach($carryovers as $carry)
     {
      array_push($students,$carry->regNo);
     }
     
     //shuffle($students); //shuffling closed for a while
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
        $sheet=$spreadsheet->getActiveSheet();
         //setting autoresize and styles
         $styleArray = [
          'font' => [
              'bold' => true,
          ],
          'fill' => [
              'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
              'color' => [
                'argb' => 'FFC4ECFF'
              ]
             
            
      ]];
      //border styles

      $borderstyleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'aa000000'],
            ],
        ],
    ];

       //the styles
     

          $sheet->getStyle('A1:' . $sheet->getHighestColumn().'1')->applyFromArray($styleArray);
          $sheet->getStyle('A1:' . $sheet->getHighestColumn().$sheet->getHighestRow())->applyFromArray($borderstyleArray);
         

    
      
        $list= $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow(), '', TRUE, TRUE, TRUE);
        
        //the auto resizing
        for($c=1;$c<=count($list);$c++)
        {
          $col=$list[$c];

          foreach($col as $header=>$cont)
          {

            $sheet->getColumnDimension($header)->setAutoSize(true);
            
          }

        }
   
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