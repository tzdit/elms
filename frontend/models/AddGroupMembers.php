<?php

namespace frontend\models;

use common\models\ForumQnTag;
use common\models\ForumQuestion;
use common\models\GroupGenerationTypes;
use common\models\Groups;
use common\models\StudentGroup;
use Yii;
use yii\base\Model;
use yii\helpers\HtmlPurifier;
use yii\web\NotFoundHttpException;

/**
 * add member form
 */
class AddGroupMembers extends Model
{

    public $memberStudents;
    public $generation_type;
    public $groupName;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupName', 'generation_type','memberStudents'], 'required'],
            [['generation_type'], 'integer'],
            [['groupName'], 'string', 'max' => 10],
            [['generation_type'], 'exist', 'skipOnError' => true, 'targetClass' => GroupGenerationTypes::className(), 'targetAttribute' => ['generation_type' => 'typeID']],
        ];
    }


    /**
     * {@inheritdoc}
     * @throws NotFoundHttpException
     */
    public function addMember()
    {

        if (!$this->validate()) {
            return false;
        }


        $transaction = Yii::$app->db->beginTransaction();
        try{

            $group = new Groups();

            $group->groupName = $this->groupName;
            $group->generation_type = $this->generation_type;
            if($group->save()){

                $errors=[];
                foreach ($this->memberStudents as $i => $reg_no)
                {
                    $studentGroup = new StudentGroup();

                    $studentGroup->groupID = $group->groupID;
                    $studentGroup->reg_no = $reg_no;

                    if(!$studentGroup->save()){

                        $errors[$reg_no]=!empty($studentGroup->getErrors()['SG_ID'])?$studentGroup->getErrors()['SG_ID'][0]:" ";
                        continue;

                    }

                }

                $transaction->commit();
                return $errors;
            }
        }catch(\Throwable $e){

            $transaction->rollBack();
            throw new NotFoundHttpException('Fail to create group');
        }
        return false;
    }


}
