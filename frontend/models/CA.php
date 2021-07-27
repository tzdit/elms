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



  
    public function generateCA()
    {
  
   

       print_r($this->getallstudents());

   
      
    }
  
    private function Asscumul()
    {
      
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

    private function getallstudents()
    {
      $students_for_assessments=[];

      $coursePrograms=ProgramCourse::find()->where(['course_code'=>yii::$app->session->get('ccode')])->all();
      foreach($coursePrograms as $program)
      {
 
       $programStudents=$program->programCode0->students;
 
       for($s=0;$s<count($programStudents);$s++){

        $students_for_assessments[$programStudents[$s]->reg_no]=array();


        }
 
 
      }
      $carryovers=StudentCourse::find()->where(['course_code'=>yii::$app->session->get('ccode')])->all(); 
 
      foreach($carryovers as $carry)
      {
       
        $students_for_assessments[$carry->regNo->reg_no]=array();
      }

      return $students_for_assessments;
    }
   
    
}
?>