<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Announcement;
class PostAnnouncement extends Model{


    public $content;
<<<<<<< HEAD
=======
    public $title;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
 
    
    public $totalMarks;
    public function rules(){
        return [
           ['content','required'],
           ['content','string','max'=>500],
<<<<<<< HEAD
=======
           [['title'], 'string', 'max' => 150]
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        ];

    }
    public function announce(){
        if(!$this->validate()){
            return false;
        }

        $ann=new Announcement();
        $ann->content=$this->content;
<<<<<<< HEAD
=======
        $ann->title=$this->title;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        $ann->instructorID=Yii::$app->user->identity->instructor->instructorID;
        $ann->course_code=yii::$app->session->get('ccode');

        if($ann->save()){return true;}
        else{return false;}
       
    }
    
}
?>