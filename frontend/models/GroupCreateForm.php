<?php


namespace frontend\models;



use common\models\GroupGenerationTypes;
use common\models\Groups;
use common\models\StudentGroup;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use common\models\Student;

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
            Yii::$app->session->setFlash('error', 'Group creation failed');
            return false;
        }
      
        $count = count($this->memberStudents);
        $limit = GroupGenerationTypes::find()->select(['max_groups_members'])->where('typeID = :typeID', [':typeID' => $this->generation_type])->one();

        if ( $count > $limit->max_groups_members - 1){
            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Could not create group! Group exceeds maximum limit of '.$limit->max_groups_members.' members');
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try{

            $group = new Groups();

            $group->groupName = $this->groupName;
            $group->generation_type = $this->generation_type;
            $group->creator=yii::$app->user->identity->student->reg_no;
//            echo '<pre>';
//                            print_r($count);
//                            echo  '</pre>';
//                            exit();

            if($group->save()){

                $selfStudent = new StudentGroup();

                $selfStudent->groupID = $group->groupID;
                $selfStudent->reg_no = Yii::$app->user->identity->username;

                  //does the student have another group?

                  $creatorgroup=Student::findOne($selfStudent->reg_no);
                  $studentgroups=$creatorgroup->studentGroups;

                  foreach($studentgroups as $studentgroup)
                  {
                  if($studentgroup->group->generation_type==$this->generation_type)
                  {
                      $transaction->rollBack();
                      Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Could not create group! you already have another group in this assignment module');
                      return false;
                  }
                  else
                  {
                      continue;
                  }
                  }

                if ($selfStudent->save()){
                    $errors=[];
                    $members=$this->memberStudents;
                    for($i=0; $i<count($members);$i++)
                    {
                        $studentGroup = new StudentGroup();
                        $studentGroup->groupID = $group->groupID;
                        $studentGroup->reg_no = $members[$i];


                        $studentInTwoGroup = StudentGroup::find()->select('student_group.reg_no')->join('INNER JOIN','groups','groups.groupID = student_group.groupID')->where('groups.generation_type = :gen_type AND reg_no = :reg_no',[':gen_type' => $this->generation_type, ':reg_no' => $studentGroup->reg_no])->one();

                        if ( !empty($studentInTwoGroup)){
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Could not create group! '.$studentGroup->reg_no.' already has a group');
                            return false;
                        }

                        if(!$studentGroup->save()){

                            $errors[$members[$i]]=!empty($studentGroup->getErrors()['SG_ID'])?$studentGroup->getErrors()['SG_ID'][0]:" ";
                            continue;

                        }

                    }
                    $transaction->commit();
                    return $errors;
                }
            }


        }catch(\Throwable $e){
            $transaction->rollBack();
            throw new \Exception('Group creation failed'.$e->getMessage());
      
        }
     
    }


}