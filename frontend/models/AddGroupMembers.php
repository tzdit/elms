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
use common\models\Student;
/**
 * add member form
 */
class AddGroupMembers extends Model
{

    public $memberStudents;
    public $generation_type;
    public $groupName;
    public $creator;


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
            [['creator'], 'string', 'max' => 50],
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
            $group->creator = Yii::$app->user->identity->username;



            if ($group->save()){

                $selfStudent = new StudentGroup();

                $selfStudent->groupID = $group->groupID;
                $selfStudent->reg_no = Yii::$app->user->identity->username;
                date_default_timezone_set('Africa/Dar_es_Salaam');
                $selfStudent->add_date=date('Y-m-d h:i:s');
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
                        foreach ($this->memberStudents as $i => $reg_no)
                        {
                            $studentGroup = new StudentGroup();

                            $studentGroup->groupID = $group->groupID;
                            $studentGroup->reg_no = $reg_no;
                            date_default_timezone_set('Africa/Dar_es_Salaam');
                            $studentGroup->add_date=date('Y-m-d h:i:s');
                            $studentInTwoGroup = StudentGroup::find()->select('student_group.reg_no')->join('INNER JOIN','groups','groups.groupID = student_group.groupID')->where('groups.generation_type = :gen_type AND reg_no = :reg_no',[':gen_type' => $this->generation_type, ':reg_no' => $studentGroup->reg_no])->one();

                            if ( !empty($studentInTwoGroup)){
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('error', '<i class="fa fa-exclamation-triangle"></i> Could not create group! '.$studentGroup->reg_no.' already has a group');
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
            }

        }catch(\Throwable $e){

            $transaction->rollBack();
            throw new \Exception('Group creation failed');
        }
        return false;
    }


}
