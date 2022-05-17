<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Academicyear;
use yii\base\Exception;
use yii\helpers\FileHelper;
use common\models\Quiz;
use Mpdf\Mpdf;
use common\models\Course;

/*
A model class for managing academicyear, switching to and from a specific 
academic year, and migrating the whole system to a new academic year
*/

class QuizManager extends Model
{
   
    public $question;
    public $questionImage;
    public $questiontype;
    public $questionAnswerOptions;
    public $ImageAnswerOptions;
    public $trueAnswers;
    public $multipleAnswers;

    //constants

    public $quizzesHome='storage/quizes/';
    public $q_bank;
   
    

    public function __construct($question=null,$config=[])
    {
     
     $this->question=isset($question['question'])?$question['question']:null;
     $this->questiontype=isset($question['questiontype'])?$question['questiontype']:[];
     $this->questionAnswerOptions=isset($question['options'])?$question['options']:[];
     $this->ImageAnswerOptions=$question!=null?$question['optionImage']:[];
     $this->questionImage=$question!=null?$question['questionImage']:[];
     $this->quizzesHome.=str_replace(" ","",yii::$app->session->get('ccode'))."/";
     $this->q_bank=str_replace(" ","",yii::$app->session->get('ccode'))."_questionsBank.qb";
     FileHelper::createDirectory($this->quizzesHome);
     FileHelper::createDirectory($this->quizzesHome.'images/');
     
     if($question!=null)
     {
     if(isset($this->questionAnswerOptions) && !empty($this->questionAnswerOptions))
     {
     foreach($question as $index=>$questionx)
     {
       if(isset($this->questionAnswerOptions[$index]))
       {
           $this->trueAnswers[$index]=$question[$index];
       }
       else
       {
           continue;
       }
    }
   }
   else
   {
       
    foreach($question as $index=>$questionx)
    {
      if(isset($this->ImageAnswerOptions[$index]))
      {
          $this->trueAnswers[$index]=$question[$index];
      }
      else
      {
          continue;
      }
    }
   }  
   }

     $this->multipleAnswers=isset($question['answerdecision'])?$question['answerdecision']:null;
     

     parent::init($config);
    }

    public function questionRestructure()
    {
        //print_r($this->ImageAnswerOptions); return false;
        $questionbuffer=[];
        $questionbuffer['type']=$this->questiontype;
        $questionbuffer['multiple']=$this->multipleAnswers;
        $questionbuffer['question']= $this->question;
        $questionbuffer['questionImage']=$this->questionImageResolver($this->questionImage);
        if($questionbuffer['type']=="true-false" && count($this->trueAnswers)>1)
        {
            throw new Exception("Fatal Error, Too many True answers supplied for true/false type questions! Only One is Allowed.");  
        }
        if(empty($this->trueAnswers))
        {
           throw new Exception("Fatal Error, please specify at least one true choice");
        }
        else if(count($this->trueAnswers)>1)
        {
            if($this->multipleAnswers==null)
            {
                throw new Exception("Fatal Error, Too many true answers ! please review your question and make the right decision on how many possible true options are allowed !");
            }
        }

        if(empty($this->questionAnswerOptions) && empty($this->ImageAnswerOptions))
        {
            throw new Exception('No options found, please specify at least 2 answer options');
        }

        else if(!empty($this->questionAnswerOptions) && !empty($this->ImageAnswerOptions))
        {
            throw new Exception('Fatal Error, Mixed textual and image answer options');
        }
        else
        {
            $this->ImageAnswerOptions=($this->ImageAnswerOptions!=null)?$this->imageOptionsResolver($this->ImageAnswerOptions):null;
            $options=[];
            $options['type']=!empty($this->questionAnswerOptions)?"textual":"images";
            $options['choices']=$options['type']=="textual"?$this->questionAnswerOptions:$this->ImageAnswerOptions;
            $options['true-choices']=$this->trueAnswers;
            $questionbuffer['options']=$options;
        }

    return $questionbuffer;
    }

    public function imageOptionsResolver($imagesbuffer)
    {
     $imageOptions=[];
     if(empty($imagesbuffer) || $imagesbuffer==null)
     {
         throw new Exception("Image options not found");
     }
     foreach($imagesbuffer as $index=>$buffer)
     {
      $id=uniqid();
      $path=$this->quizzesHome."images/".$id.".".$buffer->extension;
      if($buffer->saveAs($path))
      {
        array_push($imageOptions,$path);
      }
      
      
     }
     return $imageOptions;

    }
    public function questionImageResolver($imagesbuffer)
    {
     $imageOptions=[];
     if(empty($imagesbuffer) || $imagesbuffer==null)
     {
         return null;
     }
     foreach($imagesbuffer as $index=>$buffer)
     {
      $id=uniqid();
      $path=$this->quizzesHome."images/".$id.".".$buffer->extension;
      if($buffer->saveAs($path))
      {
        array_push($imageOptions,$path);
      }
      
      
     }
     return $imageOptions[0];

    }

