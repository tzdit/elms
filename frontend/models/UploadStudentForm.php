<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Student;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
            [['fname', 'mname', 'lname','program', 'YOS', 'role', 'gender'], 'required'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This user has already been taken.'],
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
        $student->mname = $this->mname;
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
    
//     if(!$this->validate()){
//        return false;
//    }
        
   try{
        $data=$this->excelstd_to_array($this->filetmp);
        //$status=false;
        $error_rec=[];
        //saving the assessment first

        

        
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
           
           $usermodel->username=$username;
           //$usermodel->email=$email;
           $usermodel->setPassword(strtoupper($this->lname));
           $usermodel->generateAuthKey();
           $usermodel->generateEmailVerificationToken();
           

           if($usermodel->save())
           {
           $stdmodel=new Student();
           $stdmodel->fname=$fname;
           $stdmodel->mname=$mname;
           $stdmodel->lname=$lname;
           $stdmodel->email=$email;
           $stdmodel->gender=$gender;
           $stdmodel->reg_no=$username;
           $stdmodel->phone=strval($phone);
           $stdmodel->programCode=$program;
           $stdmodel->status=$status;
           $stdmodel->YOS=$YOS;
           $stdmodel->DOR=date('Y-m-d H:i:s');
           $stdmodel->userID = $usermodel->getId();
           
          
        
           if($stdmodel->save()){
           
            //now assign role to this newlly created user========>>
            $userRole = $auth->getRole('STUDENT');
            $auth->assign($userRole, $usermodel->getId());
            }
           

           }
        }

      return $error_rec;
      }
     
  }catch(\Exception $e){
    print  "oops".$e->getMessage();
      return false;
  }
  }
private function excelstd_to_array($tmpfile)
{
$file_type=IOFactory::identify($tmpfile);
$reader=IOFactory::createReader($file_type);
$data=$reader->load($tmpfile);
$data_array=$data->getActiveSheet()->toArray();
return $data_array;

}
  
   
}
