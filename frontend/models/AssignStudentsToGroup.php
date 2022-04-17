<?php
namespace frontend\models;
use common\models\StudentGroup;
use Yii;
use yii\base\Model;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
class AssignStudentsToGroup extends Model
{

    public $reg_no;
    public $groupID;

    public function rules()
    {
        return [
            ['reg_no', 'required'],
            ['groupID', 'required']
        ];
    }
}
?>




