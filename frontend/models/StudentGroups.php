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
class StudentGroups extends Model{
    public $generationType;
    public $membersNumber;

    public function rules(){
        return [
           ['membersNumber', 'required'],
           ['generationType', 'string','max'=>100],
           ['membersNumber', 'integer','min'=>2,'message'=>'the minimum members of a group not less than 2']
        ];

    }
    public function generateRandomGroups()
    {
        //getting all student taking this course
        $ccode=Yii::$app->session->get('ccode');
        $students_array=array();
        $status=false;
        
        $students=[];

        $coursePrograms=ProgramCourse::find()->where(['course_code'=>$ccode])->all();
        foreach($coursePrograms as $program)
        {

        $programStudents=$program->programCode0->students;

        for($s=0;$s<count($programStudents);$s++){array_push($students,$programStudents[$s]);}


        }
        $carryovers=StudentCourse::find()->where(['course_code'=>$ccode])->all(); 

        foreach($carryovers as $carry)
        {
        array_push($students,$carry->regNo);
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
        $now=date("m:d:Y h:i:s");
        //$groupmodel->course_code=$ccode;
        //setting up the generation type
        $typesmodel=new GroupGenerationTypes();
        $typesmodel->generation_type=($this->generationType!="" || $this->generationType!=null)?$this->generationType:"Generation type ".$now;
        $typesmodel->course_code=$ccode;
        $typesmodel->creator_type="instructor";
        $typesmodel->instructorID=$instructorID;
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


             $status=true;

        }
        else{

            $status=false;
        }
    

    }

    return $status;

    
}
public function addstudenttype()
{

  $ccode=Yii::$app->session->get('ccode');
  $instructorID = Yii::$app->user->identity->instructor->instructorID;
  $now=date("m:d:Y h:i:s");
  //$groupmodel->course_code=$ccode;
  //setting up the generation type
  $typesmodel=new GroupGenerationTypes();
  $typesmodel->generation_type=($this->generationType!="" || $this->generationType!=null)?$this->generationType:"Student Generation type ".$now;
  $typesmodel->course_code=$ccode;
  $typesmodel->creator_type="instructor-student";
  $typesmodel->instructorID=$instructorID;
  $typesmodel->max_groups_members=$this->membersNumber;
  $typesmodel->save();

  return true;

}


}
?>