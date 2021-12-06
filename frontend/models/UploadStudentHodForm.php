<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Student;
use yii\base\Exception;
/**
 * Signup form
 */
class UploadStudentHodForm extends Model
{
    public $fname;
    public $mname=null;
    public $lname;
    public $email;
    public $program;
    public $YOS;
    public $phone;
    public $gender;
    public $username;
    public $password = "123456";
    public $role = 'STUDENT';
    public $status = 'REGISTERED';
    public $department;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname','lname','program', 'YOS', 'role', 'gender'], 'required'],
            [['fname', 'mname', 'lname', 'status'], 'string', 'max' => 60],
            ['username', 'trim'],
            ['username', 'required'],
            ['email','required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'User already exixts.'],
            ['email', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This email has already been taken.'],
           


        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function create()
    {
        $transaction = Yii::$app->db->beginTransaction();
        //get authManager instance
        try{
        $auth = Yii::$app->authManager;
         if (!$this->validate()) {
             throw new Exception("Registration failed, Please verify your data and resubmit");
        }
        $patt="/^((T|T[0-9]{2})|(HD))([-]|[\/])((UDOM)|[0-9]{2})([-]|[\/])(([0-9]{4}[\/]([0-9]{5}|(T\.[0-9]{4})))|([0-9]{5}))$/";
        if(!preg_match($patt,$this->username)){throw new Exception("Invalid registration number");}
        $user = new User();
        $student = new Student();
        
       
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($user->save()){
           
        //Now insert data to student table
        $student->fname = $this->fname;
        //$student->mname =($this->mname!==null)?$this->mname:null;
        $student->mname =$this->mname;
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
           
        //now assign role to this newly created user========>>
       
        $userRole = $auth->getRole($this->role);
        $auth->assign($userRole, $user->getId());

        $transaction->commit();
        
        return true;
        }
        else
        {
            throw new Exception("Registration failed, An unexpected error occured");
        }
        }
        else
        {
            throw new Exception("Registration failed, Could not create user account");
        }
    
       }catch(\Exception $e){
            $transaction->rollBack();
            throw new Exception($e->getMessage());
      }
   
}

  
   
}
