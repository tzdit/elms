<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Course;
use common\models\Department;
use common\models\ProgramCourse;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
class AssignCourse extends Model{
    
    public $courses;
    public $programs;
    public $level;
    public function rules(){
        return [
            [['courses'], 'required'],
            ['programs','required'],
            ['level','required']
            // [['course_code'], 'unique'],
        ];

    }
    public function create(){
        if(!$this->validate()){
            return false;
        }
            $coz = new Course();
        try{
            $courses = $this->courses;
            $programs = $this->programs;
            $level = $this->level;
            foreach($programs as $prog)
            {
            
            $progcourse = new ProgramCourse();
            $progcourse->course_code = $courses;
            $progcourse->level = $level;
            $progcourse->programCode = $prog;
            $progcourse ->save();
            }
        
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }

}
?>