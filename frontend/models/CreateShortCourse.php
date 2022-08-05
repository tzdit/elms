<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Course;
use common\models\Department;
use common\models\ProgramCourse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Exception;
class CreateShortCourse extends Model{
    public $course_code;
    public $departments;
    public $course_name;
    public $course_duration;

    public $YOS;
    public function rules(){
        return [
            [['course_code', 'course_name', 'YOS', 'departments'], 'required'],
            [['course_duration'], 'integer'],
            [['course_code'], 'string', 'max' =>20],
            ['course_code', 'unique', 'targetClass' => '\common\models\Course', 'message' => 'This course already exists.'],
            [['course_name'], 'string', 'max' => 150],
        ];

    }
    public function create(){
   

        $coz = new Course();

        try{

        $coz->course_code = $this->course_code;
        $coz->course_name =  $this->course_name;
        $coz->course_credit =0;
        $coz->course_semester =0;
        $coz->course_duration = $this->course_duration;
        $coz->course_status ="N/A";
        $coz->departmentID = $this->departments;
        $coz->type="short_course";
        $coz->caw=0;
        $coz->sew=0;
        $coz->YOS =0;
      

        if(!$coz->save()){ 
            return false;
        }   
        
        return true;

        
    }catch(\Exception $e){
    
        throw new Exception($e->getMessage());
    }
    }

    
    
}
?>