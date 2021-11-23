<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\base\Exception;
use common\models\Material;
class UploadMaterial extends Model{
    public $assTitle;
    public $assType;
    public $assFile;
    public $moduleID;
    public function rules(){
        return [
           [['assTitle', 'assType', 'assFile'], 'required'],
           ['moduleID','required'],
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, mp4, jpg, MKV, avi, png, doc, docx, xlsx, xls, pkt, ppt, pptx'],


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
        $ass->course_code =Yii::$app->session->get('ccode');
        $this->assFile->saveAs('storage/temp/'.$fileName);
        if($ass->save())
        {
            return true;
        }
        else
        {
            
            return false;
            
        }
        
       

        
    }catch(\Exception $e){
    
        throw new Exception($e->getMessage()) ;
    }
    }
    
}
?>