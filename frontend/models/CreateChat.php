<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Chat;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

class CreateChat extends Model{
    public $reg_no;
    public $instructorID;
    public $chatText;
    public $chatDate;
    public $chatTime;
    public $status;
    
    public function rules(){
        return [
            [['chatText', 'reg_no'], 'required'],
            // [['course_code'], 'unique'],
        ];

    }
    public function create(){
        try{
        if(!$this->validate()){
            throw new Exception("could not validate data");
        }

        $chat = new Chat();

        

        $chat->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $chat->reg_no =  $this->reg_no;
        $chat->chatText = $this->chatText;
        $chat->chatDate = date('Y-m-d H:i:s');
        $chat->chatTime = strtotime("now");
        $chat->status ="true";
        if($chat->save()){return true;} 
        else
        {  
            print_r($chat->getErrors());
         throw new Exception("message not delivered");
        }

        
    }catch(\Exception $e){
    
        throw new Exception($e->getMessage());
    }
    }
    
}
?>