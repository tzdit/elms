<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "college".
 *
 * @property int $collegeID
 * @property string $college_name
 * @property string $college_abbrev
 *
 * @property Admin[] $admins
 * @property Department[] $departments
 */
class College extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'college';
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
            [['college_name', 'college_abbrev'], 'required'],
            [['college_name'], 'string', 'max' => 50],
            [['college_abbrev'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'collegeID' => 'College ID',
            'college_name' => 'College Name',
            'college_abbrev' => 'College Abbrev',
        ];
    }

    /**
     * Gets query for [[Admins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['collegeID' => 'collegeID']);
    }

    public function getHods()
    {
        return $this->hasMany(Hod::className(), ['collegeID' => 'collegeID']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['collegeID' => 'collegeID']);
    }

    public function getStudents()
    {
        $students=[];
        $departments=$this->departments;

        foreach($departments as $d=>$department)
        {
            $programs=$department->programs;

            foreach($programs as $d=>$program)
            {
               $studentsinprogram=$program->students;

               foreach($studentsinprogram as $s=>$student)
               {
                   array_push($students,$student);
                
               }



            }
        }

        return $students;
    }

    public function getInstructors()
    {
        $instructors=[];
        $departments=$this->departments;

        foreach($departments as $d=>$department)
        {
           
               $dept_instructors=$department->instructors;
                
               foreach($dept_instructors as $i=>$instructor)
               {
            
                   array_push($instructors,$instructor);
                
               }



            
        }

        return  $instructors;
    }
}
