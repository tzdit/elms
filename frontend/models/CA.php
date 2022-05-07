<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Course;
use common\models\GroupGenerationAssignment;
use common\models\Assignment;
use common\models\GroupAssignment;
use common\models\GroupAssignmentSubmit;
use common\models\Submit;
use common\models\ProgramCourse;
use common\models\StudentAssignment;
use common\models\ExtAssess;
use common\models\StudentCourse;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Mpdf\Mpdf;
use common\models\Student;

class CA extends Model{
    public $otherAssessments=[];
    public $Assignments=[];
    public $LabAssignments=[];
    public $assreduce;
    public $labreduce;
    public $otherassessreduce;
    public $allstudents;

    public $version;
    public $caTitle;
    public $labGrandMax;
    public $assGrandMax;
    public $otherGrandMax;

    public $GrandMax;


    public function generateExcelCA()
    {
      return $this->CA2Exceldownloader($this->CAbuilder());
    }
    public function generatePdfCA()
    {
      return $this->CA2Pdfdownloader($this->CAbuilder());
    }
    private function CAbuilder()
    {
     
      $this->setallstudents();
      $student_with_marks=$this->allstudents;
      $caheader="<tr bgcolor='#c4ecff'><td rowspan=2>Registration number</td>";
      $ca_sub_header="<tr bgcolor='#c4ecff'>";
      $rows=[];
      $catable="<table class='table-bordered table-hover shadow' cellspacing=0 autosize=2 text-align='center' align='center'>";
      if(!empty($this->Assignments) && !empty($this->allstudents)){
        $student_with_marks=$this->asscumul($this->Assignments,$this->allstudents);
        $caheader.=$this->catable_header($student_with_marks,"Assignments");
        $ca_sub_header.=$this->ca_subheader($student_with_marks,"Assignments");
        $rows=$this->carows($student_with_marks,"Assignments",$rows);
      }
      if(!empty($this->LabAssignments) && !empty($student_with_marks)){
        $student_with_marks=$this->labcumul($this->LabAssignments,$student_with_marks);
        $caheader.=$this->catable_header($student_with_marks,"Lab Assignments");
        $ca_sub_header.=$this->ca_subheader($student_with_marks,"Lab Assignments");
        $rows=$this->carows($student_with_marks,"Lab Assignments",$rows);
      }
      if(!empty($this->otherAssessments) && !empty($student_with_marks)){
        $student_with_marks=$this->otherAssessCumul($this->otherAssessments,$student_with_marks);
        $caheader.=$this->catable_header($student_with_marks,"Other Assessments");
        $ca_sub_header.=$this->ca_subheader($student_with_marks,"Other Assessments");
        $rows=$this->carows($student_with_marks,"Other Assessments",$rows);
      }
    
      $grandtotal=$this->labGrandMax+$this->assGrandMax+$this->otherGrandMax;
      $caheader.="<td rowspan=2>Grand Total /".$grandtotal."</td>";
      $caheader.="</tr>";
      $ca_sub_header.="</tr>";
      $catable.=$caheader;
      $catable.=$ca_sub_header;
      //the grandtotals
      $rows=empty($rows)?null:$this->addGrandTotals($rows,$this->addEncompletes($student_with_marks));
      //closing the rows tags and adding them to the table
      if($rows!=null)
      {
      for($r=0;$r<count($rows);$r++)
      {
        $rows[$r]=$rows[$r]."</tr>";
        
        $catable.=$rows[$r];
      }
      
      
      $catable.="</table>";
      return $catable;
    }
    else
    {
      return null;
    }
       

    

   
      
    }

