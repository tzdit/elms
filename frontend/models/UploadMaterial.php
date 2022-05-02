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
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, mp4, jpg, MKV, avi, png, doc, docx, xlsx, xls, pkt, ppt, pptx, PDF, MP4, JPG, AVI, PNG, DOC, DOCX, XLSX, XLS, PKT, PPT, PPTX, zip, ZIP, RAR, rar','message'=>'file type not allowed'],


        ];

    }
    public function upload(){
        //if(!$this->validate()){
            //throw new Exception("could not validate your data submission");
       // }
 
        
        $fileName =uniqid().'.'.$this->assFile->extension;
        $ass = new Material();
        $ass->moduleID=$this->moduleID;
        $ass->yearID=yii::$app->session->get("currentAcademicYear")->yearID;
        $ass->title = $this->assTitle;
        $ass->material_type = $this->assType;
        $ass->fileName =  $fileName;
        $ass->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $ass->course_code =Yii::$app->session->get('ccode');
        date_default_timezone_set('Africa/Dar_es_Salaam');

        $ass->upload_time=date("h:i:s");
        $ass->upload_date=date("Y-m-d");
        $this->assFile->saveAs('storage/temp/'.$fileName);
        if($ass->save(false))
        {
            return true;
        }
        else
        {
            $exception="";
            foreach($ass->getErrors() as $key=>$value)
            {
                foreach($value as $content)
                {
                    $exception.=$content;
                }
                
            }
            throw new Exception($exception);

            
        }
        
       

        
    }
    
}
?>