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
    public $submitMode;
    public $assType;
    public $startDate;
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
           [['assTitle', 'submitMode', 'assType', 'startDate', 'endDate'], 'required'],
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
        
        $ass = new Assignment();
        $ass->assName = $this->assTitle;
        $ass->assType = $this->assType;
        $ass->submitMode = $this->submitMode;
        $ass->startDate = $this->startDate;
        $ass->yearID=1;
        $ass->finishDate = $this->endDate;
        $ass->fileName = $filefordb;
        $ass->ass_desc = $this->description;
        $ass->assNature = "assignment";
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->total_marks = $this->totalMarks;
        if(Yii::$app->session->get('ccode')===null){return false;}
        $ass->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
        
        if(!$ass->save()){return false;}
      
      
     
        
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
      if(!$this->validate()){
         return false;
     }
        $ass =Assignment::findOne($assid);
        $ass->assName = $this->assTitle;
        $ass->assType = $this->assType;
        $ass->submitMode = $this->submitMode;
        $ass->startDate = $this->startDate;
        $ass->finishDate = $this->endDate;
       // $ass->fileName = $filefordb;
        $ass->ass_desc = $this->description;
        $ass->assNature = "assignment";
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->total_marks = $this->totalMarks;
        $ass->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
        
        if(!$ass->save()){return false;}
      
      
     
        
        //handling group assignments

        if($this->assType=="allgroups")
        {
           $grpass=GroupGenerationAssignment::findOne($ass->assID);
           //the assignment questions and maxima
           $assqs=$ass->assqs;
           for($q=0;$q<count($assqs);$q++)
           {
              $assq=Assq::findOne($assqs[$q]->assq_ID);
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
        
         $assqs=$ass->assqs;
         for($q=0;$q<count($assqs);$q++)
         {
               $assq=Assq::findOne($assqs[$q]->assq_ID);
               $assq->assID=$ass->assID;
               $assq->qno=$q+1;
               $assq->total_marks=$this->questions_maxima[$q];
               if(!$assq->save()){return false;}
               
             // print var_export($assq->getErrors());
            }
        }
        else if($this->assType=="groups")
        {
            
    
            //the assignment questions and maxima
           
            $assqs=$ass->assqs;
            for($q=0;$q<count($assqs);$q++)
            {
        
               $assq=Assq::findOne($assqs[$q]->assq_ID);
               $assq->assID=$ass->assID;
               $assq->qno=$q+1;
               $assq->total_marks=$this->questions_maxima[$q];
               if(!$assq->save()){return false;}
            }
            for($g=0;$g<count($this->groups);$g++)
            {
               $grpass1=GroupAssignment::findOne($ass->assID);
               $grpass1->assID=$ass->assID;
               $grpass1->groupID=intval($this->groups[$g]);
               if(!$grpass1->save()){return false;}
            }
 
         
        }
        else if($this->assType=="students")
        {
             //the assignment questions and maxima
           
             $assqs=$ass->assqs;
             for($q=0;$q<count($assqs);$q++)
             {
         
                $assq=Assq::findOne($assqs[$q]->assq_ID);
                $assq->assID=$ass->assID;
                $assq->qno=$q+1;
                $assq->total_marks=$this->questions_maxima[$q];
                if(!$assq->save()){return false;}
             }
             for($g=0;$g<count($this->students);$g++)
             {
                $stud=StudentAssignment::findOne($ass->assID);
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

        
    }
    
     
    
    
    
}
?>