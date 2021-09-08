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
<<<<<<< HEAD
           [['assTitle', 'description'], 'required'],
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg, png, doc, pkt, ppt']
           
=======
           [['assFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, jpg, png, doc, pkt, ppt,xls,xlsx'],
          ['assTitle','required']
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd

        ];

    }
    public function upload(){
        if(!$this->validate()){
            return false;
<<<<<<< HEAD
=======

>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        }
        try{
        
        $fileName = $this->assFile->baseName.'.'.$this->assFile->extension;
        $tut = new Assignment();
<<<<<<< HEAD
        $tut->assName = $this->assTitle;
        $tut->fileName =  $fileName;
=======
        $tut->assName =$this->assTitle;
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        $tut->ass_desc = $this->description;
        $tut->assNature = "tutorial";
        $tut->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $tut->course_code = isset($this->ccode) ? $this->ccode : Yii::$app->session->get('ccode');
<<<<<<< HEAD
        $this->assFile->saveAs('storage/temp/'.uniqid().$fileName);
        $tut->save(false);     
=======
        $extension=pathinfo($fileName,PATHINFO_EXTENSION);
        $filename=uniqid().'.'.$extension;
        $this->assFile->saveAs('storage/temp/'.$filename);
        $tut->fileName =$filename;
        $tut->save(); 
        
      
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        return true;

        
    }catch(\Exception $e){
    
<<<<<<< HEAD
        return $e->getMessage();
=======
        return  $e->getMessage();
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
    }
    }
    
}
?>