<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "group_assignment".
 *
 * @property int $GA_ID
 * @property int|null $groupID
 * @property int|null $assID
 *
 * @property Assignment $ass
 * @property Groups $group
 */
class GroupAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_assignment';
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
    public function rules()
    {
        return [
            [['groupID', 'assID'], 'integer'],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupID' => 'groupID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'GA_ID' => 'Ga ID',
            'groupID' => 'Group ID',
            'assID' => 'Ass ID',
        ];
    }

    /**
     * Gets query for [[Ass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAss()
    {
        return $this->hasOne(Assignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID']);
    }
}
