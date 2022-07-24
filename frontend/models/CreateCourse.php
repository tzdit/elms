<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Course;
use common\models\Department;
use common\models\ProgramCourse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
class CreateCourse extends Model{
    public $course_code;
    public $departments;
    public $course_name;
    public $course_credit;
    public $course_semester;
    public $course_duration;
    public $course_status;
    public $sew;
    public $caw;
    public $YOS;
    public function rules(){
        return [
            [['course_code', 'course_name', 'course_credit', 'YOS','caw','sew', 'course_semester', 'departments'], 'required'],
            [[ 'course_semester', 'course_duration'], 'integer'],
            [['course_code'], 'string', 'max' =>20],
            ['course_code', 'unique', 'targetClass' => '\common\models\Course', 'message' => 'This course already exists.'],
            [['course_name'], 'string', 'max' => 150],
            [['course_status'], 'string', 'max' => 15],
            [['YOS'], 'integer', 'max' => 5, 'min'=> 1],
            // [['course_code'], 'unique'],
        ];

    }
    public function create(){
        if(!$this->validate()){
            return false;
        }

        $coz = new Course();

        try{

        $coz->course_code = $this->course_code;
        $coz->course_name =  $this->course_name;
        $coz->course_credit = $this->course_credit;
        $coz->course_semester = $this->course_semester;
        $coz->course_duration = $this->course_duration;
        $coz->course_status = $this->course_status;
        $coz->departmentID = $this->departments;
        $coz->caw=$this->caw;
        $coz->sew=$this->sew;
        $coz->YOS = $this->YOS;
      

        if(!$coz->save()){ 
            throw new Exception("could not save course details");
        }   
        
        return true;

        
    }catch(\Exception $e){
    
        throw new Exception($e->getMessage());
    }
    }

    
    
}
?>