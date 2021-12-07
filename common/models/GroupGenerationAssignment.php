<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "group_generation_assignment".
 *
 * @property int $gga_ID
 * @property int|null $gentypeID
 * @property int|null $assID
 *
 * @property GroupGenerationTypes $gentype
 * @property Assignment $ass
 */
class GroupGenerationAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_generation_assignment';
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
            [['gentypeID', 'assID'], 'integer'],
            [['gentypeID'], 'exist', 'skipOnError' => true, 'targetClass' => GroupGenerationTypes::className(), 'targetAttribute' => ['gentypeID' => 'typeID']],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gga_ID' => 'Gga ID',
            'gentypeID' => 'Gentype ID',
            'assID' => 'Ass ID',
        ];
    }

    /**
     * Gets query for [[Gentype]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGentype()
    {
        return $this->hasOne(GroupGenerationTypes::className(), ['typeID' => 'gentypeID']);
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


}
