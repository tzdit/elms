<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Student;
use common\models\StudentCourse;
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
        $students=StudentCourse::find()->where(['course_code'=>$ccode])->all(); 
        $students_array=array();
        $status=false;
        foreach($students as $student)
        {
            array_push($students_array,$student->reg_no);

        }

        //we shuffle the array for randomizing

        shuffle($students_array);

        //spliting the array into groups of members

        $groups=array_chunk($students_array,$this->membersNumber);
   //print_r($groups);

        //getting all the groups into the database including all the corresponding members
        $now=date("m:d:Y h:i:s");
        for($g=0;$g<count($groups);$g++)
        {
          
        

            
           //creating the group name

           $groupname="Group ".($g+1);
           $instructorID = Yii::$app->user->identity->instructor->instructorID;
           $groupmodel=new Groups();
           $groupmodel->groupName=$groupname;
           $groupmodel->course_code=$ccode;
           $typesmodel=new GroupGenerationTypes();
           $typesmodel->generation_type=($this->generationType!="" || $this->generationType!=null)?$this->generationType:"Generation type ".$now;
           $typesmodel->save();
           $groupmodel->generation_type=$typesmodel->typeID;
           $groupmodel->instructorID=$instructorID;
           $groupmodel->creator_type="instructor";
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
}
?>