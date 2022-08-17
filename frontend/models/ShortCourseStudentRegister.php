<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Student;
use yii\base\Exception;
use common\models\Program;
use common\models\StudentShortCourse;
use yii\helpers\Html;
/**
 * Signup form
 */
class ShortCourseStudentRegister extends Model
{
    public $fname;
    public $mname=null;
    public $lname;
    public $email;
    public $program="DITSH";
    public $YOS=1;
    public $phone;
    public $gender;
    public $password = "123456";
    public $role = 'STUDENT';
    public $status="REGISTERED";
    public $type="shorttime";
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname','lname','program','phone', 'YOS', 'gender'], 'required'],
            [['fname', 'mname', 'lname', 'status'], 'string', 'max' => 60],
            ['email','required'],
            ['email', 'trim'],
            ['phone','unique','targetClass' => '\common\models\Student','message'=>'Phone number already in use'],
            ['email', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'User already exists.'],
            ['email', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This email has already been taken.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function create($course)
    {
        $transaction = Yii::$app->db->beginTransaction();
        //get authManager instance
        try{
        $auth = Yii::$app->authManager;
 
        $user = new User();
        $student = new Student();
        
        //$aind=strpos($this->email,'@');
        //$nameuser=substr($this->email,0,$aind);
        //$nameuser=(strlen($nameuser)>17)?substr($nameuser,0,17):$nameuser;
        //$nameuser=str_replace(" ","",$nameuser);
        $reg="DIT".trim($this->phone);
        $user->username = str_replace("+","",$reg);
        $user->status=9;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($user->save()){
           
        //Now insert data to student table
        $student->fname = $this->fname;
        $student->lname = $this->lname;
         $student->mname = $this->mname;
        //$student->mname =($this->mname!==null)?$this->mname:null;
      
        $student->reg_no = $reg;
        $student->email =$this->email;
        $student->phone = $this->phone;
        $student->gender = $this->gender;
        $student->type=$this->type;

        //is program there?

        $program=Program::findOne($this->program);
        if($program==null)
        {
            throw new Exception("Program for this course not found !");
        }
        $student->programCode = $program->programCode;
        $student->status = $this->status;
        $student->YOS = 1;
        $student->DOR = date('Y-m-d H:i:s');
        $student->userID = $user->getId();
        if($student->save()){
           
        //now assign role to this newly created user========>>
       
        $userRole = $auth->getRole($this->role);
        $auth->assign($userRole, $user->getId());
        //automatically assigning the student to this course

        $studentcourse=new StudentShortCourse;
        $studentcourse->reg_no=$student->reg_no;
        $studentcourse->course_code=ClassRoomSecurity::decrypt($course);

        if($studentcourse->save())
        {
        $transaction->commit();
        
        return $student->reg_no;
        }
        else
        {
            throw new Exception("Registration failed, Could not register student to this course");  
        }
        }
        else
        {
            throw new Exception("Registration failed, An unexpected error occured".Html::errorSummary($student));
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
