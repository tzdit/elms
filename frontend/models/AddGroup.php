<?php

namespace frontend\models;

use common\models\Course;
use common\models\Groups;
use common\models\Student;
use common\models\Instructor;
use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $groupID
 * @property string $groupName
 * @property string|null $course_code
 * @property string|null $reg_no
 * @property int|null $instructorID
 * @property string $creator_type
 * @property string $created_date
 * @property string $created_time
 *
 * @property GroupAssignment[] $groupAssignments
 * @property Course $courseCode
 * @property Student $regNo
 * @property Instructor $instructor
 * @property Student $regNo0
 * @property StudentGroup[] $studentGroups
 */
class AddGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        return [
            [['groupName'], 'required'],
            [['groupName'], 'unique'],
            [['instructorID'], 'integer'],
            [['created_date', 'created_time'], 'safe'],
            [['created_date',], 'date'],
            [[ 'created_time'], 'time'],
            [['groupName'], 'string', 'max' => 225],
            [['course_code'], 'string', 'max' => 7],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
            [['reg_no'], 'default','value'=>Yii::$app->user->identity->username],
            [['creator_type'], 'default','value'=>"STUDENT"],
            [['created_date'], 'default','value' => date('Y-m-d')],
            [['created_time'], 'default','value' => date('H:i:s')],
        ];
    }

    

    /**
     * Gets query for [[GroupAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupAssignments()
    {
        return $this->hasMany(GroupAssignment::className(), ['groupID' => 'groupID']);
    }

    /**
     * Gets query for [[CourseCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode()
    {
        return $this->hasOne(Course::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[Instructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructor()
    {
        return $this->hasOne(Instructor::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[RegNo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo0()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * Gets query for [[StudentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroups()
    {
        return $this->hasMany(StudentGroup::className(), ['groupID' => 'groupID']);
    }



     /**
     * Creating a group of student.
     *
     * @return bool whether the creating new group was successful
     */
    public function add_group()
    {
        //get authManager instance
     $auth = Yii::$app->authManager;
         if (!$this->validate()) {
             return false;
        }

        $group = new Groups();

        
        
        try{
     
        $group->groupName = $this->groupName;
        $group->course_code = $this->course_code;
        $group->reg_no = $this->reg_no;
        $group->creator_type = $this->creator_type;
        $group->created_date =  $this->created_date;
        $group->created_time =   $this->created_time;
        $group->save();
        return true;
        
        
    
       }catch(\Throwable $e){
            return $e->getMessage();
      }
    return false;
}
}
