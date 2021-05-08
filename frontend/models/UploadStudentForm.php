<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Student;
/**
 * Signup form
 */
class UploadStudentForm extends Model
{
    public $fname;
    public $mname;
    public $lname;
    public $email;
    public $program;
    public $YOS;
    public $phone;
    public $gender;
    public $username;
    public $password = "123456";
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
        $user->setPassword($this->password);
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

  
   
}
