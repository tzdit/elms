<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\InstructorCourse;
/**
 * Signup form
 */
class AddPartner extends Model
{
    public $partner;
   


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['partner', 'required'],
       ];
    }

  public function addcoursepartner($ccode)
  {
    $instructorcourse=new InstructorCourse();
    $instructorcourse->instructorID=$this->partner;
    $instructorcourse->course_code=$ccode;
    
    if($instructorcourse->save())
    {
        return true;
    }

  }  

  
   
}
