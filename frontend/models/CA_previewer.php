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

class CA_previewer extends Model{
    public $otherAssessments=[];
    public $Assignments=[];
    public $LabAssignments=[];
    public $assreduce;
    public $labreduce;
    public $otherassessreduce;
    public $allstudents;

    public $labGrandMax;
    public $assGrandMax;
    public $otherGrandMax;

    public $GrandMax;
  
    public function previewCA()
    {
     
      $this->setallstudents();
      $student_with_marks=$this->allstudents;
      $caheader="<tr style='background-color:#f0fbff;text-align:center;'><td rowspan=2>Registration number</td>";
      $ca_sub_header="<tr style='background-color:#f0fbff;text-align:center;'>";
      $rows=[];
      $catable="<table class='table-bordered table-hover shadow'>";
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
        if($r>4){continue;}
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
      
       $grandma=isset($data[$reg]["GrandTotal"])?$data[$reg]["GrandTotal"]:null;
       $rec.="<td>{$grandma}</td>"; 
       array_push($grandmax,$rec);
     }
     for($g=0;$g<count($prevrows);$g++)
     {

       $prevrows[$g]=$prevrows[$g].$grandmax[$g];

     }
   
     return  $prevrows;
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
         $count=0;
         foreach($assignment_scores as $reg=>$sc)
         {
           if(!isset($students[$reg])){continue;}
           if($count>4){break;}
           $students[$reg]["Assignments"][$assheader]=$sc;
           $students[$reg]["Assignments"]["total"]=!empty($sc)?$students[$reg]["Assignments"]["total"]+$sc:null;
           $count++;
         }

        

       }
        //reducing if there is one

        foreach($students as $reg=>$sc)
        {
         
           $students[$reg]["Assignments"]["total"]=($students[$reg]["Assignments"]["total"]!==null)?($students[$reg]["Assignments"]["total"]*$reducefactor)/$max:null;
           $students[$reg]["Assignments"]["total"]=($students[$reg]["Assignments"]["total"]!==null)?round($students[$reg]["Assignments"]["total"],2):null;
         }

         //adding the grand total

         foreach($students as $reg=>$sc)
         {
          if(!isset($students[$reg])){continue;}
          $students[$reg]["GrandTotal"]=(isset($students[$reg]["Assignments"]["total"]) && $students[$reg]["Assignments"]["total"]!=null)?$students[$reg]["Assignments"]["total"]:null;
        
          
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
           $count=0;
           foreach($assignment_scores as $reg=>$sc)
           {
            if(!isset($students[$reg])){continue;}
            if($count>4){break;}
             $students[$reg]["Lab Assignments"][$assheader]=$sc;
             $students[$reg]["Lab Assignments"]["total"]=!empty($sc)?$students[$reg]["Lab Assignments"]["total"]+$sc:null;
             $count++;
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
            //print($cont['GrandTotal']);
            if(!isset($students[$regno])){continue;}
            $total=!empty($students[$regno]["Lab Assignments"]["total"])?$students[$regno]["Lab Assignments"]["total"]:null;
            $students[$regno]["GrandTotal"]=(isset($students[$regno]["GrandTotal"]) && !empty($students[$regno]["GrandTotal"]))?$students[$regno]["GrandTotal"]+$total:$total;
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
           $count=0;
           foreach($assessment_scores as $reg=>$sc)
           {
             if($count>4){break;}
             $students[$reg]["Other Assessments"][$assheader]=$sc;
             $students[$reg]["Other Assessments"]["total"]=!empty($sc)?$students[$reg]["Other Assessments"]["total"]+$sc:null;
             $count++;
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
            //print($cont['GrandTotal']);
       
            $total=$students[$regno]["Other Assessments"]["total"];
            $students[$regno]["GrandTotal"]=(isset($students[$regno]["GrandTotal"]) && !empty($students[$regno]["GrandTotal"]))?$students[$regno]["GrandTotal"]+$total:$total;
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

    public function setallstudents()
    {
      $students_for_assessments=[];

      $coursePrograms=ProgramCourse::find()->where(['course_code'=>yii::$app->session->get('ccode')])->all();
      foreach($coursePrograms as $program)
      {
 
       $programStudents=$program->programCode0->students;
       for($s=0;$s<count($programStudents);$s++){
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
      $carryovers=StudentCourse::find()->where(['course_code'=>yii::$app->session->get('ccode')])->limit(2)->all(); 
      if($carryovers!==null || !empty($carryovers))
      {
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
    }
   
      $this->allstudents=$students_for_assessments;

      
    }

    private function addEncompletes($studentswithscores)
    {
      $studentwithmarks=$studentswithscores;
      
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
            if($assignments[$title]==null || empty($assignments[$title])){$status=true; break;}
            else{$status=false; continue;}

          }
        }
        if($labs!==null)
        {
          foreach($labs as $title=>$score)
          {
            if($status==true){break;}
            if($labs[$title]==null || empty($labs[$title])){$status=true; break;}
            else{$status=false; continue;}

          }
        }

        if($other!==null)
        {
          foreach($other as $title=>$score)
          {
            if($status==true){break;}
            if($other[$title]==null || empty($other[$title])){$status=true; break;}
            else{$status=false; continue;}

          }
        }
          
          if($status===true){
            $studentwithmarks[$reg]['GrandTotal']="Inc";
          }

         
      }
      return $studentwithmarks;
    }
   
  
    
}
?>