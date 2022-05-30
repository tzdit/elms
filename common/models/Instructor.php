<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "instructor".
 *
 * @property int $instructorID
 * @property int|null $userID
 * @property int|null $departmentID
 * @property string $full_name
 * @property string $gender
 * @property string|null $PP
 * @property string|null $phone
 *
 * @property Announcement[] $announcements
 * @property Assignment[] $assignments
 * @property Chat[] $chats
 * @property ExtAssess[] $extAssesses
 * @property Groups[] $groups
 * @property Department $department
 * @property User $user
 * @property InstructorCourse[] $instructorCourses
 * @property InstructorNotification[] $instructorNotifications
 * @property LiveLecture[] $liveLectures
 * @property Material[] $materials
 * @property Thread[] $threads
 */
class Instructor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
 
    public static function tableName()
    {
        return 'instructor';
    }
    
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'departmentID'], 'integer'],
            [['full_name', 'gender'], 'required'],
            [['full_name'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 7],
            [['PP'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 30],
            [['phone'], 'unique'],
            [['departmentID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departmentID' => 'departmentID']],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'instructorID' => 'Instructor ID',
            'userID' => 'User ID',
            'departmentID' => 'Department ID',
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'PP' => 'Pp',
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[Announcements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncements()
    {
        return $this->hasMany(Announcement::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Assignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[ExtAssesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtAssesses()
    {
        return $this->hasMany(ExtAssess::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['departmentID' => 'departmentID']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userID']);
    }

    /**
     * Gets query for [[InstructorCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructorCourses()
    {
        return $this->hasMany(InstructorCourse::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[InstructorNotifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructorNotifications()
    {
        return $this->hasMany(InstructorNotification::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[LiveLectures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLiveLectures()
    {
        return $this->hasMany(LiveLecture::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Threads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThreads()
    {
        return $this->hasMany(Thread::className(), ['instructorID' => 'instructorID']);
    }
    //get instructor courses via instructor_course table as junction table
    public function getCourses(){
        return $this->hasMany(Course::className(), ['course_code'=>'course_code'])
                    ->viaTable('instructor_course', ['instructorID'=>'instructorID']);
    }
    public function updateit($role)
    {
        $connection=yii::$app->db;
        $transact=$connection->beginTransaction();

        try
        {
        if($this->save() && $role->save())
        {
            $transact->commit();
            return true;
        }
        else
        {
            $transact->rollBack(); 
            return false;
        }
       }
       catch(Exception $s)
       {
        $transact->rollBack(); 
        return false;
       }
    }
    
}
