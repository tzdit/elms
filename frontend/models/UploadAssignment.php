<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
class UploadAssignment extends Model{
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
           [['assTitle', 'submitMode', 'assType', 'startDate', 'endDate', 'description'], 'required'],
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
        $ass = new Assignment();
        $ass->assName = $this->assTitle;
        $ass->assType = $this->assType;
        $ass->submitMode = $this->submitMode;
        $ass->startDate = $this->startDate;
        $ass->finishDate = $this->endDate;
        $ass->fileName =  $fileName;
        $ass->ass_desc = $this->description;
        $ass->assNature = "assignment";
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->total_marks = $this->totalMarks;
        $ass->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
        $this->assFile->saveAs('storage/temp/'.$fileName);
        $ass->save();     
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }
    
}
?>