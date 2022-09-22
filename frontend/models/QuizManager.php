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
use common\models\StudentQuiz;


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
     if(!file_exists($this->quizzesHome.$this->q_bank))
     {
      $bankfile=fopen($this->quizzesHome.$this->q_bank, "w");
      fclose($bankfile);
     }
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
      $course=str_replace(" ","",yii::$app->session->get('ccode'));
      $index=$course.rand();
      $question=$this->questionRestructure();
    
      $qbank=$this->q_bank;
      $path=$this->quizzesHome.$qbank;
      $bankdata="";
      $questiondata=[];
      if(file_exists($path))
      {
          $bankdata=file_get_contents($path);

          if($bankdata!="" || $bankdata!=null)
          {
            $bankdata=$this->RevealBankData($bankdata); 
            $bankdata=json_decode($bankdata,true);
          }
          else
          {
            $bankdata=[];
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
    if($start==null){throw new Exception("Starting Date And Time Must Be Specified !");}
  

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

         if($quizdb->save())
         {
          $transaction->commit();
          return true;
         }
         else
         {
           return false;
         }

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
      if($numquestions>count($this->questionsBankReader())){throw new Exception("You Do Not Have Enough Questions In The Bank !");}
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
    $mpdf = new Mpdf(['orientation' => 'P']);
    $mpdf->setFooter('{PAGENO}');
    $course=yii::$app->session->get('ccode');
    $courseTitle=Course::findOne($course)->course_name;
    $stylesheet = file_get_contents('css/capdf.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->SetWatermarkText('elms.ditnet.ac.tz',0.09);
    $mpdf->showWatermarkText = true;
    $mpdf->WriteHTML('<div align="center"><img src="img/logo.png" width="125px" height="125px"/></div>',2);
    $mpdf->WriteHTML('<p align="center"><font size=7>Dar es salaam Institute of Technology</font></p>',3);
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

  public function questionsUploader($bankfile)
  {
   
   $name=$bankfile->name;
   $ext=pathinfo($name, PATHINFO_EXTENSION);
   $size=$bankfile->size;

   

   if($ext!="qb"){throw new Exception("Please Upload a Questions Bank File (.qb)");}
   if($size==0 && $bankfile->error==0){throw new Exception("Uploaded File Is Empty!");}
   $content=file_get_contents($bankfile->tempName);
   $content=$this->RevealBankData($content);
   if(!$this->isJson($content)){throw new Exception("Invalid File! File Content Corrupt or Not Supported !");}
   
   $content_to_array=json_decode($content,true);
   $questionsBank=($this->questionsBankReader()!=null)?$this->questionsBankReader():[];
   $added=0;
   foreach($content_to_array as $index=>$question)
   {
     if(array_key_exists($index,$questionsBank)){continue;}
     $questionsBank[$index]=$question;
     $added++;
   }

   if($this->updateQuestionsBank($questionsBank))
   {
    return $added;
   }

 

  }

  public function isJson($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
 }
 public function getQuizData($quiz)
 {
   $quiz=Quiz::findOne($quiz);
   $quizdata=[];
   $sessionid=yii::$app->session->get("ccode").$quiz->quizID;
   $quizsession=yii::$app->session->get($sessionid);
   $student=yii::$app->user->identity->student->reg_no;
   
   if(!$quiz->isReadyTaking()){throw new Exception("You are not allowed to take this quiz before the due time ! This quiz starts on ".$quiz->start_time);}
   if($quizsession==null && (new StudentQuiz)->isRegistered($student,$quiz->quizID))
   {
    throw new Exception("You are not allowed to do this quiz more than one time !");
   }
   if($quiz->isExpired()){throw new Exception("Cannot Take Expired Quiz");}
   
   if($quiz->attempt_mode=="massive")
   {
     if($quiz->quiz_file==null){throw new Exception("Quiz File Not Found");}
     $quizdata=($quizsession!=null)?$quizsession:$this->randomizeMassiveQuizType($this->quizReader($quiz->quizID));
     yii::$app->session->set($sessionid,$quizdata);

   }
   else
   {
    $quizdata=$this->generateRandomQuiz($quiz->quizID);
   
   }
   return $this->cleanQuizData($quizdata);
 }

 private function cleanQuizData($quizData)
 {
   foreach($quizData as $index=>$question)
   {
     unset($question['options']['true-choices']);
     $quizData[$index]=$question;
   }

   return $quizData;
 }

 private function generateRandomQuiz($quiz)
 {
    $quiz=Quiz::findOne($quiz);
    $sessionid=yii::$app->session->get("ccode").$quiz->quizID;
    $quizsession=yii::$app->session->get($sessionid);
    if($quizsession!=null){return $quizsession;}
    $randomQuiz=[];
    $num_questions=$quiz->num_questions;

    $questionsBank=$this->questionsBankReader();
    $questionsindex=array_rand($questionsBank,$num_questions);
    if(is_array($questionsindex))
    {
    foreach($questionsindex as $index=>$value)
    {
      $randomQuiz[$value]=$questionsBank[$value];
    }
    }
    else
    {
      $randomQuiz[$questionsindex]=$questionsBank[$questionsindex];
    }
    yii::$app->session->set($sessionid,$randomQuiz);
     return $randomQuiz;
 }
 private function randomizeMassiveQuizType($array) {
  $newarray=$array;
  $keys = array_keys($newarray);

  shuffle($keys);
  $new=[];
  foreach($keys as $key) {
      $new[$key] = $newarray[$key];
  }

  return $new;


}

 public function registerStudent($quizID)
 {
   $student=yii::$app->user->identity->student->reg_no;
   $studentquiz=new StudentQuiz();
   $quiz=(new Quiz)->findOne($quizID);
   if($studentquiz->isRegistered($student,$quizID)){ return true;}

   if($quiz->attempt_mode=="massive" && $quiz->isAttemptingTimeOver())
   {
     throw new Exception("Attempting Time Is Over, Online Massive-Type Quizzes/Tests should be attempted lately 20 minutes after their starting time!");
   }
   $studentquiz->reg_no=$student;
   $studentquiz->quizID=$quizID;
   date_default_timezone_set('Africa/Dar_es_Salaam');
   $studentquiz->attempt_time=date("Y-m-d H:i:s");
   $studentquiz->status="attempted";
   $studentquiz->score=0;
   
   if($studentquiz->save())
   {
     return true;
   }
   else
   {
     return false;
   }
 }

 public function markQuiz($responsesBuffer)
 {
   $quiz=$responsesBuffer['quiz'];
   if((new StudentQuiz)->isSubmitted($quiz))
   {
     throw new Exception("You are not allowed to submit twice !");
   }
   $scorecount=0;
   foreach($responsesBuffer as $index=>$responses)
   {
     if($index=='quiz' || $index=='_csrf-frontend'){continue;}
     $trueanswers=$this->loadQuestionsTrueAnswers($index);
     if($this->isTrueResponse($trueanswers,$responses))
     {
      $scorecount++;
     }

   }

   $this->updateStudentQuizScore($quiz,$scorecount);
   $totalmarks=Quiz::findOne($quiz)->total_marks;
   return ['score'=>$scorecount,'totalmarks'=>$totalmarks];

 }

 private function updateStudentQuizScore($quiz,$score)
 {
   date_default_timezone_set('Africa/Dar_es_Salaam');
   $student=yii::$app->user->identity->student->reg_no;
   $studentquiz=new StudentQuiz();
   $submit_time=date("Y-m-d H:i:s");
   if(!$studentquiz->isRegistered($student,$quiz))
   {
     $this->registerStudent($quiz);
   }
     if($studentquiz->isSubmitTimeOver($quiz,$submit_time))
     {
       throw new Exception("submitting time is over");
     }
     $studentQuizUpdate=$studentquiz->find()->where(["reg_no"=>$student,"quizID"=>$quiz])->one();
     $studentQuizUpdate->score=$score;
     
     $studentQuizUpdate->submit_time=$submit_time;
     $studentQuizUpdate->status="submitted";
     $studentQuizUpdate->save();
   
 }

 private function loadQuestionsTrueAnswers($questionindex)
 {
   $bank=$this->questionsBankReader();

   foreach($bank as $index=>$question)
   {
     if($index!=$questionindex)
     {
       continue;
     }
       return $question['options']['true-choices'];
     
   }
 
 }
 private function isTrueResponse($trueresponses,$studentresponses)
 {
   $studentresponses=array_flip($studentresponses);
   if(count($trueresponses)!=count($studentresponses)){return false;}
   $matches=array_intersect_key($trueresponses,$studentresponses);
   if($matches==null){return false;}
   if(count($matches)!=count($trueresponses)){return false;}
   

   return true;

 }

 public function timer($quiz)
 {
     date_default_timezone_set('Africa/Dar_es_Salaam');
     $quiz=Quiz::findOne($quiz);
     $start=null;
     $savedstart=yii::$app->session->get("starttime".$quiz->quizID);
     if($quiz->attempt_mode=="individual")
     {
      
      $start=($savedstart!=null)?$savedstart:date("Y-m-d H:i:s");
     }
     else
     {
      $start=($savedstart!=null)?$savedstart:$quiz->start_time;
     }
     
     if($start!=null){yii::$app->session->set("starttime".$quiz->quizID,$start);}

        

         $starttodate=new \DateTime($start);
         $starttodate->modify ("+{$quiz->duration} minutes");
         $end=strtotime($starttodate->format('Y-m-d H:i:s'));

         $starttotime=strtotime($start);
         
         $nowtime=strtotime(date("Y-m-d H:i:s"));

         $remain=null;

         if($nowtime<$end)
         {
          $remain=$end-$nowtime;
          $remain=date("Y-m-d H:i:s",$remain);
          return (new \DateTime($remain))->format('i:s'); 
         }
         else
         {
          return null;
         }
         
         
     

    
 }
 public function downloadPDFQuiz($content)
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
   $mpdf->WriteHTML('<p align="center"><font size=5>Quiz ('.$year.')</font></p>',3);
   $mpdf->WriteHTML('<p align="center"><font size=3>By '.$name.'</font></p>',3);
   $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
   $mpdf->WriteHTML($content,3);
     
   $filename=yii::$app->session->get('ccode')."_Quiz.pdf";
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
