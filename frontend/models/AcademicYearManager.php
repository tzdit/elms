<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Academicyear;
use yii\base\Exception;

/*
A model class for managing academicyear, switching to and from a specific 
academic year, and migrating the whole system to a new academic year
*/

class AcademicYearManager extends Model
{
    public $duration=12;
    public $yearid;
    
    
    public function rules()
    {
        return [
            [['duration', 'yearid'], 'required']
          
        ];
    }

    public function switchAcademicYear()
    {
        //setting up the new selected academic year
        try
        {
        yii::$app->session->set('currentAcademicYear', Academicyear::find()->where(['yearID'=>$this->yearid])->one());
        return true;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }

        
    }

  
   
}
