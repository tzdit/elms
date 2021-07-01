<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
class UploadLab extends Model{
    public $assTitle;
    public $submitMode;
    public $assType;
    public $startDate;
    public $endDate;
    public $assFile;
    public $description;
    public $ccode;
    
    public $totalMarks;
    public function rules(){
        return [
            [['assTitle', 'submitMode', 'assType', 'startDate', 'endDate', 'description', 'assFile'], 'required'],
            [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg, png, doc, pkt, ppt'],
            
            
            
 
            [['totalMarks'], 'required']
 
         ];

    }
    public function upload(){
        if(!$this->validate()){
            return false;
        }
        try{
        
            $fileName = $this->assFile->baseName.'.'.$this->assFile->extension;
            $lab = new Assignment();
            $lab->assName = $this->assTitle;
            $lab->assType = $this->assType;
            $lab->submitMode = $this->submitMode;
            $lab->startDate = $this->startDate;
            $lab->finishDate = $this->endDate;
            $lab->fileName =  $fileName;
            $lab->ass_desc = $this->description;
            $lab->assNature = "lab";
            $lab->instructorID = Yii::$app->user->identity->instructor->instructorID;
            $lab->total_marks = $this->totalMarks;
            $lab->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
            $this->assFile->saveAs('storage/temp/'.uniqid().$fileName);
            $lab->save(false);     
            return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }
    
}
?>