<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Student;
use common\models\StudentCourse;
use common\models\ProgramCourse;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\IOFactory;
class StudentTemplateDownload extends Model{

 


    private function generateExcelOutputing()
    {
    
     $stringforexcel="<table>
     <tr>
     <td>First Name</td>
     <td>Middle Name</td>
     <td>Last Name</td>
     <td>Registration Number</td>
     <td>Student Email</td>
     <td>Phone Number</td>
     <td>Gender</td>
     <td>Student Program</td>
     <td>Registration Status</td>
     <td>YOS</td>
     </tr>";
       

     

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
        
        $filename="_AssessmentTemplate.Xlsx";
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