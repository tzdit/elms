<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\Chat;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

class CreateChat extends Model{
    public $username;
    public $instructorID;
    public $chatText;
    public $chatDate;
    public $chatTime;
    public $status;
    
    public function rules(){
        return [
            [['chatText'], 'required'],
            // [['course_code'], 'unique'],
        ];

    }
    public function create(){
        if(!$this->validate()){
            return false;
        }

        $chat = new Chat();

        try{

        $chat->instructorID = Yii::$app->user->identity->instructor->instructorID;
        $chat->reg_no =  $this->username;
        $chat->chatText = $this->chatText;
        $chat->chatDate = date('Y-m-d H:i:s');
        $chat->chatTime = strtotime("now");
        $chat->status = 1;
        $chat->save();   
        
        return true;

        
    }catch(\Exception $e){
    
        return $e->getMessage();
    }
    }
    
}
?>