  public function questionSave()
  {
      $index=rand();
      $question=$this->questionRestructure();
    
      $qbank=$this->q_bank;
      $path=$this->quizzesHome.$qbank;
      $bankdata="";
      $questiondata=[];
      if(file_exists($path))
      {
          $bankdata=file_get_contents($path);

          if($bankdata!="")
          {
            $bankdata=$this->RevealBankData($bankdata); 
            $bankdata=json_decode($bankdata,true);
          }
         
           $bankdata[$index]=$question;
          $bankdata=json_encode($bankdata);
          $bankdata=$this->hideBankData($bankdata);

          file_put_contents($path,$bankdata,LOCK_EX);
          return true;
          
      }
      else
      {
        $questiondata[$index]=$question;
        $questiondata=json_encode($bankdata);
        $questiondata=$this->hideBankData($bankdata);
           file_put_contents($path,$questiondata,LOCK_EX);
           return true;
      }

   


  }
  private function hideBankData($data)
  {
      return ClassRoomSecurity::encrypt($data);
  }
  private function RevealBankData($data)
  {
      return ClassRoomSecurity::decrypt($data);
  }

  public function questionsBankReader()
  {
    $qbank=$this->q_bank;
    $path=$this->quizzesHome.$qbank;
    $bankdata=file_get_contents($path);

    $bankdata=$this->RevealBankData($bankdata);

    return json_decode($bankdata,true);
    
  }
  public function deleteQuestion($question)
  {
      $bank=$this->questionsBankReader();

      if(isset($bank[$question]))
      {
          unset($bank[$question]);

          if($this->updateQuestionsBank($bank))
          {
            return true;
          }
          return false;
      }
   
          return false;
      
  }

  private function updateQuestionsBank($content)
  {
    $qbank=$this->q_bank;
    $path=$this->quizzesHome.$qbank;
    $content=$this->hideBankData(json_encode($content));
    file_put_contents($path,$content,LOCK_EX);

    return true;

  }

  private function questionFind($findindex)
  {
    $qbank=$this->q_bank;
    $path=$this->quizzesHome.$qbank;
    $bankdata=file_get_contents($path);

    $bankdata=$this->RevealBankData($bankdata);

    $bankdata=json_decode($bankdata,true);
    
    foreach($bankdata as $index=>$question)
    {
        if($index==$findindex)
        {
            return $question;
        }

        continue;
    }

    return null;
  }

