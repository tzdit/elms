<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Announcement;
class PostAnnouncement extends Model{


    public $content;
    public $title;
 
    
    public $totalMarks;
    public function rules(){
        return [
           ['content','required'],
           ['content','string','max'=>500],
           [['title'], 'string', 'max' => 150]
        ];

    }
    public function announce(){
        if(!$this->validate()){
            return false;
        }

        $ann=new Announcement();
        $ann->content=$this->content;
        $ann->title=$this->title;
        $ann->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
        $ann->instructorID=Yii::$app->user->identity->instructor->instructorID;
        $ann->course_code=yii::$app->session->get('ccode');
       // $ann->course_code=$cid;
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $ann->ann_time=date('h:i:s');
        $ann->ann_date=date('Y-m-d');
        if($ann->save()){return true;}
        else{return false;}
       
    }
    
}
?>