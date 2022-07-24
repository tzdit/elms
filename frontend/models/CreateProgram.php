<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Program;
use common\models\Department;
class CreateProgram extends Model{
    public $programCode;
    public $prog_name;
    public $prog_duration;
    public $capacity;
    public $department;
    public function rules(){
        return [
            [['programCode', 'prog_name', 'prog_duration', 'department'], 'required'],
            [[ 'prog_duration', 'capacity'], 'integer'],
           
            ['programCode', 'unique', 'targetClass' => '\common\models\Program', 'message' => 'This program already exists.'],
            
         

        ];

    }
    public function upload(){
        if(!$this->validate()){
            return false;
        }
        try{
        
        $prog = new Program();
        $prog->programCode = $this->programCode;
        $prog->prog_name =  $this->prog_name;
        $prog->prog_duration = $this->prog_duration;
        $prog->capacity = $this->capacity;
        $prog->departmentID = $this->department;

        $prog->save(false);     
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }
    
}
?>