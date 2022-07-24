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
class UpdateCourse extends Model{
    public $course_code;
    public $programs;
    public $course_name;
    public $course_credit;
    public $course_semester;
    public $course_duration;
    public $course_status;
    public function rules(){
        return [
            [['course_code', 'course_name', 'course_credit', 'course_semester'], 'required'],
            [[ 'course_semester', 'course_duration'], 'integer'],
            [['course_code'], 'string', 'max' => 7],
            [['course_name'], 'string', 'max' => 150],
            [['course_status'], 'string', 'max' => 10],
            ['programs','required']
            // [['course_code'], 'unique'],
        ];

    }
    public function create(){
        try{
        if(!$this->validate()){
           throw new Exception("unable to validate your data");
        }

        $coz = new Course();

      

        $coz->course_code = $this->course_code;
        $coz->course_name =  $this->course_name;
        $coz->course_credit = $this->course_credit;
        $coz->course_semester = $this->course_semester;
        $coz->course_duration = $this->course_duration;
        $coz->course_status = $this->course_status;
        $programs = $this->programs;

        $coz->save();   

        return true;

        
    }catch(\Exception $e){
    
        throw new Exception($e->getMessage());
    }
    }

    
    
}
?>