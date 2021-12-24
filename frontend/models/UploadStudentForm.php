<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Student;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\base\Exception;
/**
 * Signup form
 */
class UploadStudentForm extends Model
{
    public $assFile;
    public $filetmp;
    public $fname;
    public $mname;
    public $lname;
    public $email;
    public $program;
    public $YOS;
    public $phone;
    public $gender;
    public $username;
    public $password;
    public $role;
    public $status = 'REGISTERED';


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname','program', 'YOS', 'role', 'gender'], 'required'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Registration number already in  use.'],
            ['email', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This email has already been taken.'],
            [['assFile'],'file','skipOnEmpty' => false, 'extensions' => 'xlsx, xls']


        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function create()
    {
        //get authManager instance
     $auth = Yii::$app->authManager;
         if (!$this->validate()) {
             return false;
        }
        
        $user = new User();
        $student = new Student();
        $transaction = Yii::$app->db->beginTransaction();
        try{
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword(strtoupper($this->lname));
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($user->save()){
           
        //Now insert data to student table
        $student->fname = $this->fname;
        $student->mname = isset($this->mname)?$this->mname:null;
        $student->lname = $this->lname;
        $student->reg_no = $this->username;
        $student->email = $this->email;
        $student->phone = $this->phone;
        $student->gender = $this->gender;
        $student->programCode = $this->program;
        $student->status = $this->status;
        $student->YOS = $this->YOS;
        $student->DOR = date('Y-m-d H:i:s');
        $student->userID = $user->getId();
        if($student->save()){
           
        //now assign role to this newlly created user========>>
        $userRole = $auth->getRole($this->role);
        $auth->assign($userRole, $user->getId());
        $transaction->commit();
        return true;
        }
        }
    
       }catch(\Throwable $e){
            $transaction->rollBack();
            return $e->getMessage();
      }
    return false;
}

// #########################################################################################

public function excelstd_importer(){
       $auth = Yii::$app->authManager;
       $data=null;
        try
        {
        $data=$this->excelstd_to_array($this->filetmp);
        }
        catch(Exception $e)
        {
            return false;
        }
        //$status=false;
        
        $error_rec=array();
        for($std=0;$std<count($data);$std++)
        {
           
           if($std==0){continue;}
           else
           {
           
           $fname=$data[$std][0];
           $mname=$data[$std][1];
           $lname=$data[$std][2];
           $username=$data[$std][3];
           $email=$data[$std][4];
           $phone=$data[$std][5];
           $gender=$data[$std][6];
           $program=$data[$std][7];
           $status=$data[$std][8];
           $YOS=$data[$std][9];
           
        
           $usermodel=new User();
          
           try
           {
            $transaction = Yii::$app->db->beginTransaction();
            $usermodel->username=$username;
            $usermodel->setPassword("123456");
            $usermodel->generateAuthKey();
            $usermodel->generateEmailVerificationToken();   
           if(!$usermodel->save())
           {
            throw new Exception($this->handleErrors($usermodel->getErrors()));
           }
        
           $stdmodel=new Student();
           $stdmodel->fname=$fname;
           $stdmodel->mname=$mname;
           $stdmodel->lname=$lname;
           $stdmodel->email=$email;
           $stdmodel->gender=$gender;
           $stdmodel->reg_no=$username;
           $stdmodel->phone=($phone!==null)?strval($phone):strval(rand());
           $stdmodel->programCode=$program;
           $stdmodel->status=$status;
           $stdmodel->YOS=$YOS;
           $stdmodel->DOR=date('Y-m-d H:i:s');
           $stdmodel->userID = $usermodel->getId();
           
          
          
           if(!$stdmodel->save()){
            throw new Exception($this->handleErrors($stdmodel->getErrors()));
           }
           
            //now assign role to this newlly created user========>>
            $userRole = $auth->getRole('STUDENT');
            $auth->assign($userRole, $usermodel->getId());


            $transaction->commit();
           
           }
           catch(Exception $e)
           {
             $transaction->rollBack();
             $msg=isset(($e->errorInfo)[2])?($e->errorInfo)[2]:$e->getMessage();
             $error_rec[$username]=$msg;

             continue;
               
              
           }
         
      }
     
     
  
  }
  return $error_rec;
}
private function excelstd_to_array($tmpfile)
{
$file_type=IOFactory::identify($tmpfile);
$reader=IOFactory::createReader($file_type);
$data=$reader->load($tmpfile);
$data_array=$data->getActiveSheet()->toArray();
return $data_array;

}
private function handleErrors($errors)
{
  $errorstring="";
  foreach($errors as $error=>$errorinfo)
  {
    for($i=0;$i<count($errorinfo);$i++)
    {
        $errorstring.=$errorinfo[$i];
    }
    

  }

  return $errorstring;

}
  
   
}
