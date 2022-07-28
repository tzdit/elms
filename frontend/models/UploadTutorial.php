<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
use yii\helpers\Html;
class UploadTutorial extends Model{
    public $assTitle;
    public $assFile;
    public $description;
    
    public function rules(){
        return [
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg, png, doc,docx, pkt, ppt,MP4,mpg,avi, pptx, xls,xlsx'],
          ['assTitle','required'],
          ['description','string','max' => 1000]

        ];

    }
    public function upload(){
     
        try{
        
        $fileName = $this->assFile->baseName.'.'.$this->assFile->extension;
        $tut = new Assignment();
        $tut->assName =$this->assTitle;
        $tut->ass_desc=$this->description;
        $tut->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
        $tut->assNature = "tutorial";
        $tut->instructorID =Yii::$app->user->identity->instructor->instructorID;
        $tut->course_code =yii::$app->session->get('ccode');
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $extension=pathinfo($fileName,PATHINFO_EXTENSION);
        $filename=uniqid().'.'.$extension;
        $this->assFile->saveAs('storage/temp/'.$filename);
        $tut->fileName =$filename;
        $tut->create_time=date('Y-m-d H:i:s');
        $tut->status="notpublished";

        if($tut->save())
        {
            return true;
        }
        else
        {

            //check if the file is already upload and destroy it
          return Html::errorSummary($tut);
            if(file_exists('storage/temp/'.$filename)){unlink('storage/temp/'.$filename);}
            return false;
        }
        
      
        

        
    }catch(\Exception $e){
    
        return  $e->getMessage();
    }
    }
    
}
?>