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
    
    public $totalMarks;
    public function rules(){
        return [
           [['assTitle', 'assType', 'assFile'], 'required'],
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg, png, doc, pkt, ppt'],
           
           
        

        ];

    }
    public function upload(){
        if(!$this->validate()){
            return false;
        }
        try{
        
        $fileName = $this->assFile->baseName.'.'.$this->assFile->extension;
        $ass = new Material();
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