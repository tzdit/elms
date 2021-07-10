<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Assignment;
use common\models\GroupGenerationAssignment;
use common\models\Assq;
use common\models\GroupAssignment;
use common\models\ExtAssess;
use PhpOffice\PhpSpreadsheet\IOFactory;
class External_assess extends Model{
    public $assTitle;
    public $assFile;
    public $filetmp;
    public $totalMarks;
    public function rules(){
        return [
           ['assTitle','string', 'max'=>20],
           [['totalMarks'], 'required'],
           [['assFile'],'file','skipOnEmpty' => false, 'extensions' => 'xlsx, xls']
        ];

    }
    public function excel_importer(){
      
      if(!$this->validate()){
         return false;
     }
     try{
          $data=$this->excel_to_array($this->filetmp);
          $status=false;
          for($ass=0;$ass<count($data);$ass++)
          {
             if($ass==0){continue;}
             else
             {
             $regno=$data[$ass][0];
             $score=$data[$ass][1];
             $model=new ExtAssess();
             $model->reg_no=$regno;
             $model->score=$score;
             $model->course_code=yii::$app->session->get('ccode');
             $model->title=$this->assTitle;
             $model->instructorID=Yii::$app->user->identity->instructor->instructorID;
             $model->total_marks=$this->totalMarks;
             $status=$model->save();
             }
          } 

          if($status){return true;}else{return false;}
    }catch(\Exception $e){
      print $e->getMessage();
        //return false;
    }
    }
private function excel_to_array($tmpfile)
{
 $file_type=IOFactory::identify($tmpfile);
 $reader=IOFactory::createReader($file_type);
  $data=$reader->load($tmpfile);
  $data_array=$data->getActiveSheet()->toArray();
  return $data_array;

}
}
?>