    private function singleCAbuilder()
    {
     
      $this->setSingleCaScorer();
      $student_with_marks=$this->allstudents;
      $singleCa=[];
      $caheader="<tr style='background-color:#f0fbff;text-align:center;'><td rowspan=2>Registration number</td>";
      $ca_sub_header="<tr style='background-color:#f0fbff;text-align:center;'>";
      $rows=[];
      $grandtotal=0;
      $catable="<table class='table-bordered table-responsive table-hover shadow text-sm responsivetext' style='width:100%' cellspacing=0 autosize=2 text-align='center' align='center'>";
      if(!empty($this->Assignments) && !empty($this->allstudents)){
        $student_with_marks=$this->asscumul($this->Assignments,$this->allstudents);
        $caheader.=$this->catable_header($student_with_marks,"Assignments");
        $ca_sub_header.=$this->ca_subheader($student_with_marks,"Assignments");
        $rows=$this->carows($student_with_marks,"Assignments",$rows);
        $grandtotal+=$this->assGrandMax;
      }
      if(!empty($this->LabAssignments) && !empty($student_with_marks)){
        $student_with_marks=$this->labcumul($this->LabAssignments,$student_with_marks);
        $caheader.=$this->catable_header($student_with_marks,"Lab Assignments");
        $ca_sub_header.=$this->ca_subheader($student_with_marks,"Lab Assignments");
        $rows=$this->carows($student_with_marks,"Lab Assignments",$rows);
        $grandtotal+=$this->labGrandMax;
      }
      if(!empty($this->otherAssessments) && !empty($student_with_marks)){
        $student_with_marks=$this->otherAssessCumul($this->otherAssessments,$student_with_marks);
        $caheader.=$this->catable_header($student_with_marks,"Other Assessments");
        $ca_sub_header.=$this->ca_subheader($student_with_marks,"Other Assessments");
        $rows=$this->carows($student_with_marks,"Other Assessments",$rows);
        $grandtotal+=$this->otherGrandMax;
      }
      $caheader.="<td rowspan=2>Grand Total /".$grandtotal."</td>";
      $caheader.="</tr>";
      $ca_sub_header.="</tr>";
      $catable.=$caheader;
      $catable.=$ca_sub_header;
      //the grandtotals
      $rows=empty($rows)?null:$this->addGrandTotals($rows,$this->addEncompletes($student_with_marks));
      //closing the rows tags and adding them to the table
      if($rows!=null)
      {
      for($r=0;$r<count($rows);$r++)
      {
        $rows[$r]=$rows[$r]."</tr>";
        
        $catable.=$rows[$r];
      }
      
      
      $catable.="</table>";
      $singleCa['grandscore']=$this->singleCaGrandTotal($this->addEncompletes($student_with_marks));
      $singleCa['detailed']=$catable;
      $singleCa['grandMax']=$grandtotal;
      return $singleCa;
    }
    else
    {
      return null;
    }
      
    }

    public function getMyCa()
    {
      $allcas=$this->findAllCAs();
      if($allcas==null || empty($allcas)){return null;}
      $mycas=[];
      foreach($allcas as $index=>$ca)
      {
        if(!$this->isCaPublished($index)){continue;}
        $this->loadCAdata($index);
        try
        {
        $mycas[$ca]['details']=($this->singleCAbuilder())['detailed'];
        $mycas[$ca]['grandscore']=($this->singleCAbuilder())['grandscore'];
        $mycas[$ca]['grandmax']=($this->singleCAbuilder())['grandMax'];
        }
        catch(\Exception $d)
        {
          continue;
        }
      }
      if(empty($mycas)){return null;}
      return $mycas;
    }

