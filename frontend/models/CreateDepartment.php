<?php

namespace app\models;

use common\models\Department;
use common\models\College;
use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "department".
 *
 * @property int $departmentID
 * @property int|null $collegeID
 * @property string $department_name
 * @property string|null $depart_abbrev
 *
 * @property Course[] $courses
 * @property College $college
 * @property Instructor[] $instructors
 * @property Program[] $programs
 */
class CreateDepartment extends \yii\db\ActiveRecord
{


    public $department_name;
    public $depart_abbrev;
    public $collegeID;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['collegeID'], 'integer'],
            [['collegeID'], 'required','message'=>'Please choose a college'],
            [['department_name'], 'required','message'=>'Please Input a department name'],
            [['department_name'], 'string', 'max' => 100],
            [['depart_abbrev'], 'string', 'max' => 10],
            ['department_name', 'unique', 'targetAttribute' => ['department_name', 'collegeID'],'message'=>'Department already exists in this college'],
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
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['departmentID' => 'departmentID']);
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

    /**
     * Gets query for [[Programs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Program::className(), ['departmentID' => 'departmentID']);
    }
    public function create(){
        if(!$this->validate()){
            return false;
        }

        $department = new Department();
        $adminCollege = Yii::$app->user->identity->admin->collegeID;

        try{

            $department->collegeID =  $this->collegeID;
            $department->department_name = $this->department_name;
            $department->depart_abbrev = $this->depart_abbrev;
            $department->save();

            if(!$department->save()){
                throw new Exception("could not save Department details");
            }

            return true;


        }catch(\Exception $e){

            throw new Exception($e->getMessage());
        }
    }



}
