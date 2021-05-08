<?php 
namespace common\helpers;
use Yii;
use common\models\InstructorCourse;
class Custom {
    //function to check if instructor enrolled to particular course
    public static function isEnrolled($ccode){
        $course = InstructorCourse::find()->where(['course_code'=>$ccode, 'instructorID'=>Yii::$app->user->identity->instructor->instructorID])->one();
        if($course != null){
            return true;
        }
        return false;
    }



    }


 ?>