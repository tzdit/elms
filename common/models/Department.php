<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $departmentID
 * @property int|null $collegeID
 * @property string $department_name
 * @property string|null $depart_abbrev
 *
 * @property College $college
 * @property Instructor[] $instructors
 * @property Program[] $programs
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
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
            [['collegeID'], 'integer'],
            [['department_name'], 'required'],
            [['department_name'], 'string', 'max' => 100],
            [['depart_abbrev'], 'string', 'max' => 10],
            [['collegeID', 'department_name', 'depart_abbrev'], 'safe'],
            [['collegeID'], 'exist', 'skipOnError' => true, 'targetClass' => College::className(), 'targetAttribute' => ['collegeID' => 'collegeID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'departmentID' => 'Department ID',
            'collegeID' => 'College ID',
            'department_name' => 'Department Name',
            'depart_abbrev' => 'Depart Abbrev',
        ];
    }

    /**
     * Gets query for [[College]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCollege()
    {
        return $this->hasOne(College::className(), ['collegeID' => 'collegeID']);
    }

    /**
     * Gets query for [[Instructors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructors()
    {
        return $this->hasMany(Instructor::className(), ['departmentID' => 'departmentID']);
    }

    public function getHod()
    {
        return $this->hasOne(Hod::className(), ['departmentID' => 'departmentID']);
    }

    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['departmentID' => 'departmentID']);
    }

    /**
     * Gets query for [[Programs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Program::className(), ['departmentID' => 'departmentID']);
    }
    public function getDepartment_full()
    {
        return $this->department_name." (".$this->depart_abbrev.")";
    }
    public function getDepartCollege()
    {
        return $this->college->college_name;
    }
}
