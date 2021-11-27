<?php

/*
  A class for managing course students list
  written by khalid hassan
  thewinner016@gmail.com
  0755189736
  last modified 27/11/2021

*/

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\StudentCourse;
use common\models\ProgramCourse;




class CourseStudents extends Model
{

 // selects all students assigned to a particular course and returned an array containing all students
 //with their particular inforamtion
 //last modified 27/11/2021

 public static function getClassStudents($course)
 {
    $students=[];
    $levels=[1,2,3,4,5];
    for($l=0;$l<count($levels);$l++)
    {
    $level=$levels[$l];
    $coursePrograms=ProgramCourse::find()->where(['course_code'=>$course,'level'=>$level])->all();
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
    $carryovers=StudentCourse::find()->where(['course_code'=>$course])->all(); 

    foreach($carryovers as $carry)
    {
     array_push($students,$carry->regNo);
    }


     return $students;

 }


}

?>