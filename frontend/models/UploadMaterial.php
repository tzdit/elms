<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Material;
class UploadMaterial extends Model{
    public $assTitle;
    public $assType;
    public $assFile;
    public $ccode;
    public $uploadDate;
    public $uploadTime;
    public $moduleID;
    
    public $totalMarks;
    public function rules(){
        return [
           [['assTitle', 'assType', 'assFile'], 'required'],
           ['moduleID','required'],
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, mp4, MP4, jpg, png, doc, docx, xlsx, xls, pkt, ppt'],


        ];

    }
    public function upload(){
        if(!$this->validate()){
            return false;
        }
        try{
        
        $fileName =uniqid().'.'.$this->assFile->extension;
        $ass = new Material();
        $ass->moduleID=$this->moduleID;
        $ass->yearID=1;
        $ass->title = $this->assTitle;
        $ass->material_type = $this->assType;
        $ass->fileName =  $fileName;
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
        $this->assFile->saveAs('storage/temp/'.$fileName);
        $ass->save(false);
        
        
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }
    
}
?>