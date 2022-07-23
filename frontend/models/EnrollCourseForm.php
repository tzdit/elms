<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\InstructorCourse;
/**
 * EnrollCourse form
 */
class EnrollCourseForm extends Model
{
    public $course_code;
  


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['course_code', 'required'],
           

        ];
    }

  
    public function enroll()
    {
        
         if (!$this->validate()) {
             return false;
        }
        $inc = new InstuctorCourse;
        $inc->course_code = $this->course_code;
        $inc->instructorID = Yii::$app->user->identity->instructor->instructorID;
        if($inc->save()){
            return true;
        }
       
    
    return false;
}

  
}
