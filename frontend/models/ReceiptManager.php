<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Receipts;
use common\models\Submit;
use yii\base\Exception;
use common\models\User;
use common\models\GroupAssignmentSubmit;
use common\models\StudentGroup;
use Mpdf\Mpdf;
/*
A model class for managing academicyear, switching to and from a specific 
academic year, and migrating the whole system to a new academic year
*/

class ReceiptManager extends Model
{
    public $number;
    public $ownerid;
    public $ownerfullname;
    public $ownerprogram;
    public $owneryos;
    public $ownercollege;
    public $issuedforID;
    public $coursecode;
    public $submissiondate;
    public $issuer;
    public $witness="cive classroom";
    public $type;
    public $issuedatetime;

    
    public function setType($type)
    {
        $this->type=$type;
    }

    public function generateAssignmentReceipt($for)
    {
      $this->number=rand();
      $this->ownerid=yii::$app->user->identity->student->userID;
      $this->issuedforID=$for;
    
      $this->issuer=(Submit::findOne($for))->ass->instructor->userID;
      $receiptsdb=new Receipts;

      $receiptsdb->receiptnumber=$this->number;
      $receiptsdb->issuedto=$this->ownerid;
      $receiptsdb->issuedfor=$this->issuedforID;
      $receiptsdb->issuer=$this->issuer;
      $receiptsdb->type=$this->type;
      date_default_timezone_set('Africa/Dar_es_Salaam');
      $receiptsdb->issuedon=date('Y-m-d H:i:s');
      $receiptsdb->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
      $saved=$receiptsdb->save();
      if($saved)
      {
        return ClassRoomSecurity::encrypt($receiptsdb->receiptnumber);
      }
      else
      {
          return null;
      } 
      
    }
    public function generateGroupAssignmentReceipt($for)
    {
      $this->number=rand();
      $this->ownerid=yii::$app->user->identity->student->userID;
      $this->issuedforID=$for;
    
      $this->issuer=(GroupAssignmentSubmit::findOne($for))->ass->instructor->userID;
      $receiptsdb=new Receipts;

      $receiptsdb->receiptnumber=$this->number;
      $receiptsdb->issuedto=$this->ownerid;
      $receiptsdb->issuedfor=$this->issuedforID;
      $receiptsdb->issuer=$this->issuer;
      $receiptsdb->type=$this->type;
      date_default_timezone_set('Africa/Dar_es_Salaam');
      $receiptsdb->issuedon=date('Y-m-d H:i:s');
      $receiptsdb->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
      $saved=$receiptsdb->save();
      if($saved)
      {
        return ClassRoomSecurity::encrypt($receiptsdb->receiptnumber);
      }
      else
      {
          return null;
      } 
      
    }

