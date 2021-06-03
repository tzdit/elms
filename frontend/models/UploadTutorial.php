<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
class UploadTutorial extends Model{
    public $assTitle;
    public $assFile;
    public $description;
    public $ccode;
    public function rules(){
        return [
           [['assTitle', 'description'], 'required'],
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg, png, doc, pkt, ppt']
           

        ];

    }
    public function upload(){
        if(!$this->validate()){
            return false;
        }
        try{
        
        $fileName = $this->assFile->baseName.'.'.$this->assFile->extension;
        $tut = new Assignment();
        $tut->assName = $this->assTitle;
        $tut->fileName =  $fileName;
        $tut->ass_desc = $this->description;
        $tut->assNature = "tutorial";
        $tut->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $tut->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
        $this->assFile->saveAs('storage/temp/'.$fileName);
        $tut->save();     
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }
    
}
?>