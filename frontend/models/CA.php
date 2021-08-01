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

class CA extends Model{
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


  
    public function generateCA()
    {
     
      $this->setallstudents();
      $student_with_marks=null;
      if(!empty($this->Assignments)){$student_with_marks=$this->asscumul($this->Assignments);}else{$student_with_marks=$this->allstudents;}
      if(!empty($this->LabAssignments)){$student_with_marks=$this->labcumul($this->LabAssignments,$student_with_marks);}
      if(!empty($this->otherAssessments)){$student_with_marks=$this->otherAssessCumul($this->otherAssessments,$student_with_marks);}
      
      //adding the GrandMaxs
      if(!empty($this->Assignments)){$student_with_marks["assGrandMax"]=$this->assGrandMax;}
      if(!empty($this->LabAssignments)){$student_with_marks["labGrandMax"]=$this->labGrandMax;}
      if(!empty($this->otherAssessments)){$student_with_marks["otherGrandMax"]=$this->otherGrandMax;}
     

      return $student_with_marks;



   
      
    }

    private function asscumul($assign)
    {
       //getting all assignments

       $assignments=$assign;
       $students=$this->allstudents;
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
      
         }
         //getting each student score
        
         foreach($assignment_scores as $reg=>$sc)
         {
           
           $students[$reg]["Assignments"][$assheader]=$sc;
           $students[$reg]["Assignments"]["total"]+=$sc;
           $students[$reg]["Assignments"]["max"]=$maxheader;
         }

        

       }
        //reducing if there is one

        foreach($students as $reg=>$sc)
        {
         
           $students[$reg]["Assignments"]["total"]=($students[$reg]["Assignments"]["total"]*$reducefactor)/$max;
         
         }

         //adding the grand total

         foreach($assignment_scores as $reg=>$sc)
         {
           
           $students[$reg]["GrandTotal"]=$students[$reg]["Assignments"]["total"];
        
          
         }
         $this->assGrandMax=$maxheader;

       return $students;
    }
    private function labcumul($assign,$stud)
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
            $students[$reg]["Lab Assignments"][$assheader]=null;
          
           }
           //getting each student score
          
           foreach($assignment_scores as $reg=>$sc)
           {
             
             $students[$reg]["Lab Assignments"][$assheader]=$sc;
             $students[$reg]["Lab Assignments"]["total"]+=$sc;
             $students[$reg]["Lab Assignments"]["max"]=$maxheader;
           }
  
          
  
          
  
         }
          //reducing if there is one
  
          foreach($students as $reg=>$sc)
          {
           
             $students[$reg]["Lab Assignments"]["total"]=($students[$reg]["Lab Assignments"]["total"]*$reducefactor)/$max;
           
           }

          //adding the grand total
          foreach($assignment_scores as $regno=>$cont)
          {
            //print($cont['GrandTotal']);
            $total=$students[$regno]["Lab Assignments"]["total"];
            $students[$regno]["GrandTotal"]=isset($students[$regno]["GrandTotal"])?$students[$regno]["GrandTotal"]+$total:$total;
          }
          //adding the assignments grandmax
          $this->labGrandMax=$maxheader;

         
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
          
           }
           //getting each student score
          
           foreach($assessment_scores as $reg=>$sc)
           {
             
             $students[$reg]["Other Assessments"][$assheader]=$sc;
             $students[$reg]["Other Assessments"]["total"]+=$sc;
             $students[$reg]["Other Assessments"]["max"]=$maxheader;
           }
  
        
         }
          //reducing if there is one
  
          foreach($students as $reg=>$sc)
          {
           
             $students[$reg]["Other Assessments"]["total"]=($students[$reg]["Other Assessments"]["total"]*$reducefactor)/$max;
           
           }

          //adding the grand total
          foreach($assessment_scores as $regno=>$cont)
          {
            //print($cont['GrandTotal']);
            $total=$students[$regno]["Other Assessments"]["total"];
            $students[$regno]["GrandTotal"]=isset($students[$regno]["GrandTotal"])?$students[$regno]["GrandTotal"]+$total:$total;
          }
          //adding the assignments grandmax
          $this->otherGrandMax=$maxheader;

         
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
   
    
}
?>