    public function downloadReceipt($receiptid)
    {
        $receipt=Receipts::findOne($receiptid);
        $number=$receipt->receiptnumber;
        $receipttype=$receipt->type;
        $receiptdate=$receipt->issuedon;
        $receiptowner=User::findIdentity($receipt->issuedto)->student;
        $submitted=null;
        if($receipttype=="Assignment Submission")
        {
            $submitted=Submit::findOne($receipt->issuedfor);
        }
        else if($receipttype=="Group Assignment Submission")
        {
            $submitted=GroupAssignmentSubmit::findOne($receipt->issuedfor); 
        }
        else
        {
            
        }
        $ownerfullname=($receiptowner!=null)?$receiptowner->fname." ".$receiptowner->mname." ".$receiptowner->lname:"not found";
        $ownerreg=($receiptowner!=null)?$receiptowner->reg_no:"not found";
        $ownerprog=($receiptowner!=null)?$receiptowner->program->prog_name." (".$receiptowner->programCode.")":"not found";
        $owneryos=($receiptowner!=null)?$receiptowner->YOS:"not found";
        $ownercollege=($receiptowner!=null)?$receiptowner->program->department->college->college_name." (".$receiptowner->program->department->college->college_abbrev.")":"not found";

        $submitdate=($submitted!=null)?$submitted->submit_date." ".$submitted->submit_time:"not found";
        $assignment=($submitted!=null)?$submitted->ass->assName:"not found";
        $course=($submitted!=null)?$submitted->ass->course_code." ".$submitted->ass->courseCode->course_name:"not found";

        $signature1="cive classroom ".yii::$app->session->get('currentAcademicYear')->title;
        $signature2=User::findIdentity($receipt->issuer)->instructor->full_name;
        $mpdf = new Mpdf(['orientation' => 'P']);
        $mpdf->setFooter('{PAGENO}');
        $stylesheet = file_get_contents('css/capdf.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->SetWatermarkText('civeclassroom.udom.ac.tz',0.09);
        $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML('<div align="center"><img src="img/logo.png" width="60px" height="60px"/></div>',2);
        $mpdf->WriteHTML('<p align="center"><font size=6>'.$receipttype.' Receipt</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=5> No '.$number.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=5>Issued on: '.$receiptdate.'</font></p>',3);
        
        $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
        $mpdf->WriteHTML('<p align="center"><font size=3>Issued to: '.$ownerfullname.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>Reg no: '.$ownerreg.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>Program: '.$ownerprog.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>YOS: '.$owneryos.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>College: '.$ownercollege.'</font></p>',3);

        $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
        $mpdf->WriteHTML('<p align="center"><font size=3>Assignment: '.$assignment.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>Submit Date: '.$submitdate.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>Course: '.$course.'</font></p>',3);
        $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
        $mpdf->WriteHTML('<p align="center"><font size=3>signed by:</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>'.$signature1.'</font></p>',3);
        $mpdf->WriteHTML('<p align="center"><font size=3>'.$signature2.'</font></p>',3);

        $filename="receipt.pdf";
        $mpdf->Output($filename,"D");

        return null;
    
    }
    public function getEncryptedReceipt($for)
    {
        
        $receipt=$this->buildReceiptFor($for); 
        $mpdf = new Mpdf(['orientation' => 'P']);
       
        $mpdf->setFooter('{PAGENO}');
        $stylesheet = file_get_contents('css/capdf.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->SetWatermarkText('civeclassroom.udom.ac.tz',0.09);
        $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML('<div align="center"><img src="img/logo.png" width="60px" height="60px"/></div>',2);
        $mpdf->WriteHTML('<p align="center"><font size=6>Encrypted Receipt</font></p>',3);
        $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
        $mpdf->WriteHTML('<p align="center"><font size=4>'.$receipt.'</font></p>',3);
        $filename="receipt.pdf";
        $mpdf->Output($filename,"D");
        return null;
    }

   public function buildReceiptFor($receiptid)
   {
    $receipt=Receipts::findOne($receiptid);
    if($receipt==null){throw new Exception("Receipt not found !");}
    $number=$receipt->receiptnumber;
    $receipttype=$receipt->type;
    $receiptdate=$receipt->issuedon;
    $receiptowner=User::findIdentity($receipt->issuedto)->student;
    $submitted=null;
    if($receipttype=="Assignment Submission")
    {
       
        $submitted=Submit::findOne($receipt->issuedfor);
       
    }
    else if($receipttype=="Group Assignment Submission")
    {
        $submitted=GroupAssignmentSubmit::findOne($receipt->issuedfor); 
    }
    else
    {

    }
    $ownerfullname=($receiptowner!=null)?$receiptowner->fname." ".$receiptowner->mname." ".$receiptowner->lname:"not found";
    $ownerreg=($receiptowner!=null)?$receiptowner->reg_no:"not found";
    $ownerprog=($receiptowner!=null)?$receiptowner->program->prog_name." (".$receiptowner->programCode.")":"not found";
    $owneryos=($receiptowner!=null)?$receiptowner->YOS:"not found";
    $ownercollege=($receiptowner!=null)?$receiptowner->program->department->college->college_name." (".$receiptowner->program->department->college->college_abbrev.")":"not found";

    $submitdate=($submitted!=null)?$submitted->submit_date." ".$submitted->submit_time:"not found";
    $assignment=($submitted!=null)?$submitted->ass->assName:"not found";
    $course=($submitted!=null)?$submitted->ass->course_code." ".$submitted->ass->courseCode->course_name:"not found";

    $signature1="cive classroom ".yii::$app->session->get('currentAcademicYear')->title;
    $signature2=User::findIdentity($receipt->issuer)->instructor->full_name;
 
  
   $receiptbuffer= ['number'=>$number,'type'=>$receipttype,'issuedate'=>$receiptdate,
   'ownername'=>$ownerfullname,'ownerreg'=>$ownerreg,'ownerprog'=>$ownerprog,
   'owneryos'=>$owneryos,'ownercollege'=>$ownercollege,'submitdate'=>$submitdate,
   'assignment'=>$assignment,'course'=>$course,'signature1'=> $signature1,'signature2'=>$signature2
];
if($receipttype=="Group Assignment Submission" && $submitted!=null)
{
    $receiptbuffer['members']=(new StudentGroup)->getGroupMembers($submitted->groupID);  
}

   return base64_encode(ClassRoomSecurity::encrypt(json_encode($receiptbuffer)));

}

public function receiptValidator($content)
{

    $content=ClassRoomSecurity::decrypt(base64_decode($content));
    //check if it's json
   
    $content=json_decode($content,true);
   

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid data");
    }

    if(!is_array($content)){throw new Exception("Invalid data");}
    //check if it's array
    //check if number is set
    $receiptnumber=$content["number"];
        
        try
        {
        $receipt=Receipts::findOne($receiptnumber); 
        if($receipt==null){throw new Exception("Invalid receipt! Receipt not found");}
        return $this->downloadReceipt($receiptnumber);
        }
        catch(Exception $r)
        {
            $this->receiptValidateWithLostData($content);
        }
    
  
}
public function receiptValidateWithLostData($content)
{

    $mpdf = new Mpdf(['orientation' => 'P']);
      
    $mpdf->setFooter('{PAGENO}');
    $stylesheet = file_get_contents('css/capdf.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->SetWatermarkText('civeclassroom.udom.ac.tz',0.09);
    $mpdf->showWatermarkText = true;
    $mpdf->WriteHTML('<div align="center"><img src="img/logo.png" width="60px" height="60px"/></div>',2);
    $mpdf->WriteHTML('<p align="center"><font size=6>Receipt Content</font></p>',3);
    $mpdf->WriteHTML('<hr width="80%" align="center" color="#000000">',2);
    foreach($content as $cont=>$value)
    {
       
        if(is_array($value)){continue;}
        $mpdf->WriteHTML('<p align="center"><font size=4>'.$cont.':'.$value.'</font></p>',3);
        
        
    }
    if(isset($content['members']))
    {
        $mpdf->WriteHTML('<p align="center"><font size=4>members</font></p>',3);
        $mpdf->WriteHTML('<table align="center" cellspacing="0" cellpadding="0" class="membertable">',3);
        
        
        foreach($content['members'] as $i=>$member)
        {
            $i++;
            $mpdf->WriteHTML('<tr><td>'.$i.'</td><td>'.$member.'</td></tr>',3);  
        }
        $mpdf->WriteHTML('</table>',3);

    }
    
    $mpdf->WriteHTML('<p align="center"><font size=2 color="red">Receipt generated despite the lack of data in our system !</font></p>',3);
    
    $filename="receipt.pdf";
    $mpdf->Output($filename,"D");
    return null; 
}

//receipt search with lost receipt data
//searches by specifying the assignment and find it from the database

public function findReceipt($reg,$assignment)
{

}


}
