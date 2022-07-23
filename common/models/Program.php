<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "program".
 *
 * @property string $programCode
 * @property int|null $departmentID
 * @property string $prog_name
 * @property int $prog_duration
 * @property int|null $capacity
 *
 * @property Department $department
 * @property ProgramCourse[] $programCourses
 * @property Student[] $students
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program';
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
            [['programCode', 'prog_name', 'prog_duration'], 'required'],
            [['departmentID', 'prog_duration', 'capacity'], 'integer'],
            [['programCode'], 'string', 'max' => 10],
            [['prog_name'], 'string', 'max' => 100],
            [['programCode'], 'unique'],
            [['departmentID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departmentID' => 'departmentID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'programCode' => 'Program Code',
            'departmentID' => 'Department ID',
            'prog_name' => 'Prog Name',
            'prog_duration' => 'Prog Duration',
            'capacity' => 'Capacity',
        ];
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
     * Gets query for [[ProgramCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramCourses()
    {
        return $this->hasMany(ProgramCourse::className(), ['programCode' => 'programCode']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['programCode' => 'programCode']);
    }

    public function getCourses(){
        return $this->hasMany(Course::className(), ['course_code'=>'course_code'])->viaTable('program_course',['programCode'=>'programCode']);
    }

    public function getHod()
    {
        return $this->hasOne(Hod::className(), ['programCode' => 'programCode']);
    }
    public function getFullProgram()
    {
        return $this->prog_name." (".$this->programCode.")";
    }
    public function getCollege()
    {
        return $this->department->college->college_name;
    }

    
}