    private function isCaPublished($ca)
    {
      if($this->readCAdata($ca)==null){return false;}
      if(!isset(($this->readCAdata($ca))['CA']['published'])){return false;}
      if(($this->readCAdata($ca))['CA']['published']==true)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    private function ca_subheader($data,$type)
    {
      foreach($data as $reg=>$assess)
      {
        $cont=$assess[$type];
        $subheader="";
        $totalmax=$cont["max"];
        foreach($cont as $item=>$val)
        {
          $totalheader=$item;
          if($item=="max"){continue;}
          if($item==="total"){$totalheader=$totalheader." /".$totalmax;}
          $subheader.="<td>{$totalheader}</td>";
          
         
        }
       
      }
      return  $subheader;
    }
    private function catable_header($data,$type)
    {
      $span=count(array_column($data,$type)[0])-1;
      $header="";
      foreach($data as $reg=>$assess)
      {
        $cont=$assess[$type];
        foreach($cont as $item=>$val)
        {
          $header="<td colspan={$span}>{$type}</td>";
        }
        
      }
     
      return $header;
    }
    private function carows($data,$type,$prev)
    {
      $prevrows=$prev;
      if(empty($prevrows))
      {
      $studrecords=[];
      foreach($data as $reg=>$assess)
      {
        $cont=$assess[$type];
        $rec="";
        $rec.="<tr><td>{$reg}</td>";
        foreach($cont as $item=>$val)
        {
          if($item!="max"){
            $rec.="<td>{$val}</td>";
          }
          
        }
        array_push($studrecords,$rec);
      }
      return $studrecords;
    }
    else
    {
      $studrecords=[];
      foreach($data as $reg=>$assess)
      {
        $cont=$assess[$type];
        $rec="";
        foreach($cont as $item=>$val)
        {
          if($item!="max"){
            $rec.="<td>{$val}</td>";
          }
          
        }
       
        array_push($studrecords,$rec);
      }
      for($z=0;$z<count($prevrows);$z++)
      {

        $prevrows[$z]=$prevrows[$z].$studrecords[$z];

      }

     return $prevrows;
    }
    
    }
    private function addGrandTotals($prev,$data)
    {
       //adding the grand total
     $prevrows=$prev;
     $grandmax=[];
   
     foreach($data as $reg=>$assess)
     {
       $rec="";
      
       $grandma=$data[$reg]["GrandTotal"];
       $rec.="<td class='grandscore'>{$grandma}</td>"; 
       array_push($grandmax,$rec);
     }
     for($g=0;$g<count($prevrows);$g++)
     {

       $prevrows[$g]=$prevrows[$g].$grandmax[$g];

     }
   
     return  $prevrows;
    }

    private function singleCaGrandTotal($data)
    {
     $grandma=0;
   
     foreach($data as $reg=>$assess)
     {
       $grandma=$data[$reg]["GrandTotal"];
     }

     return  $grandma;
    }
    private function asscumul($assign,$stud)
    {
       //getting all assignments
       $assignments=$assign;
       $students=$stud;
       $reduce=$this->assreduce;
       $max=0;

       for($a=0;$a<count($assignments);$a++)
       {
        $assid=$assignments[$a];
        $ass=Assignment::findOne($assid);
        $assmax=$ass->total_marks;
        $max=$max+$assmax;
       }
       for($a=0;$a<count($assignments);$a++)
       {
         $assid=$assignments[$a];
         $ass=Assignment::findOne($assid);
         $asstile=$ass->assName;
         $assmax=$ass->total_marks;

         $assheader=$asstile." /".$assmax;

         $maxheader=(isset($reduce) && !empty($reduce))?$reduce:$max;
         $reducefactor=(isset($reduce) && !empty($reduce))?$reduce:$max;
    
         $assignment_scores=$this->getAssignentScores($assid);
         //adding this assignment to each student in a class
         foreach($students as $reg=>$prop)
         {
          $students[$reg]["Assignments"][$assheader]=null;
          $students[$reg]["GrandTotal"]=null; //and the grand total;
          $students[$reg]["Assignments"]["max"]=$maxheader;
         }
         //getting each student score
       
         foreach($assignment_scores as $reg=>$sc)
         {
           if(!isset($students[$reg])){continue;}
           $students[$reg]["Assignments"][$assheader]=$sc;
           $students[$reg]["Assignments"]["total"]=!empty($sc)?$students[$reg]["Assignments"]["total"]+$sc:null;
           
         }
        

       }
        //reducing if there is one

        foreach($students as $reg=>$sc)
        {
         
           $students[$reg]["Assignments"]["total"]=($students[$reg]["Assignments"]["total"]!==null)?($students[$reg]["Assignments"]["total"]*$reducefactor)/$max:null;
           $students[$reg]["Assignments"]["total"]=($students[$reg]["Assignments"]["total"]!==null)?round($students[$reg]["Assignments"]["total"],2):null;
         }

         //adding the grand total

         foreach($assignment_scores as $reg=>$sc)
         {
           if(!isset($students[$reg])){continue;}
           $students[$reg]["GrandTotal"]=(isset($students[$reg]["Assignments"]["total"]))?$students[$reg]["Assignments"]["total"]:null;
        
          
         }
         $this->assGrandMax=$maxheader;

         //reversing the array

         foreach($students as $reg=>$sc)
         {
          
            $students[$reg]["Assignments"]=array_reverse($students[$reg]["Assignments"]);
          
          }

       return $students;
    }
    private function labcumul($assign,$stud)
    {
         //getting all assignments

         $assignments=$assign;
         $students=$stud;
         $reduce=$this->labreduce;
         $max=0;
  
         for($a=0;$a<count($assignments);$a++)
         {
          $assid=$assignments[$a];
          $ass=Assignment::findOne($assid);
          $assmax=$ass->total_marks;
          $max=$max+$assmax;
         }
         for($a=0;$a<count($assignments);$a++)
         {
           $assid=$assignments[$a];
           $ass=Assignment::findOne($assid);
           $asstile=$ass->assName;
           $assmax=$ass->total_marks;
  
           $assheader=$asstile." /".$assmax;
  
           $maxheader=(isset($reduce) && !empty($reduce))?$reduce:$max;
           $reducefactor=(isset($reduce) && !empty($reduce))?$reduce:$max;
      
           $assignment_scores=$this->getAssignentScores($assid);
           
           //adding this assignment to each student in a class
           foreach($students as $reg=>$prop)
           {
            $students[$reg]["Lab Assignments"][$assheader]=null;
            $students[$reg]["Lab Assignments"]["max"]=$maxheader;
           }
           //getting each student score
          
           foreach($assignment_scores as $reg=>$sc)
           {
            if(!isset($students[$reg])){continue;}
             $students[$reg]["Lab Assignments"][$assheader]=$sc;
             $students[$reg]["Lab Assignments"]["total"]=!empty($sc)?$students[$reg]["Lab Assignments"]["total"]+$sc:null;
             
           }
  
          
  
          
  
         }
          //reducing if there is one
  
          foreach($students as $reg=>$sc)
          {
           
             $students[$reg]["Lab Assignments"]["total"]=($students[$reg]["Lab Assignments"]["total"]!==null)?($students[$reg]["Lab Assignments"]["total"]*$reducefactor)/$max:null;
             $students[$reg]["Lab Assignments"]["total"]=($students[$reg]["Lab Assignments"]["total"]!==null)?round($students[$reg]["Lab Assignments"]["total"],2):null;
           }

          //adding the grand total
          foreach($students as $regno=>$cont)
          {
            if(!isset($students[$regno])){continue;}
            //print($cont['GrandTotal']);
            $total=$students[$regno]["Lab Assignments"]["total"];
            $students[$regno]["GrandTotal"]=(isset($students[$regno]["GrandTotal"]))?$students[$regno]["GrandTotal"]+$total:$total;
          }
          //adding the assignments grandmax
          $this->labGrandMax=$maxheader;

           //reversing the array

           foreach($students as $reg=>$sc)
           {
            
              $students[$reg]["Lab Assignments"]=array_reverse($students[$reg]["Lab Assignments"]);
            
            }
         return $students;
    }
    private function otherAssessCumul($assess,$stud)
    {
         //getting all assignments

         $assessments=$assess;
         $students=$stud;
         $reduce=$this->otherassessreduce;
         $max=0;
  
         for($a=0;$a<count($assessments);$a++)
         {
          $assid=$assessments[$a];
          $ass=ExtAssess::findOne($assid);
          $assmax=$ass->total_marks;
          $max=$max+$assmax;
         }
         for($a=0;$a<count($assessments);$a++)
         {
           $assid=$assessments[$a];
           $ass=ExtAssess::findOne($assid);
           $asstile=$ass->title;
           $assmax=$ass->total_marks;
  
           $assheader=$asstile." /".$assmax;
  
           $maxheader=(isset($reduce) && !empty($reduce))?$reduce:$max;
           $reducefactor=(isset($reduce) && !empty($reduce))?$reduce:$max;
      
           $assessment_scores=$this->getOtherAssessmentScore($assid);
           
           //adding this assignment to each student in a class
           foreach($students as $reg=>$prop)
           {
            $students[$reg]["Other Assessments"][$assheader]=null;
            $students[$reg]["Other Assessments"]["max"]=$maxheader;
           }
           //getting each student score
          
           foreach($assessment_scores as $reg=>$sc)
           {
            if(!isset($students[$reg])){continue;}
             $students[$reg]["Other Assessments"][$assheader]=$sc;
             $students[$reg]["Other Assessments"]["total"]=!empty($sc)?$students[$reg]["Other Assessments"]["total"]+$sc:null;
            
           }
  
        
         }
          //reducing if there is one
  
          foreach($students as $reg=>$sc)
          {
           
             $students[$reg]["Other Assessments"]["total"]=($students[$reg]["Other Assessments"]["total"]!==null)?($students[$reg]["Other Assessments"]["total"]*$reducefactor)/$max:null;
             $students[$reg]["Other Assessments"]["total"]=($students[$reg]["Other Assessments"]["total"]!==null)?round($students[$reg]["Other Assessments"]["total"],2):null;
           }

          //adding the grand total
          foreach($students as $regno=>$cont)
          {
            if(!isset($students[$regno])){continue;}
            //print($cont['GrandTotal']);
            $total=$students[$regno]["Other Assessments"]["total"];
            $students[$regno]["GrandTotal"]=(isset($students[$regno]["GrandTotal"]))?$students[$regno]["GrandTotal"]+$total:$total;
          }
          //adding the assignments grandmax
          $this->otherGrandMax=$maxheader;

             //reversing the array

             foreach($students as $reg=>$sc)
             {
              
                $students[$reg]["Other Assessments"]=array_reverse($students[$reg]["Other Assessments"]);
              
              }
         return $students;
    }
    private function getAssignentScores($id)
    {
      $scores=[];
      $assignment=Assignment::findOne($id);
      $asstype=$assignment->assType;

      switch($asstype)
      {

        case "allgroups":

        $submits=$assignment->groupAssignmentSubmits;
        
        //retreiving students for each submit
        
        for($sub=0;$sub<count($submits);$sub++)
        {
          $submit=$submits[$sub];
          $score=$submit->score;

          $group=$submit->group; //the submitted group;
          $students=$group->studentGroups; //the members;

          //taking each student and assigning the score;

          for($st=0;$st<count($students);$st++)
          {
            $student=$students[$st];
            $stud_regno=$student->reg_no; //but we only need the reg_no


            //pushing students onto the array, with their scores;
            $scores[$stud_regno]=$score; //all students members of a group get the group's score


          }



        }


        break;

        case "groups": //does not change the submits

        $submits=$assignment->groupAssignmentSubmits;
        
        //retreiving students for each submit
        
        for($sub=0;$sub<count($submits);$sub++)
        {
          $submit=$submits[$sub];
          $score=$submit->score;

          $group=$submit->group; //the submitted group;
          $students=$group->$studentGroups; //the members;

          //taking each student and assigning the score;

          for($st=0;$st<count($students);$st++)
          {
            $student=$students[$st];
            $stud_regno=$student->reg_no; //but we only need the reg_no


            //pushing students onto the array, with their scores;
            $scores[$stud_regno]=$score; //all students members of a group get the group's score


          }



        }

            break;

            case "allstudents":

                $submits=$assignment->submits;

                //getting the scores and pushing them onto the array

                for($sub=0;$sub<count($submits);$sub++)
                {
                  $submit=$submits[$sub];
                  $student=$submit->reg_no;
                  $score=$submit->score;

                  $scores[$student]=$score; //each students gets his individual score


                }




            break;
            case "students":

                $submits=$assignment->submits;

                //getting the scores and pushing them onto the array

                for($sub=0;$sub<count($submits);$sub++)
                {
                  $submit=$submits[$sub];
                  $student=$submit->reg_no;
                  $score=$submit->score;

                  $scores[$student]=$score; //each students gets his individual score


                }




            break;






      }


      return $scores;
    }


    private function getOtherAssessmentScore($otherassid)
    {
     
      $scores=[];
      $assess=ExtAssess::findOne($otherassid);
      $students=$assess->studentExtAssesses;

      for($st=0;$st<count($students);$st++)
      {
       $studassess=$students[$st];
       $student=$studassess->reg_no;
       $score=$studassess->score;

       $scores[$student]=$score;
      }


       return $scores;

    }

    private function setallstudents()
    {
      $students_for_assessments=[];
      $levels=[1,2,3,4,5];
      for($l=0;$l<count($levels);$l++)
      {
      $level=$levels[$l];
      $coursePrograms=ProgramCourse::find()->where(['course_code'=>yii::$app->session->get('ccode'),'level'=>$level])->all();
      foreach($coursePrograms as $program)
      {
 
       $programStudents=$program->programCode0->students;
       if(empty($programStudents) || $programStudents==null){continue;}
       for($s=0;$s<count($programStudents);$s++){
        if($programStudents[$s]->YOS===$level)
        {
        $students_for_assessments[$programStudents[$s]->reg_no]=array();
        if(!empty($this->Assignments)){
          $students_for_assessments[$programStudents[$s]->reg_no]["Assignments"]["total"]=null;
          $students_for_assessments[$programStudents[$s]->reg_no]["Assignments"]["max"]=null;
        }
        if(!empty($this->LabAssignments)){
          $students_for_assessments[$programStudents[$s]->reg_no]["Lab Assignments"]["total"]=null;
          $students_for_assessments[$programStudents[$s]->reg_no]["Lab Assignments"]["max"]=null;
        }
        if(!empty($this->otherAssessments)){
          $students_for_assessments[$programStudents[$s]->reg_no]["Other Assessments"]["total"]=null;
          $students_for_assessments[$programStudents[$s]->reg_no]["Other Assessments"]["max"]=null;
        }
        }
      
      }
 
 
      }
    }
      $carryovers=StudentCourse::find()->where(['course_code'=>yii::$app->session->get('ccode')])->all(); 
      foreach($carryovers as $carry)
      {
        $students_for_assessments[$carry->regNo->reg_no]=array();
        if(!empty($this->Assignments)){
          $students_for_assessments[$carry->regNo->reg_no]["Assignments"]["total"]=null;
          $students_for_assessments[$carry->regNo->reg_no]["Assignments"]["max"]=null;
        }
        if(!empty($this->LabAssignments)){
          $students_for_assessments[$carry->regNo->reg_no]["Lab Assignments"]["total"]=null;
          $students_for_assessments[$carry->regNo->reg_no]["Lab Assignments"]["max"]=null;
        }
        if(!empty($this->otherAssessments)){
          $students_for_assessments[$carry->regNo->reg_no]["Other Assessments"]["total"]=null;
          $students_for_assessments[$carry->regNo->reg_no]["Other Assessments"]["max"]=null;
        }
 
      }
     
      $this->allstudents=$students_for_assessments;
     
    
    }

    private function setSingleCaScorer()
    {
      $students_for_assessments=[];
      $student_id=yii::$app->user->id;
      $student=(Student::find()->where(['userID'=>$student_id])->one())->reg_no;

     
      if(!empty($this->Assignments)){
        $students_for_assessments[$student]["Assignments"]["total"]=null;
        $students_for_assessments[$student]["Assignments"]["max"]=null;
      }
      if(!empty($this->LabAssignments)){
        $students_for_assessments[$student]["Lab Assignments"]["total"]=null;
        $students_for_assessments[$student]["Lab Assignments"]["max"]=null;
      }
      if(!empty($this->otherAssessments)){
        $students_for_assessments[$student]["Other Assessments"]["total"]=null;
        $students_for_assessments[$student]["Other Assessments"]["max"]=null;
      }
      $this->allstudents=$students_for_assessments;
    }
    private function CA2Exceldownloader($ca)
    {
        $content=$ca;
        
        if($ca!=null)
        {
        $reader = new Html();
        $spreadsheet=new SpreadSheet();
        $spreadsheet = $reader->loadFromString($content);
        $sheet=$spreadsheet->getActiveSheet();
        
        //the logo

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('UDOM Logo');
        $drawing->setDescription('UDOM Logo');
        $drawing->setPath('img/logo.png');
        $drawing->setHeight(25);
        $drawing->setWorksheet($sheet);
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
     

          $sheet->getStyle('A1:' . $sheet->getHighestColumn().'2')->applyFromArray($styleArray);
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
        
        $filename=yii::$app->session->get('ccode')."_CA.Xlsx";
        $filename = str_replace(' ', '', $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');

        ob_end_clean();
        $writer->save('php://output'); 

        exit();
        return true;
      }
      else
      {
        return 'no content';
      }
        
    }

    //for previewing stats

    public function get_no_of_student()
    {
      $num_of_stud=0;
      

      if(!empty($this->Assignments)){
        $this->setallstudents();
        $num_of_stud=count($this->allstudents);
      }
   
      if(!empty($this->LabAssignments)){
        $this->setallstudents();
        $num_of_stud=count($this->allstudents);
      }
      if(!empty($this->otherAssessments)){
        $this->setallstudents();
        $num_of_stud=count($this->allstudents);
      }
      return $num_of_stud;
    }
    private function studentwithscores()
    {
      $this->setallstudents();
      $student_with_marks=[];
      if(!empty($this->Assignments) && !empty($this->allstudents)){
        $student_with_marks=$this->asscumul($this->Assignments,$this->allstudents);
      }
      else{$student_with_marks=$this->allstudents;}
      if(!empty($this->LabAssignments) && !empty($student_with_marks)){
        $student_with_marks=$this->labcumul($this->LabAssignments,$student_with_marks);
      }
      if(!empty($this->otherAssessments) && !empty($student_with_marks)){
        $student_with_marks=$this->otherAssessCumul($this->otherAssessments,$student_with_marks);
      }
    
      $this->GrandMax=$this->labGrandMax+$this->assGrandMax+$this->otherGrandMax;
    
      return $this->addEncompletes($student_with_marks);
       
    }
    public function getCarriedPercent()
    {
      $total_failed=0;
      $total_students=$this->get_no_of_student();
      $studentswithmarks=$this->studentwithscores();

      //looping through students and make required operations
      if(!empty($studentswithmarks))
      {
      foreach($studentswithmarks as $reg=>$assess)
      {
        $total_score=(isset($studentswithmarks[$reg]['GrandTotal']) && $studentswithmarks[$reg]['GrandTotal']!="Inc")?$studentswithmarks[$reg]['GrandTotal']:0;

        $scoreoverfourty=$this->GrandMax!=0?round(($total_score*40)/$this->GrandMax,2):0;

        if($scoreoverfourty<15.5)
        {
          $total_failed++;
        }

 

      }
    }
      $carrypercent=$total_students!=0?round(($total_failed*100)/$total_students,2):0;
      return $carrypercent." %";

   
      
    }

    public function getincompleteperc()
    {
          $studentwithmarks=$this->studentwithscores();
          $total_students=$this->get_no_of_student();
          $students_with_incomplete=0;
          if(!empty($studentwithmarks))
          {
          foreach($studentwithmarks as $reg=>$assess)
          {
          $status=false;
          $assignments=isset($studentwithmarks[$reg]['Assignments'])?$studentwithmarks[$reg]['Assignments']:null;
          $labs=isset($studentwithmarks[$reg]['Lab Assignments'])?$studentwithmarks[$reg]['Lab Assignments']:null;
          $other=isset($studentwithmarks[$reg]['Other Assessments'])?$studentwithmarks[$reg]['Other Assessments']:null;
          
          if($assignments!==null)
          {
          foreach($assignments as $title=>$score)
          {
            if($assignments[$title]==null){$status=true; break;}
            else{$status=false; continue;}

          }
        }
        if($labs!==null)
        {
          foreach($labs as $title=>$score)
          {
            if($status==true){break;}
            if($labs[$title]==null){$status=true; break;}
            else{$status=false; continue;}

          }
        }

        if($other!==null)
        {
          foreach($other as $title=>$score)
          {
            if($status==true){break;}
            if($other[$title]==null){$status=true; break;}
            else{$status=false; continue;}

          }
        }

          if($status===true){$students_with_incomplete++;}


      }
    }
      //the percentage

      $perc=$total_students!=0?round(($students_with_incomplete*100)/$total_students,2):0;

      return $perc." %";
    }

    private function addEncompletes($studentswithscores)
    {
      $studentwithmarks=$studentswithscores;
      

      if(!empty($studentwithmarks))
      {
      foreach($studentwithmarks as $reg=>$assess)
      {
         $status=false;
          $assignments=isset($studentwithmarks[$reg]['Assignments'])?$studentwithmarks[$reg]['Assignments']:null;
          $labs=isset($studentwithmarks[$reg]['Lab Assignments'])?$studentwithmarks[$reg]['Lab Assignments']:null;
          $other=isset($studentwithmarks[$reg]['Other Assessments'])?$studentwithmarks[$reg]['Other Assessments']:null;

          if($assignments!==null)
          {
          foreach($assignments as $title=>$score)
          {
            if($assignments[$title]===null){$status=true; break;}
            else{$status=false; continue;}

          }
        }
        if($labs!==null)
        {
          foreach($labs as $title=>$score)
          {
            if($status===true){break;}
            if($labs[$title]===null){$status=true; break;}
            else{$status=false; continue;}

          }
        }

        if($other!==null)
        {
          foreach($other as $title=>$score)
          {
            if($status===true){break;}
            if($other[$title]===null){$status=true; break;}
            else{$status=false; continue;}

          }
        }
           
          if($status===true){
            $studentwithmarks[$reg]['GrandTotal']="Inc";
          }

         
      }
    }
      return $studentwithmarks;
    }

    public function CA2Pdfdownloader($ca)
    {
        $content=$ca;
        if($ca!=null)
        {
        $instructor=Yii::$app->user->identity->instructor;
        $name=$instructor->full_name;
        $college=$instructor->department->college->college_name;
        $year=yii::$app->session->get('currentAcademicYear')->title;
        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->setFooter('{PAGENO}');
        $course=yii::$app->session->get('ccode');
        $courseTitle=Course::findOne($course)->course_name;
        $stylesheet = file_get_contents('css/capdf.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->SetWatermarkText('civeclassroom.udom.ac.tz',0.09);
        $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML('<div align="center"><img src="img/logo.png" /></div>',2);
        $mpdf->WriteHTML('<p align="center"><font size=7>The University of Dodoma</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=5>'.$college.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=5>'.$course.' '.$courseTitle.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=5>Final course assessment results ('.$year.')</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>By '.$name.'</font></p>',3);
        $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
        $mpdf->WriteHTML($content,3);
          
        $filename=yii::$app->session->get('ccode')."_CA.pdf";
        $filename = str_replace(' ', '', $filename);
        $mpdf->Output($filename,"D");

        return null;
    }
    else
    {
      return 'no content';
    }
  }

  private function getCAsnumber($course)
  {
    $year=yii::$app->session->get('currentAcademicYear');
    $yearTitle=$year->title;
    $ca_location='storage/CAs/'.$yearTitle.'/'.$course;
    $cashome="storage/CAs/".$yearTitle."/".$course."/";
    $ca_number=0;
    if(!is_dir($cashome)){return 0;}

   if($opened_dir=opendir($cashome))
   {
     while(($ca=readdir($opened_dir))!==false)
     {
      if($ca!="." && $ca!="..")
      {
        $ca_number++;
      }
      
     }
     closedir($opened_dir);
   }

   

   return $ca_number;
    
  }

  public function CAsaver($ca)
  {
    if($ca==null){return false;}
    $year=yii::$app->session->get('currentAcademicYear');
    $ca['CA']['year']=$year->yearID;
    $course=str_replace(' ','',yii::$app->session->get('ccode'));
    $ca_version=($ca['CA']['version']!=null)?$ca['CA']['version']:($this->getCAsnumber($course)+1);
    $ca['CA']['version']=$ca_version;
    if($ca_version<=1){$ca['CA']['published']=false;}
    $ca_data=ClassRoomSecurity::encrypt(json_encode($ca));

    //preparing the ca name

    try
    {
    $yearTitle=$year->title;
    $ca_name=$course.'_CA_V'.$ca_version;
    $ca_location='storage/CAs/'.$yearTitle.'/'.$course;
    if(!is_dir($ca_location)){mkdir($ca_location,0777,true);}
    $ca_file=$ca_location.'/'.$ca_name.'.ca';

    file_put_contents($ca_file,$ca_data,LOCK_EX);
    
    $message=($ca_version>1)?"CA saved successfully":"CA updated successfully";
    yii::$app->session->setFlash('success',"<i class='fa fa-info-circle'></i> ".$message);
    return true;
    }
    catch(Exception $c)
    {
        $message=($ca_version>1)?"Could not save CA, try again later":"Could not update CA, try again later";
        yii::$app->session->setFlash('error',"<i class='fa fa-info-circle'></i> ".$message);
        return false;
    }

  }
  private function readCAdata($ca)
  {
    $year=yii::$app->session->get('currentAcademicYear');
    $course=str_replace(' ','',yii::$app->session->get('ccode'));
    $ca_location='storage/CAs/'.$year->title.'/'.$course.'/'.$ca;

    try
    {
    if(!file_exists($ca_location)){return null;}
    $ca_data=file_get_contents($ca_location);

    if($ca_data!=false){

      $ca_data=json_decode(ClassRoomSecurity::decrypt($ca_data),true);
    }
    return $ca_data;
    }
  catch(Exception $r)
    {
    return null;
    }
    
  }
 public function getCaData($ca)
 {
   return $this->readCAdata($ca);
 }
  public function loadCAdata($ca)
  {
    $cadata=$this->readCAdata($ca);
    $this->caTitle=basename($ca,'.ca');
    $this->Assignments=($cadata!=null)?$cadata['CA']['Assignments']:[];
    $this->otherAssessments=($cadata!=null)?$cadata['CA']['otherAssessments']:[];
    $this->LabAssignments=($cadata!=null)?$cadata['CA']['LabAssignments']:[];
    $this->assreduce=($cadata!=null)?$cadata['CA']['assreduce']:null;
    $this->labreduce=($cadata!=null)?$cadata['CA']['labreduce']:null;
    $this->otherassessreduce=($cadata!=null)?$cadata['CA']['otherassessreduce']:null;
    $this->version=($cadata!=null)?$cadata['CA']['version']:null;
  
  }
  public function CAsavePublished($ca)
  {
    if($ca==null){return false;}
    $year=yii::$app->session->get('currentAcademicYear');
    $ca['CA']['year']=$year->yearID;
    $course=str_replace(' ','',yii::$app->session->get('ccode'));
    $ca_version=($ca['CA']['version']!=null)?$ca['CA']['version']:($this->getCAsnumber($course)+1);
    $ca['CA']['version']=$ca_version;
    $ca['CA']['published']=true;
    $ca_data=ClassRoomSecurity::encrypt(json_encode($ca));

    //preparing the ca name

    try
    {
    $yearTitle=$year->title;
    $ca_name=$course.'_CA_V'.$ca_version;
    $ca_location='storage/CAs/'.$yearTitle.'/'.$course;
    if(!is_dir($ca_location)){mkdir($ca_location,0777,true);}
    $ca_file=$ca_location.'/'.$ca_name.'.ca';

    file_put_contents($ca_file,$ca_data,LOCK_EX);
    
    $message=($ca_version>1)?"CA saved successfully":"CA updated successfully";
    yii::$app->session->setFlash('success',"<i class='fa fa-info-circle'></i> ".$message);
    return true;
    }
    catch(Exception $c)
    {
        $message=($ca_version>1)?"Could not save CA, try again later":"Could not update CA, try again later";
        yii::$app->session->setFlash('error',"<i class='fa fa-info-circle'></i> ".$message);
        return false;
    }
  }

  public function findAllCAs()
  {
    $course=str_replace(' ','',yii::$app->session->get('ccode'));
    $year=yii::$app->session->get('currentAcademicYear');
    $yearTitle=$year->title;
    $ca_location='storage/CAs/'.$yearTitle.'/'.$course;
    try
    {
    if(!file_exists($ca_location) || !is_dir($ca_location)){ return [];}
    $CAs=scandir($ca_location);
    $CAnames=array();
    if($CAs=="false"){return [];}
    for($c=0;$c<count($CAs);$c++)
    {
      
      if($CAs[$c]=="." || $CAs[$c]==".."){continue;}
      else{
        if(!$this->isCaCurrent($CAs[$c])){continue;}
        $CA_name=basename($CAs[$c],".ca");
      }
      $CAnames[$CAs[$c]]=$CA_name;
    }
    return $CAnames;
   }
   catch(Exception $ca)
   {
     return [];
   }
}
  
  public function publishCA($ca)
  {
    $ca=$this->readCAdata(ClassRoomSecurity::decrypt($ca));
    return $this->CAsavePublished($ca);
  } 
  
  private function isCaCurrent($ca)
  {
    return ($this->readCAdata($ca))['CA']['year']==(yii::$app->session->get('currentAcademicYear'))->yearID;
  }

  public function deleteCA($ca)
  {
    $ca=ClassRoomSecurity::decrypt($ca);
    $course=str_replace(' ','',yii::$app->session->get('ccode'));
    $year=yii::$app->session->get('currentAcademicYear');
    $yearTitle=$year->title;
    $ca_location='storage/CAs/'.$yearTitle.'/'.$course;
    $ca_target=$ca_location."/".$ca;

    try
    {
      if(file_exists($ca_target))
      {
        unlink($ca_target);
      }

      return true;
    }
    catch(Exception $a)
    {
      return false;
    }
  }

  public function findStudentCaScore()
  {
    $allCas=$this->findAllCAs();


  }
}
?>