  public function saveQuiz($quizdata)
  {
    $course=yii::$app->session->get('ccode');
    $quizName=$quizdata['quizName'];
    $attemptmode=$quizdata['attemptMode'];
    $start=(isset($quizdata['StartingDate']) && isset($quizdata['StartingTime']))?$quizdata['StartingDate']." ".$quizdata['StartingTime']:null;
    $end=(isset($quizdata['DeadlineDate']) && isset($quizdata['DeadlineTime']))?$quizdata['DeadlineDate']." ".$quizdata['DeadlineTime']:null;
    $duration=intval($quizdata['duration']);
    $viewAnswers=isset($quizdata['viewAnswers'])?$quizdata['viewAnswers']:"off";
    $questions=isset($quizdata['quizQuestions'])?$quizdata['quizQuestions']:null;
    $numquestions=isset($quizdata['numquestions'])?$quizdata['numquestions']:null;
    $numquestions=($numquestions!=null)?intval($numquestions):null;
    $quizQuestions=[];
    $total_marks=0;

    if(strlen($quizName)>30){throw new Exception("Quiz Title Should Not Exceed 30 Characters Long !");}
    if($duration==0 || $duration==null){throw new Exception("Duration must be a number greater than 0 !");}
    if($start==null){throw new Exception("Staring Date And Time Must Be Specified !");}
  

    if($attemptmode=="massive")
    {
    
     if(empty($questions) || $questions==null){throw new Exception("Quiz Questions Must Be Set For This Type Of Quiz !");}
     
     $total_marks=count($questions);
     foreach($questions as $index=>$question)
     {
        $quizQuestions[$question]=$this->questionFind($question); 
     }
      
     try
     {
         $transaction = Yii::$app->db->beginTransaction();
         $quizdb=new Quiz;
         $quizdb->course_code=$course;
         $quizdb->quiz_title=$quizName;
         $quizdb->total_marks=$total_marks;
         $quizdb->attempt_mode=$attemptmode;
         $quizdb->duration=$duration;
         $quizdb->viewAnswers=$viewAnswers;
         $quizdb->quiz_file=$this->quizFileSaver($quizQuestions);
         date_default_timezone_set('Africa/Dar_es_Salaam');
         $quizdb-> date_created=date("Y-m-d H:i:s");
         $quizdb->start_time=$start;
         $quizdb->status="new";
         $quizdb->yearID=yii::$app->session->get('currentAcademicYear')->yearID;
         $quizdb->instructorID=yii::$app->user->identity->instructor->instructorID;
         $quizdb->save();

         
         $transaction->commit();
         return true;

     }
     catch(Exception $f)
     {
        $transaction->rollBack();
         return false;
     }

    }
    else
    {
      if($numquestions==0 || $numquestions==null)
      {
        throw new Exception("Number of questions must be a number greater than 0 !");
      }
      if($end==null){throw new Exception("Deadline Date And Time Must Be Specified For This Type Of Quiz !");}
         $transaction = Yii::$app->db->beginTransaction();
         $quizdb=new Quiz;
         $quizdb->course_code=$course;
         $quizdb->total_marks=$numquestions;
         $quizdb->attempt_mode=$attemptmode;
         $quizdb->duration=$duration;
         $quizdb->quiz_title=$quizName;
         $quizdb->viewAnswers=$viewAnswers;
         date_default_timezone_set('Africa/Dar_es_Salaam');
         $quizdb-> date_created=date("Y-m-d H:i:s");
         $quizdb->start_time=$start;
         $quizdb->end_time=$end;
         $quizdb->instructorID=yii::$app->user->identity->instructor->instructorID;
         $quizdb->status="new";
         $quizdb->yearID=yii::$app->session->get('currentAcademicYear')->yearID;
         $quizdb->num_questions=$numquestions;
         $quizdb->save();

         $transaction->commit();
         return true;
    }

    


  }

  private function quizFileSaver($quizdata)
  {
    $uniq=uniqid();
    $file='quiz_'.$uniq.'.qz';
    $path=$this->quizzesHome.$file;

    try
    {
      $quizdata=json_encode($quizdata);
      $quizdata=$this->hideBankData($quizdata);
      file_put_contents($path,$quizdata);
      
       return $file;
      
    
    }
    catch(Exception $q)
    {
        throw $q;
    }

  }

  public function deleteQuiz($quiz)
  {
    $quiz=Quiz::findOne($quiz);
    if($quiz==null){throw new Exception("Quiz not found");}
    if($quiz->quiz_file!=null)
    {
      $quizhome=$this->quizzesHome.$quiz->quiz_file;

      if(file_exists($quizhome))
      {
        unlink($quizhome);
        $quiz->delete();
        return true;
      }
    }
    else
    {
      $quiz->delete();
      return true;
    }

    return false;
  }

  public function quizReader($quiz)
  {
    $quiz=Quiz::findOne($quiz);
    $quizfile=($quiz!=null)?$quiz->quiz_file:null;

    if($quizfile==null){throw new Exception("Quiz not found !");}
    $path=$this->quizzesHome.$quizfile;
    $quizdata=file_get_contents($path);

    $quizdata=$this->RevealBankData($quizdata);

    return json_decode($quizdata,true);
    
  }
  public function getBankHome()
  {
    return $this->quizzesHome.$this->q_bank;
  }
  public function downloadPDFbank($content)
  {
   
    if($content!=null)
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
    $mpdf->WriteHTML('<div align="center"><img src="img/logo.png" width="125px" height="125px"/></div>',2);
    $mpdf->WriteHTML('<p align="center"><font size=7>The University of Dodoma</font></p>',3);
    $mpdf->WriteHTML('<p align="center"><font size=5>'.$college.'</font></p>',3);
    $mpdf->WriteHTML('<p align="center"><font size=5>'.$course.' '.$courseTitle.'</font></p>',3);
    $mpdf->WriteHTML('<p align="center"><font size=5>Questions Bank ('.$year.')</font></p>',3);
    $mpdf->WriteHTML('<p align="center"><font size=3>By '.$name.'</font></p>',3);
    $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
    $mpdf->WriteHTML($content,3);
      
    $filename=yii::$app->session->get('ccode')."_Questions_Bank.pdf";
    $filename = str_replace(' ', '', $filename);
    $mpdf->Output($filename,"D");

    return null;
}
else
{
  return 'no content';
}
  }
   
}
