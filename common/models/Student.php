<?php

namespace common\models;
use common\models\StudentGroup;
use Yii;
use kartik\validators\PhoneValidator;
use yii\db\Exception;

/**
 * This is the model class for table "student".
 *
 * @property string $reg_no
 * @property int|null $userID
 * @property string|null $programCode
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $gender
 * @property string $email
 * @property string|null $f4_index_no
 * @property int $YOS
 * @property string $DOR
 * @property string|null $phone
 * @property string $status
 * @property string $type
 * @property Studenteducation $education
 * @property Chat[] $chats
 * @property ExtAssess[] $extAssesses
 * @property Groups[] $groups
 * @property Program $program
 * @property User $user
 * @property StudentShortCourse[] studentshortcourses;
 * @property StudentCourse[] $studentCourses
 * @property StudentGroup[] $studentGroups
 * @property StudentLecture[] $studentLectures
 * @property StudentNotification[] $studentNotifications
 * @property StudentQuiz[] $studentQuizzes
 * @property Submit[] $submits
 * @property Thread[] $threads
 */
class Student extends \yii\db\ActiveRecord
{

    public $profilepic;
    public $documents;
    /**
     * {@inheritdoc}
     */
    /*
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    */
    
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_no', 'fname', 'lname', 'gender', 'YOS', 'DOR', 'status','email'], 'required'],
            [['userID', 'YOS'], 'integer'],
            [['DOR'], 'safe'],
            [['reg_no', 'f4_index_no'], 'string', 'max' => 20],
            [['programCode', 'fname', 'mname', 'lname', 'status'], 'string', 'max' => 60],
            [['gender'], 'string', 'max' => 7],
            [['phone'], 'string', 'max' => 30],
            [['type'],'default','value'=>'permanent'],
            ['type','string','max'=>15],
            ['email', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'This email has already been taken.'],
            ['email', 'email','message' => 'Invalid Email Address.'],
            ['phone', 'unique', 'targetClass' => '\common\models\Student', 'message' => 'phone number already taken.'],
            [['profilepic'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png','checkExtensionByMimeType' => false, 'maxFiles' => 1],
            [['documents'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf','checkExtensionByMimeType' => false, 'maxFiles' => 10],
            [['reg_no'], 'unique'],
            [['programCode'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['programCode' => 'programCode']],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reg_no' => 'Reg No',
            'userID' => 'User ID',
            'programCode' => 'Program Code',
            'fname' => 'First name',
            'email'=>'E-mail',
            'mname' => 'Middle name',
            'lname' => 'Last name',
            'gender' => 'Gender',
            'f4_index_no' => 'F4 Index No',
            'YOS' => 'Yos',
            'DOR' => 'Dor',
            'phone' => 'Phone',
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert)
    {

      if($insert==false && $this->isAttributeChanged('reg_no'))
      {
          $userID=$this->userID;
          $user=User::findOne($userID);
          $user->username=$this->reg_no;
          $user->save();
      }
      if($insert==false && $this->documents!=null)
      {
            $this->uploaddocs();
           
      }
      if($insert==false && $this->profilepic!=null)
      {
            $this->uploadpic();
      }


        return parent::beforeSave($insert);
    }
    public function beforeDelete()
    {

        $userID = $this->userID;
        $user = User::findOne($userID);

        if($user==null)
        {
            return true;
        }
        if(!$user->delete())
        {
            return false;
        }
        return parent::beforeDelete();
    }
  

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[ExtAssesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtAssesses()
    {
        return $this->hasMany(ExtAssess::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[ProgramCode0]].
     *
     * @return \yii\db\ActiveQuery
     */

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userID']);
    }
    public function getEducation()
    {
        return $this->hasOne(Studenteducation::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[StudentCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[StudentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroups()
    {
        return $this->hasMany(StudentGroup::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[StudentLectures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentLectures()
    {
        return $this->hasMany(StudentLecture::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[StudentNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNotifications()
    {
        return $this->hasMany(StudentNotification::className(), ['reg_no' => 'reg_no']);
    }

    public function getStudentshortcourses()
    {
        return $this->hasMany(StudentShortCourse::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[StudentQuizzes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentQuizzes()
    {
        return $this->hasMany(StudentQuiz::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[Submits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmits()
    {
        return $this->hasMany(Submit::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[Threads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThreads()
    {
        return $this->hasMany(Thread::className(), ['reg_no' => 'reg_no']);
    }
    //get student full name
    public function getFullName(){
        return " ".$this->lname." ".$this->fname;
    }
//student relation na programm
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['programCode' => 'programCode']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findReg_no($reg_no)
    {
        return static::findOne(['reg_no' => $reg_no]);
    }

    public function getregstatus()
    {
        if($this->status=="1-status")
        {
            return "complete";
        }
        else if($this->status=="0-status")
        {
           return "Not registered";
        }
        else
        {
           return "Partial"; 
        }
    }

    public function isShort()
    {
        return $this->type=="shorttime";
    }
    public function shortCourses()
    {
        $shortcourses=$this->studentshortcourses;
        $courses=[];

        foreach($shortcourses as $shortcourse)
        {
           array_push($courses,$shortcourse->courseCode); 
        }
        return  $courses;
    }

    public function uploaddocs()
    {
        $docshome = "storage/studentfiles/";
        $dir = $this->userID;
        $path = $docshome . $dir . "/documents/";

        if(!file_exists($path) || !is_dir($path))
        {
            mkdir($path, 0777, true);
        }

        foreach ($this->documents as $document) {
            $id = uniqid();
            $document->saveAs($path . $id . "." . $document->extension);
        
        }


    }
    public function uploadpic()
    {
        $docshome = "storage/studentfiles/";
        $dir = $this->userID;
        $path = $docshome . $dir . "/";

        if(!file_exists($path) || !is_dir($path))
        {
            mkdir($path, 0777, true);
        }


        $name = "profilepic";
        $fullpath = $path . $name . "." . $this->profilepic->extension;

        if(file_exists($fullpath))
        {
            unlink($fullpath);
        }
        $this->profilepic->saveAs($fullpath);
        
        
    }

}
