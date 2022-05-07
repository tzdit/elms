<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
use common\models\GroupGenerationAssignment;
use common\models\Assq;
use common\models\GroupAssignment;
use common\models\StudentAssignment;
class UploadAssignment extends Model{
    public $assTitle;
    public $submitMode="resubmit";
    public $assType;
    public $endTime;
    public $endDate;
    public $assFile;
    public $description;
    public $ccode;
    public $number_of_questions;
    public $questions_maxima=[];
    public $generation_type;
    public $groups=[];
    public $students=[];
    public $the_assignment;
    public $assFormat;

    public $totalMarks;
    public function rules(){
        return [
           [['assTitle', 'submitMode', 'assType', 'endTime', 'endDate'], 'required'],
           ['description','string','max'=>1000],
           [['totalMarks'], 'required'],
           [['number_of_questions'], 'required'],
           [['assFormat'], 'required']

        ];

    }
    public function create_assignment(){
   
      if(!$this->validate()){
         return false;
     }
        try{
         $filefordb="";
         if($this->assFormat=='typed')
         {
            $filefordb=$this->string_to_file($this->the_assignment);
         
         }
         else
         {
            $fileName = uniqid();
            $filefordb=$fileName.'.'.$this->assFile->extension;
            $this->assFile->saveAs('storage/temp/'.$filefordb);
           
         }
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $ass = new Assignment();
        $ass->assName = $this->assTitle;
        $ass->assType = $this->assType;
        $ass->submitMode = $this->submitMode;
        $ass->yearID=(yii::$app->session->get("currentAcademicYear"))->yearID;
        $ass->finishDate = $this->endDate." ".$this->endTime;
        $ass->create_time=date("Y-m-d H:i:s");
        $ass->fileName = $filefordb;
        $ass->ass_desc = $this->description;
        $ass->assNature = "assignment";
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->total_marks = $this->totalMarks;
        $ass->status="notpublished";
        $ass->course_code =Yii::$app->session->get('ccode');
        
        if(!$ass->save()){
           return false;
         }
       
      
      
     
        
        //handling group assignments

        if($this->assType=="allgroups")
        {
           $grpass=new GroupGenerationAssignment();
           //the assignment questions and maxima
           
           for($q=0;$q<$this->number_of_questions;$q++)
           {
              $assq=new Assq();
              $assq->assID=$ass->assID;
              $assq->qno=$q+1;
              $assq->total_marks=$this->questions_maxima[$q];
              if(!$assq->save()){return false;}
            
             // print var_export($assq->getErrors());
           }
           $grpass->gentypeID=$this->generation_type;
           $grpass->assID=$ass->assID;
           if(!$grpass->save()){return false;}

        }
        else if($this->assType=="allstudents")
        {
        
            for($q=0;$q<$this->number_of_questions;$q++)
            {
               $assq=new Assq();
               $assq->assID=$ass->assID;
               $assq->qno=$q+1;
               $assq->total_marks=$this->questions_maxima[$q];
               if(!$assq->save()){return false;}
               
              
            }
        }
        else if($this->assType=="groups")
        {
            
    
            //the assignment questions and maxima
           
            for($q=0;$q<$this->number_of_questions;$q++)
            {
        
               $assq=new Assq();
               $assq->assID=$ass->assID;
               $assq->qno=$q+1;
               $assq->total_marks=$this->questions_maxima[$q];
               if(!$assq->save()){return false;}
            }
            for($g=0;$g<count($this->groups);$g++)
            {
               $grpass1=new GroupAssignment();
               $grpass1->assID=$ass->assID;
               $grpass1->groupID=intval($this->groups[$g]);
               if(!$grpass1->save()){return false;}
            }
 
         
        }
        else if($this->assType=="students")
        {
             //the assignment questions and maxima
           
             for($q=0;$q<$this->number_of_questions;$q++)
              {
         
                $assq=new Assq();
                $assq->assID=$ass->assID;
                $assq->qno=$q+1;
                $assq->total_marks=$this->questions_maxima[$q];
                if(!$assq->save()){return false;}
             }
             for($g=0;$g<count($this->students);$g++)
             {
                $stud=new StudentAssignment();
                $stud->assID=$ass->assID;
                $stud->reg_no=$this->students[$g];
                if(!$stud->save()){return false;}
                //print var_export($stud->getErrors());
                
             }
        }
        else{
            return false;
        }
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }

    private function string_to_file($string)
    {
      $file=uniqid().".txt";
      $storage="storage/temp/";
      $filepath=$storage.$file;
      $myfile = fopen($filepath, "w") or die("Unable to open file!");
      fwrite($myfile,$string);
      fclose($myfile);

      return $file;
    }

    public function update($assid)
    {
        try
        {

        $transaction = Yii::$app->db->beginTransaction();
        $ass =Assignment::findOne($assid);
        $ass->assName = $this->assTitle;
        $ass->submitMode = $this->submitMode;
        $ass->finishDate = $this->endDate." ".$this->endTime;
       // $ass->fileName = $filefordb;
        $ass->ass_desc = $this->description;
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->total_marks = $this->totalMarks;
        $ass->course_code =Yii::$app->session->get('ccode');
        
        if(!$ass->save()){throw new Exception("could not update assignment");}

           
           $assqs=$ass->assqs;
           for($q=0;$q<count($assqs);$q++)
           {
              $assq=Assq::findOne($assqs[$q]->assq_ID);
              if(!$assq->delete()){throw new Exception("could not delete assignment questions");}
           }

           //re-add assignment questions 

           for($q=0;$q<$this->number_of_questions;$q++)
           {
      
             $assq=new Assq();
             $assq->assID=$ass->assID;
             $assq->qno=$q+1;
             $assq->total_marks=$this->questions_maxima[$q];
             if(!$assq->save()){throw new Exception("could not readd assignment questions");}
          }
         $transaction->commit();
         return true;
         }
         catch(Exception $d)
         {
            $transaction->rollBack();
            throw new Exception($d);
         }
        
    }
    
     
    
    
    
}
?>