<?php


namespace frontend\models;



use common\models\GroupGenerationTypes;
use common\models\Groups;
use common\models\StudentGroup;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * create group
 */

class GroupCreateForm extends Model
{
    public $memberStudents;
    public $generation_type;
    public $groupName;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupName','memberStudents', 'generation_type'], 'required'],
            [['groupName'], 'string', 'max' => 10],
            [['generation_type'], 'exist', 'skipOnError' => true, 'targetClass' => GroupGenerationTypes::className(), 'targetAttribute' => ['generation_type' => 'typeID']],
        ];
    }


    /**
     * {@inheritdoc}
     * @throws NotFoundHttpException
     */
    public function groupCreate()
    {

        if (!$this->validate()) {
            return false;
        }

        $count = count($this->memberStudents);

        $limit = GroupGenerationTypes::find()->select(['max_groups_members'])->where('typeID = :typeID', [':typeID' => $this->generation_type])->one();

        if ( $count > $limit->max_groups_members){
            Yii::$app->session->setFlash('error', 'Group exceed maximum limit');
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try{

            $group = new Groups();

            $group->groupName = $this->groupName;
            $group->generation_type = $this->generation_type;

//            echo '<pre>';
//                            print_r($count);
//                            echo  '</pre>';
//                            exit();

            if($group->save()){
                $errors=[];
                foreach ($this->memberStudents as $i => $reg_no)
                {
                    $studentGroup = new StudentGroup();

                    $studentGroup->groupID = $group->groupID;
                    $studentGroup->reg_no = $reg_no;


                    $studentInTwoGroup = StudentGroup::find()->select('student_group.reg_no')->join('INNER JOIN','groups','groups.groupID = student_group.groupID')->where('groups.generation_type = :gen_type AND reg_no = :reg_no',[':gen_type' => $this->generation_type, ':reg_no' => $studentGroup->reg_no])->one();

                    if ( !empty($studentInTwoGroup)){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', $studentGroup->reg_no.' '.'already added in another group');
                        return false;
                    }

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
        return true;
    }


}