<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Student;
use common\models\StudentCourse;
use common\models\ProgramCourse;
use common\models\StudentGroup;
use common\models\GroupGenerationTypes;
use common\models\Groups;
use frontend\models\CourseStudents;
use yii\base\Exception;
/*
A class that creates and manages students groups
written by khalid hassan
thewinner016@gmail.com
0755189736
last modified 28/11/2021
*/

class StudentGroups extends Model{
    public $generationType;
    public $membersNumber;

    public function rules(){
        return [
           ['membersNumber', 'required'],
           ['generationType', 'string','max'=>100],
           ['membersNumber', 'integer','min'=>2,'message'=>'Members number is a number not less than 2']
        ];

    }

    //a function for generating random groups
    //last modified 28/11/2021
    public function generateRandomGroups()
    {
        ini_set('max_execution_time', 200);
        
        try
        {
            //getting all student taking this course
        $ccode=Yii::$app->session->get('ccode');
        $students_array=array();
        $students=CourseStudents::getClassStudents($ccode);

        if($students==null || empty($students))
        {
            throw new Exception("This course still has no any students, Make sure all students are assigned");
        }
        
        for($n=0;$n<count($students);$n++)
        {
            array_push($students_array,$students[$n]->reg_no);

        }

        //we shuffle the array for randomizing

        shuffle($students_array);

        //spliting the array into groups of members
       
        $groups=array_chunk($students_array,$this->membersNumber);
        $instructorID = Yii::$app->user->identity->instructor->instructorID;
        $now=date("Y-m-d H:i:s");

       
        //$groupmodel->course_code=$ccode;
        //setting up the generation type
       
        $typesmodel=new GroupGenerationTypes();
        $typesmodel->generation_type=($this->generationType!="" || $this->generationType!=null)?$this->generationType:"Generation type ".$now;
        $typesmodel->course_code=$ccode;
        $typesmodel->creator_type="instructor";
        $typesmodel->instructorID=$instructorID;
        $typesmodel->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
        $typesmodel->max_groups_members=$this->membersNumber;
        $typesmodel->save();

        //getting all the groups into the database including all the corresponding members
       
        for($g=0;$g<count($groups);$g++)
        {
          
        

            
           //creating the group name

           $groupname="Group ".($g+1);
        

           //setting up the group

           $groupmodel=new Groups();
           $groupmodel->groupName=$groupname;
           $groupmodel->generation_type=$typesmodel->typeID;

          
           if($groupmodel->save()){
           $inserted_id=$groupmodel->groupID;

           //inserting group  members

           for($m=0;$m<count($groups[$g]);$m++)
           {

              $studentgroup=new StudentGroup();
              $studentgroup->reg_no=$groups[$g][$m];
              $studentgroup->groupID=$inserted_id;
              $studentgroup->save();


           }

        }
      

    }
    return true;
}
catch(Exception $e)
{
    throw new Exception($e->getMessage());
}

    
}

// a function to add a student generation type
//for students to add their own groups
//last modified 28/11/2021

public function addstudenttype()
{

  $ccode=Yii::$app->session->get('ccode');
  $instructorID = Yii::$app->user->identity->instructor->instructorID;
  $now=date("Y-m-d H:i:s");
  //$groupmodel->course_code=$ccode;
  //setting up the generation type
  $typesmodel=new GroupGenerationTypes();
  $typesmodel->generation_type=($this->generationType!="" || $this->generationType!=null)?$this->generationType:"Student Generation type ".$now;
  $typesmodel->course_code=$ccode;
  $typesmodel->creator_type="instructor-student";
  $typesmodel->instructorID=$instructorID;
  $typesmodel->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
  $typesmodel->max_groups_members=$this->membersNumber;
  if($typesmodel->save()){return true;}else{return $typesmodel->getErrors();}


}


}
?>