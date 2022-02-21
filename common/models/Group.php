<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $groupID
 * @property string $groupName
 * @property int $generation_type
 *
 * @property GroupAssignment[] $groupAssignments
 * @property GroupAssignmentSubmit[] $groupAssignmentSubmits
 * @property GroupGenerationTypes $generationType
 * @property StudentGroup[] $studentGroups
 */
class Groups extends \yii\db\ActiveRecord
{
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
            [['groupName', 'generation_type'], 'required'],
            [['generation_type'], 'integer'],
            [['groupName'], 'string', 'max' => 10],
            [['generation_type'], 'exist', 'skipOnError' => true, 'targetClass' => GroupGenerationTypes::className(), 'targetAttribute' => ['generation_type' => 'typeID']],
        ];
    }
  
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'groupID' => 'Group ID',
            'groupName' => 'Group Name',
            'generation_type' => 'Generation Type',
        ];
    }

    /**
     * Gets query for [[GroupAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupAssignments()
    {
        return $this->hasMany(GroupAssignment::className(), ['groupID' => 'groupID']);
    }

    /**
     * Gets query for [[GenerationType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenerationType()
    {
        return $this->hasOne(GroupGenerationTypes::className(), ['typeID' => 'generation_type']);
    }

    /**
     * Gets query for [[StudentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroups()
    {
        return $this->hasMany(StudentGroup::className(), ['groupID' => 'groupID']);
    }

    public function isMember($student)
    {
        $members=$this->studentGroups;
        for($s=0;$s<count($members);$s++)
        {
            if($members[$s]->regNo->reg_no==$student){return true;}
            continue;
        }

        return false;
    }

}
